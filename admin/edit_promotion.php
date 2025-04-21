<?php

require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
	exit('Ошибка подключения к БД');
}


require 'templates/header.php';

$new_desc = $_POST['promotion'];
$q_edit_pr = "UPDATE `project_promotion` SET `description` = ? WHERE id = 1";
$stmt_edit_pr = $link->prepare($q_edit_pr);
$stmt_edit_pr->bind_param("s", $new_desc);
$stmt_edit_pr->execute();

?>
<main class="flex-shrink-0">
<div class="container">
<form action="" method="post">
	<label for="com" class="form-label">Изменить описание акции</label>
	<textarea name="promotion" id="promotion" class="form-control"></textarea>
	<button type="submit" class="btn btn-primary mt-3 mb-3">Изменить</button>
</form>
</div>
</main>
<?php
require 'templates/footer.php';
?>

