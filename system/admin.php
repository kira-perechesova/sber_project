<?php
if(empty($_SESSION['admin'])){
	$txt = 'Внимание, попытка взлома, ваш IP '.$_SERVER['REMOTE_ADDR'].' зафиксирован!';
	setAlert('danger', $txt);
	header('Location: ../index.php');
	exit();
}