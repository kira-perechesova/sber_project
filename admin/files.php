<?php

require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

$files = scandir('..'.DIRECTORY_SEPARATOR.UPLOAD_DIR);
array_shift($files);
array_shift($files);

require 'templates/header.php';
?>

  <main class="flex-shrink-0">
    <div class="container">
    	<?php
    	alerts('danger');
    	alerts('success');
    	?>
      <a class="btn btn-success mt-3" href="add_file.php">Добавить</a>
      <h1 class="mt-3">Загруженные файлы</h1>
      <table class="table table-striped mt-2">
      	<thead>
      		<tr>
      			<th>№</th>
      			<th>Миниатюра</th>
      			<th>Путь</th>
      			<th>Операции</th>
      		</tr>
      	</thead>
      	<tbody>
      		<?php
      		$i= 1;
      		$imgExt = array('jpg', 'gif', 'png', 'jpeg', 'webp');
      		foreach($files as $f){
      			$preview = 'нет';
      			$fileExt = getFileExt($f);
      			if(in_array($fileExt, $imgExt)){
      				$preview = '<img width="75" src="../'.UPLOAD_DIR.'/'.$f.'">';
      			}
      			echo '<tr>';
      			echo '<td>'.$i.'</td>';
      			echo '<td>'.$preview.'</td>';
      			echo '<td>'.UPLOAD_DIR.'/'.$f.'</td>';
				echo '<td><a href="del_file.php?name='.$f.'" class="btn btn-danger" onclick="return confirm(\'Подтвердите удаление\')">удалить</a>
				</td>';      			
      			echo '</tr>';
      			$i++;
      		}

      		?>
      	</tbody>
      </table>
    </div>
  </main>
<?php
require 'templates/footer.php';