<?php

require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

if(unlink(UPLOAD_PATH.$_GET['name'])){
	setAlert('success', 'Файл успешно удалён');	
}else{
	setAlert('errors', 'Ошибка удаления файла');		
}

header('Location: files.php');