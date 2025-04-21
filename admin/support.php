<?php

require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
	exit('Ошибка подключения к БД');
}

$q = 'SELECT * FROM `project_support`';
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
      <h1 class="mt-3">Вопросы пользователей</h1>
      <table class="table table-striped">
      	<thead>
	      	<tr>
	      		<th>ID</th>
	      		<th>Пользователь</th>
                <th>Почта</th>
	      		<th>Содержание</th>
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

		$q = "SELECT `project_support`.`id`, `project_support`.`name`, `project_support`.`mail`, `project_support`.`problem`
        FROM `project_support`;";
		$data = mysqli_query($link, $q);
		$data = mysqli_fetch_all($data, MYSQLI_ASSOC);

		foreach($data as $d){

			echo '<tr>';
			echo '<td>'.$d['id'].'</td>';
			echo '<td>'.$d['name'].'</td>';
            echo '<td>'.$d['mail'].'</td>';
			echo '<td>'.$d['problem'].'</td>';
			echo '<td><a href="del_support.php?id='.$d['id'].'" class="btn btn-danger" onclick="return confirm(\'Подтвердите удаление\')">удалить</a>
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