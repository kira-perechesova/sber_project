<?php
require 'system/config.php';
require 'system/functions.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$link) {
    die('Ошибка подключения к базе данных');
}


$pass1_error = '';
$pass2_error = '';

$token = $_POST["token"];
$token_hash = hash("sha256", $token);
$sql = "SELECT * FROM `project_user` WHERE reset_token_hash = ?";

$smtp = $link->prepare($sql);
$smtp->bind_param("s", $token_hash);
$smtp->execute();

$result = $smtp->get_result();
$user = $result->fetch_assoc();

if($user == null){
    die("token not found");
}
if (strtotime($user["reset_token_expires_at"]) <= time()){
    die("token has expired");
}

if ($_POST['pass1'] !== $_POST['pass2']) {
    $pass1_error = 'Пароли не совпадают';
    $pass2_error = 'Пароли не совпадают';
}

$pass = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
$q_pass = "UPDATE `project_user` SET pass = ?,
    reset_token_hash = NULL, reset_token_expires_at = NULL
    WHERE id = ?";

$stmt_pass = $link->prepare($q_pass);
$stmt_pass->bind_param("ss", $pass, $user["id"]);
$stmt_pass->execute();

header('Location: index.php');
exit();