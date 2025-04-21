<?php
	require 'system/config.php';
	require 'system/functions.php';

	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if(!$link){
		die('Ошибка подключения к базе данных');
	}

if(!empty($_POST['comment']) && !empty($_POST['page_id']) && !empty($_POST['page_url']) && !empty($_SESSION['id']) && !empty($_POST['partner'])){
	$stars = isset($_POST['rate']) ? (int)$_POST['rate'] : 5;
	$comment = $_POST['comment'];
	$date = date('Y-m-d');
	$partner = $_POST['partner'];
	$q = "INSERT INTO `project_comment` (`user_id`, `page_id`, `comment`, `stars`, `partner`, `date`) 
	VALUES ({$_SESSION['id']}, {$_POST['page_id']}, '{$comment}', '{$stars}', '{$partner}', '{$date}')";
	if(mysqli_query($link, $q)){
		setAlert('success', 'Комментарий успешно добавлен');
		header('Location: page.php?url='.$_POST['page_url']);
		exit();
	}
}	
