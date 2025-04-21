<?php
require 'system/config.php';
require 'system/functions.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
    die('Ошибка подключения к базе данных');
}

$token = $_GET["token"];
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/log.css">
    <link rel="website icon" type="png" href="img/map.png">
    <title>Новый пароль</title>
</head>
<body>
    <div class="image"></div>
    <div class="text">
        <h1>Новый пароль</h1>
        <form action="new_password_php.php" method="post">
        <input type="hidden" name="token" value="<?=htmlspecialchars($token)?>">

        <div class="mb-3">
            <input type="password" id="pass1_n" name="pass1" 
            placeholder="<?php echo $pass1_error ? $pass1_error : 'Пароль'; ?>" 
            required
            style="color: <?php echo $pass1_error ? 'red' : 'black'; ?>;">
        </div>
        <div class="mb-3">
            <input type="password" id="pass2" name="pass2" 
            placeholder="<?php echo $pass2_error ? $pass2_error : 'Повторный пароль'; ?>" 
            required
            style="color: <?php echo $pass2_error ? 'red' : 'black'; ?>;">
        </div>
            <div>
                <input type="submit" name="button" id="button" value="Изменить пароль">
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/main.js"></script>
<script src="js/login_text.js"></script>
</body>
</html>
