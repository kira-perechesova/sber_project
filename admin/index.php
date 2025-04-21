<?php
require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
	exit('Ошибка подключения к БД');
}
require 'templates/header.php';
?>

  <main class="flex-shrink-0">
    <div class="container">
      <h1 class="mt-5">Добро пожаловать в админку!</h1>

    </div>
  </main>

<?php
require 'templates/footer.php';

?>