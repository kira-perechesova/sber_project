<?php

require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
	exit('Ошибка подключения к БД');
}

$q = 'SELECT * FROM `project_user`';
$data = mysqli_query($link, $q);
$data = mysqli_fetch_all($data, MYSQLI_ASSOC);


require 'templates/header.php';
?>

  <main class="flex-shrink-0">
    <div class="container">
    	<?php
    	alerts('success');
    	alerts('danger');
    	?>
      <h1 class="mt-3">Пользователи</h1>
      <table class="table table-striped">
      	<thead>
	      	<tr>
	      		<th>ID</th>
	      		<th>Логин</th>
	      		<th>Почта</th>
	      		<th>Дата регистрации</th>
				<th>Карта</th>
	      		<th>Бан</th>
	      		<th>Админ</th>
	      		<th>Операции</th>
	      	</tr>
      	</thead>
      	<tbody>
<?php
		foreach($data as $d){
			$ban = 'нет';
			if(empty($d['active'])){
				$ban = 'да';
			}
			$admin = 'нет';
			if($d['admin'] == 1){
				$admin = 'да';
			}
			echo '<tr>';
			echo '<td>'.$d['id'].'</td>';
			echo '<td>'.$d['login'].'</td>';
			echo '<td>'.$d['mail'].'</td>';
			echo '<td>'.$d['date'].'</td>';
			echo '<td>'.$d['card'].'</td>';
			echo '<td>'.$ban.'</td>';
			echo '<td>'.$admin.'</td>';
			echo '<td><a href="edit_user.php?id='.$d['id'].'" class="btn btn-warning">сделать админом</a>
			<a href="del_user.php?id='.$d['id'].'" class="btn btn-danger" onclick="return confirm(\'Подтвердите удаление\')">удалить</a>
			</td>';
			echo '</tr>';
		}

?>
      	</tbody>	
	  </table>

    </div>
  </main>

<?php
require 'templates/footer.php';

?>