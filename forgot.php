<?php
require 'system/config.php';
require 'system/functions.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
    die('Ошибка подключения к базе данных');
}

$error_email = '';

$email = $_POST['email'];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$check_sql = "SELECT id FROM project_user WHERE mail = ?";
$check_stmt = mysqli_prepare($link, $check_sql);
mysqli_stmt_bind_param($check_stmt, "s", $email);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt);
    
if(mysqli_stmt_num_rows($check_stmt) > 0) {
    $sql = "UPDATE project_user SET reset_token_hash = ?, reset_token_expires_at = ? WHERE mail = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $token_hash, $expiry, $email);
    $result = mysqli_stmt_execute($stmt);
        
    if($result && mysqli_stmt_affected_rows($stmt) > 0) {
        $mail = require __DIR__ . "/mailer.php";
            
        $mail->setFrom("kiramts@yandex.ru", "Password recovery");
        $mail->addAddress($email);
        $mail->Subject = "Password recovery";
            
        $mail->isHTML(true);
        $mail->Body = <<<END
        Нажмите <a href="http://x911771a.beget.tech/project/new_password.php?token=$token">здесь</a>
        чтобы сбросить пароль.
        END;
            
        try {
            $mail->send();
            $error_email = "Сообщение отправлено";
        } catch(Exception $e) {
            $error_email = "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }
    } else {
        $error_email = "Error updating password reset data";
    }
    mysqli_stmt_close($stmt);
} else {
    if(empty($email)){
        $error_email = '';
    }else{
        $error_email = "Почта не найдена";
    }
}
mysqli_stmt_close($check_stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/log.css">
    <link rel="website icon" type="png" href="img/map.png">
    <title>Восстановить пароль</title>
</head>
<body>
    <div class="image"></div>
    <div class="text">
        <h1>Восстановление пароля</h1>
        <form action="" method="post">
            <div>
                <!-- <input type="email" id="email_forgot" name="email" placeholder="Почта" required>  -->
                <input type="email" id="email_forgot" name="email" 
                    placeholder="<?php echo $error_email ? $error_email : 'Почта'; ?>" 
                    required 
                    style="color: <?php echo $error_email ? 'red' : 'black'; ?>;">
            </div>
            <div>
                <input type="submit" name="forgot" id="button_forgot" value="Восстановить">
            </div>
        </form>
        <p class="log_forgot">Вспомнили пароль?    <a href="login.php" class="registration">Войти</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/main.js"></script>
<script src="js/login_text.js"></script>
</body>
</html>
