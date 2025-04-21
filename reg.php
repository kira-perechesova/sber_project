<?php
require 'system/config.php';
require 'system/functions.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$link) {
    die('Ошибка подключения к базе данных');
}

$_SESSION['login_error'] = '';
$_SESSION['pass1_error'] = '';
$_SESSION['pass2_error'] = '';

// Проверки
if (empty($_POST['login']) || empty($_POST['pass1']) || empty($_POST['pass2']) || empty($_POST['email'])) {
    $_SESSION['login_error'] = 'Все поля должны быть заполнены';
    header('Location: regForm.php');
    exit();
}

if (mb_strlen($_POST['login']) < 4) {
    $_SESSION['login_error'] = 'Логин должен быть не менее 4 символов';
}

if ($_POST['pass1'] !== $_POST['pass2']) {
    $_SESSION['pass1_error'] = 'Пароли не совпадают';
    $_SESSION['pass2_error'] = 'Пароли не совпадают';
}

// Проверка существования пользователя
$login = mysqli_real_escape_string($link, $_POST['login']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$q = "SELECT * FROM project_user WHERE login = '$login' OR mail = '$email'";
$res = mysqli_query($link, $q);
if (mysqli_num_rows($res) > 0) {
    $_SESSION['login_error'] = 'Пользователь с таким логином уже существует';
}

// Если есть ошибки — вернуть на форму
if ($_SESSION['login_error'] || $_SESSION['pass1_error'] || $_SESSION['pass2_error']) {
    header('Location: regForm.php');
    exit();
}

// Регистрация
$date = date('Y-m-d');
$pass = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
$q = "INSERT INTO `project_user` (`login`, `pass`, `mail`, `date`) 
	VALUES ('{$_POST['login']}', '{$pass}', '{$_POST['email']}', '{$date}')";
if (mysqli_query($link, $q)) {
    setAlert('success', 'Вы успешно зарегистрированы');
    header('Location: index.php');
    exit();
} else {
    $_SESSION['login_error'] = 'Ошибка регистрации, попробуйте позже';
    header('Location: regForm.php');
    exit();
}
