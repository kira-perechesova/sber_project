<?php
require '../system/config.php';
require '../system/functions.php';
require '../system/admin.php';

$allowedFileExt = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'txt', 'webp', 'sql', '7z');

//Если была отправлена форма
if(!empty($_FILES)){
  $fileTmpName = $_FILES['ufile']['tmp_name'];
  $fileName = $_FILES['ufile']['name'];
  $fileName = $_FILES['ufile']['name'];
  $fileError = $_FILES['ufile']['error'];
  $fileExt = getFileExt($fileName);
 
  

  if($fileError == 1 || $fileError == 2){
    setAlert('danger', 'Превышен размер файла');
  }elseif($fileError != 0){
    setAlert('danger', 'Ошибка загрузки файла');
  }elseif(!in_array($fileExt, $allowedFileExt)){
    setAlert('danger', 'Недопустимое расширение файла');
  }else{
    //обезопасим имя файла, что-бы не перезаписать существующий
    $newFileName = generateFileName($fileName);

    //путь куда будет скопирован файл из временной папки
    $destPath = UPLOAD_PATH.$newFileName;

    if(move_uploaded_file($fileTmpName, $destPath)){
      setAlert('success', 'Файл успешно скопирован');
      header('Location: files.php');
      exit();
    } 

  }

}

require 'templates/header.php';
?>

  <main class="flex-shrink-0">
    <div class="container">
    	<?php
    	alerts('danger');
      alerts('success');
    	
    	?>
      <a href="files.php" class="btn btn-success mt-3">Назад</a>
      <h1 class="mt-3">Загрузить файл</h1>
      <form method="post" enctype="multipart/form-data">
      	<div class="mb-3">
      		<label class="form-label">Выберите файл (макс 2МБ)</label>
      		<input type="file" class="form-control"  name="ufile">
      	</div>      	
      	<button type="submit" class="mt-2 btn btn-primary">Загрузить</button>     	
      </form>
    </div>
  </main>
<?php
require 'templates/footer.php';

?>