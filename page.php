<?php
require 'system/config.php';
require 'system/functions.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
	die('Ошибка подключения к базе данных');
}

// $comment = false;
$title = 'Ошибка 404';
$content = 'Страница не найдена';
$showComment = false;
if(!empty($_GET['url'])){
	$q = 'SELECT * FROM `project_page` WHERE `url` = "'.$_GET['url'].'" AND `active` = 1';
	$res = mysqli_query($link, $q);
	$page = mysqli_fetch_all($res, MYSQLI_ASSOC);
	if(!empty($page)){
		$title = $page[0]['title'];
		$content = $page[0]['content'];
		if($title == 'Отзывы'){
			$showComment = true;
		}
	}else{
		header("HTTP/1.0 404 Not Found");
	}

}else{
		header("HTTP/1.0 404 Not Found");
	}

    $cssFile = '<link rel="stylesheet" href="css/home.css"><link rel="stylesheet" href="css/functions.css"><link rel="stylesheet" href="css/card_form.css">';
	require 'templates/header.php';
?>

<main>
		<div class="container">
			<?php
			alerts('danger');
			alerts('success');
			?>
		
	<div class="container">
		<?=$content?>
	</div>
	<?php
	if($showComment){
		require 'templates/comments.php';
	}
	?>
</main>

<?php
require 'templates/footer.php';
?>