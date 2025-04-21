<?php
function varDump($data){
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

function printR($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function setAlert($type, $message){
	$_SESSION[$type][] = $message;
}

function getAlerts($type){
	if(!empty($_SESSION[$type])){
		return $_SESSION[$type];
	}
	return [];
}

function alerts($type){
	foreach(getAlerts($type) as $m){
		// echo '<div class="mb-3 alert alert-'.$type.' alert-dismissible fade show" role="alert">'.$m.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		echo '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert"><span>'.$m.'</span><button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close">
		<svg width="35" height="35" viewbox="0 0 40 40"><path d="M 10,10 L 30,30 M 30,10 L 10,30" stroke="black" stroke-width="4" /></svg>
</div>
		</button></div>';
	}
	unset($_SESSION[$type]);
}

function getComments($link, $id){
	$q = "SELECT `project_comment`.`comment`, `project_comment`.`stars`, `project_comment`.`partner`, `project_comment`.`date`, `project_user`.`login` 
	FROM `project_comment`, `project_user` 
	WHERE `project_comment`.`page_id` = {$id} 
	AND `project_comment`.`user_id` = `project_user`.`id`";
	return mysqli_fetch_all(mysqli_query($link, $q), MYSQLI_ASSOC);
}

function getFileExt($name){
 $nameArr = explode('.', $name);
 $ext = array_pop($nameArr);
 $ext = strtolower($ext);
 return $ext;
}

function generateFileName($name){
 $ext = getFileExt($name);
 $time = time();
 $newName = md5($time.$name) . '.' .$ext;
 return $newName;
}