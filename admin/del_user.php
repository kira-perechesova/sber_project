<?php

require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
	exit('Ошибка подключения к БД');
}

if(empty($_GET['id'])){
	exit('Ошибка параметра');
}

$q = 'DELETE FROM `project_user` WHERE `id` = '.$_GET['id'];
$res = mysqli_query($link, $q);
if($res){
	setAlert('success', 'Пользователь удалён');		
}else{
	setAlert('errors', 'Ошибка удаления пользователя');		
}

header('Location: users.php');
