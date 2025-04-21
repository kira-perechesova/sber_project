<?php
require 'system/config.php';
require 'system/functions.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$link) {
    die('Ошибка подключения к базе данных');
}

$title = 'Профиль';
$cssFile = '<link rel="stylesheet" href="css/profile.css"><link rel="stylesheet" href="css/home.css"><link rel="stylesheet" href="css/functions.css">';

require 'templates/header.php';



// bda
    $today = date('m-d');
    $year = date('Y');
    $q_birthday = 'SELECT * FROM project_card WHERE DATE_FORMAT(bday, "%m-%d") = ? AND last_generation != ?';
    $stmt_birthday = mysqli_prepare($link, $q_birthday);
    mysqli_stmt_bind_param($stmt_birthday, 'si', $today, $year);
    mysqli_stmt_execute($stmt_birthday);

    $result = mysqli_stmt_get_result($stmt_birthday);
    $users_with_birthday = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!empty($users_with_birthday)) {
        $q_update_balance = 'UPDATE project_card SET balance = balance + 500, last_generation = ? 
            WHERE DATE_FORMAT(bday, "%m-%d") = ? AND last_generation != ?';
        $stmt_update = mysqli_prepare($link, $q_update_balance);
        mysqli_stmt_bind_param($stmt_update, 'isi', $year, $today, $year);
        mysqli_stmt_execute($stmt_update);
    }
// bday end
?>
<div class="container">
    <?php
    alerts('danger');
    alerts('success');
    ?>
</div>
<?php
$allowedFileExt = array('jpg', 'jpeg', 'gif', 'png', 'webp');

// Если была отправлена форма загрузки фото
if (!empty($_FILES['ufile'])) {
    $fileTmpName = $_FILES['ufile']['tmp_name'];
    $fileName = $_FILES['ufile']['name'];
    $fileError = $_FILES['ufile']['error'];
    $fileExt = getFileExt($fileName);

    if ($fileError == 1 || $fileError == 2) {
        setAlert('danger', 'Превышен размер файла');
    } elseif ($fileError != 0) {
        setAlert('danger', 'Ошибка загрузки файла');
    } elseif (!in_array($fileExt, $allowedFileExt)) {
        setAlert('danger', 'Недопустимое расширение файла');
    } else {
        $newFileName = generateFileName($fileName);
        $destPath = 'photos/' . $newFileName;

        if (!file_exists('photos')) {
            setAlert('danger', 'Папка "photos" не существует');
        } elseif (!is_writable('photos')) {
            setAlert('danger', 'Нет прав на запись в папку "photos"');
        } else {
            if (move_uploaded_file($fileTmpName, $destPath)) {
                $id = $_SESSION['id'];
                $updateQuery = "UPDATE project_user SET photo = ? WHERE id = ?";
                $stmt = $link->prepare($updateQuery);
                $stmt->bind_param("si", $newFileName, $id);
                $stmt->execute();
                setAlert('success', 'Файл успешно загружен');
                echo "<script>window.location.href = window.location.href;</script>";
                exit();
            } else {
                setAlert('danger', 'Не удалось загрузить файл. Ошибка: ' . error_get_last()['message']);
            }
        }
    }
}

// Если была нажата кнопка удаления фото
if (isset($_POST['deleteImage'])) {
    $id = $_SESSION['id'];
    $updateQuery = "UPDATE project_user SET photo = 'default-profile.png' WHERE id = ?";
    $stmt = $link->prepare($updateQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    setAlert('success', 'Фото профиля удалено');
    echo "<script>window.location.href = window.location.href;</script>";
    exit();
}
?>
<div class="div_for_form">
<form method="post" action="" enctype="multipart/form-data" class="profile_pic_form">
    <label for="uploadImage">
        <?php
        $id = $_SESSION['id'];
        $avatarQuery = "SELECT photo FROM project_user WHERE id = ?";
        $stmt = $link->prepare($avatarQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (isset($row['photo']) && !empty($row['photo'])) {
                echo '<img id="profilePic" class="profile-pic" src="photos/' . $row['photo'] . '" alt="Ваше фото">';
            } else {
                echo '<img id="profilePic" class="profile-pic" src="photos/default-profile.png" alt="Фото не установлено">';
            }
        } else {
            echo "Фотография не найдена.";
        }
        ?>
    </label>
    <div class="upload_button_to_center">
        <input type="file" id="uploadImage" name="ufile" accept="image/*">
        <button type="submit" class="upload_button">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cloud-upload-fill" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.5 14.5V11h1v3.5a.5.5 0 0 1-1 0"/>
    </svg>
        </button>
        
        <button type="submit" name="deleteImage" class="upload_button">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
            </svg>
        </button>
    </div>
</form>
</div>
<div class="circle_color">
<?php
    if (!empty($_SESSION['login'])) {
        echo '<h1 class="hello_user">Здравствуйте, <br>' . $_SESSION['login'] . '!</h1>';
    } else {
        echo '<a href="login.php">Войти в аккаунт</a>';
    }
    ?>
    <div class="yellow_circle"></div>
    <div class="card_form_balance">
        <?php
            $query_card = "SELECT `card` FROM `project_user` WHERE id = " . $_SESSION['id'];
            $result = mysqli_query($link, $query_card);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                if (empty($row['card'])) {
                    echo '<a href="page.php?url=card"><h2>Добавить карту</h2></a>';
                } else {
                    $q_number_card = "SELECT `card_number` FROM `project_card` WHERE `user_id` = " . $_SESSION['id'];
                    $res_number_card = mysqli_query($link, $q_number_card);
                    $row_number_card = mysqli_fetch_assoc($res_number_card);

                    $q_balance = "SELECT `balance` FROM `project_card` WHERE `user_id` = " . $_SESSION['id'];
                    $res_balance = mysqli_query($link, $q_balance);
                    $row_balance = mysqli_fetch_assoc($res_balance); 

                    if ($row_number_card){
                        echo '<div class="data_card">';
                        echo '<div class="date_balance"><h2>' . htmlspecialchars($row_balance['balance']) . ' бонусов</h2></div>';
                        echo '<div class="data_number_card"><h2 class="h2_card">Номер карты:</h2>';
                        echo '<h2>' . htmlspecialchars($row_number_card['card_number']) . '</h2></div>';
                        // echo '<div class="date_cvv"><h2 class="h2_card">Ваш баланс: </h2>';
                        echo '</div>';
                    } else {
                        echo '<a href="page.php?url=card"><h2>Добавить карту</h2></a>';
                    }
                }
            } else {
                echo 'Ошибка выполнения запроса';
            }
        ?>
    </div>
    <div class="green_circle"></div>
    </div>
<?php
require 'templates/footer.php';
?>

