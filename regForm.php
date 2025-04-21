<?php
  require 'system/config.php';
  require 'system/functions.php';

  $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if(!$link){
    die('Ошибка подключения к базе данных');
  }

if(!empty($_SESSION['login'])){
      setAlert('success', 'Вы уже вошли на сайт');
      header('Location: index.php');
      exit();
}

$login_error = $_SESSION['login_error'];
$pass1_error = $_SESSION['pass1_error'];  
$pass2_error = $_SESSION['pass2_error'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reg.css">
    <link rel="website icon" type="png" href="img/map.png">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <title>Регистрация</title>
</head>
<body>
    
</body>
</html>
<div class="image"></div>
<div class="text">
    <h1 class="welcome">Добро
        <br> пожаловать!</h1>
    <h1 class="reg">РЕГИСТРАЦИЯ</h1>
    <form action="reg.php" method="post">
        <div class="mb-3">
        <input type="text" class="form-control" id="login" name="login" 
            placeholder="<?php echo $login_error ? $login_error : 'Логин'; ?>" 
            required
            style="color: <?php echo $login_error ? 'red' : 'black'; ?>;">
        </div>
        <div class="mb-3">
            <input type="email" id="email" name="email" placeholder="Почта" required> 
        </div>
        <div class="mb-3">
            <input type="password" id="pass1" name="pass1" 
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
        <div class="mb-3">
            <input type="submit" name="button" id="button" value="Создать аккаунт">
        </div>
    </form>
    <table>
        <tr>
            <th class="checkbox-body">
                <input type="checkbox" id="checkbox" class="checkbox">
                <label for="checkbox" class="checkbox-label"></label>
            </th>

            <th class="remember"><label>Запомнить меня</label></th>
        </tr>
    </table>
    <p>Уже есть аккаунт? <a href="login.php" class="login">Войти</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/main.js"></script>
<script src="js/login_text.js"></script>
</body>
</html>
