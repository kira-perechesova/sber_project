<?php

require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
	exit('Ошибка подключения к БД');
}

$q = 'SELECT * FROM `project_promotion`';
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
      <h1 class="mt-3">Акции</h1>
      <table class="table table-striped">
      	<thead>
	      	<tr>
	      		<th>ID</th>
	      		<th>Описание</th>
	      		<th>Дата</th>
	      		<th>Операции</th>
	      	</tr>
      	</thead>
      	<tbody>
<?php
		foreach($data as $d){
			echo '<tr>';
			echo '<td>'.$d['id'].'</td>';
			echo '<td>'.$d['description'].'</td>';
			echo '<td>'.$d['date'].'</td>';
			echo '<td><a href="edit_promotion.php?id='.$d['id'].'" class="btn btn-warning">Изменить описание</a>
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