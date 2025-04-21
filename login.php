<?php
  require 'system/config.php';
  require 'system/functions.php';

  $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if(!$link){
    die('Ошибка подключения к базе данных');
  }

  // добавить позже, когда сделаю кнопку "выход"
  if(!empty($_SESSION['login'])){
    setAlert('success', 'Вы уже вошли на сайт');
    header('Location: index.php');
    exit();
  }

  // Инициализируем переменные для сообщений об ошибке
  $login_error = '';
  $pass_error = '';

  if(!empty($_POST['login']) && !empty($_POST['pass'])){
      $q = "SELECT * FROM `project_user` WHERE `login` = '{$_POST['login']}'";
      $user = mysqli_query($link, $q);
      $user = mysqli_fetch_all($user, MYSQLI_ASSOC);
      
      if(!empty($user[0]) && password_verify($_POST['pass'], $user[0]['pass'])){
            $_SESSION['login'] = $user[0]['login'];
            $_SESSION['admin'] = $user[0]['admin'];
            $_SESSION['id'] = $user[0]['id'];
            $success[] = 'Успешный вход';
            header('Location: index.php');
            exit();
      }else{
            // $errors[] = 'Ошибка входа';
            // setAlert('danger', 'Ошибка входа');
            $login_error = 'Неверный логин или пароль';
            $pass_error = 'Неверный логин или пароль';
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/log.css">
    <link rel="website icon" type="png" href="img/map.png">
    <title>Вход</title>
</head>
<body>
    <div class="image"></div>
    <div class="text">
        <h1>С возвращением!</h1>
        <form action="" method="post">
            <div>
                <input type="text" class="form-control" id="login" name="login" 
                    placeholder="<?php echo $login_error ? $login_error : 'Логин'; ?>" 
                    required 
                    style="color: <?php echo $login_error ? 'red' : 'black'; ?>;">
            </div>
            <div>
                <input type="password" class="form-control" id="pass1" name="pass" 
                    placeholder="<?php echo $pass_error ? $pass_error : 'Пароль'; ?>" 
                    style="padding-left: 10px; color: <?php echo $pass_error ? 'red' : 'black'; ?>;"
                    required>
            </div>
            <div>
                <a href="forgot.php" class="forgot">Забыли пароль?</a>
            </div>
            <div>
                <input type="submit" name="button" id="button" value="Войти в аккаунт">
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
        <p>Ещё нет аккаунта?</p>
        <a href="regForm.php" class="registration">Зарегистрироваться</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/main.js"></script>
<script src="js/login_text.js"></script>
</body>
</html>
