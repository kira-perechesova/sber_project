<?php

require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
	exit('Ошибка подключения к БД');
}

$q = 'SELECT * FROM `project_comment`';
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
      <h1 class="mt-3">Отзывы</h1>
      <table class="table table-striped">
      	<thead>
	      	<tr>
	      		<th>ID</th>
	      		<th>Пользователь</th>
	      		<th>Содержание</th>
				<th>Звезды</th>
				<th>Партнёр</th>
	      		<th>Дата</th>
	      		<th>Операции</th>
	      	</tr>
      	</thead>
      	<tbody>
<?php
		/*$userIDArr = array();
		foreach($data as $d){
			$userIDArr[] = $d['user_id'];
		}
		$users = getUsers($link, $userIDArr);
		$pages = getPages($link);*/

		$q = "SELECT `project_comment`.`id`, `project_comment`.`comment`, `project_comment`.`stars`, `project_comment`.`partner`, `project_comment`.`date`, `project_user`.`login` 
		FROM `project_comment` LEFT JOIN `project_user` ON `project_comment`.`user_id` = `project_user`.`id`";
		$data = mysqli_query($link, $q);
		$data = mysqli_fetch_all($data, MYSQLI_ASSOC);

		foreach($data as $d){

			echo '<tr>';
			echo '<td>'.$d['id'].'</td>';
			echo '<td>'.$d['login'].'</td>';
			echo '<td>'.$d['comment'].'</td>';
			echo '<td>'.$d['stars'].'</td>';
			echo '<td>'.$d['partner'].'</td>';
			echo '<td>'.$d['date'].'</td>';
			echo '<td><a href="del_comment.php?id='.$d['id'].'" class="btn btn-danger" onclick="return confirm(\'Подтвердите удаление\')">удалить</a>
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