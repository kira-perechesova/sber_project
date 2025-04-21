<?php
session_start();
require 'system/config.php';
require 'system/functions.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$link) {
    die('Ошибка подключения к базе данных');
}

if (isset($_POST['fio'], $_POST['bday'], $_POST['page_id'], $_POST['page_url'], $_SESSION['id']) 
    && !empty($_POST['fio']) && !empty($_POST['bday'])) {
    
    $fio = trim($_POST['fio']);
    $bday = trim($_POST['bday']);
    $balance = 100;
    $user_id = $_SESSION['id'];
    
    // Генерация уникального номера карты
    $card_number = '';
    $max_attempts = 100;
    $attempt = 0;
    $success = false;
    
    while ($attempt < $max_attempts) {
        $card_number = '';
        for ($i = 0; $i < 12; $i++) {
            $card_number .= mt_rand(0, 9);
        }
        
        $stmt = $link->prepare("SELECT COUNT(*) FROM project_card WHERE card_number = ?");
        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $link->error);
        }
        
        $stmt->bind_param("s", $card_number);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        
        if ($count == 0) {
            $success = true;
            break;
        }
        $attempt++;
    }
    
    if (!$success) {
        setAlert('danger', 'Не удалось сгенерировать уникальный номер карты');
        header('Location: profile.php');
        mysqli_close($link);
        exit();
    }
    
    // Начинаем транзакцию
    mysqli_begin_transaction($link);
    
    try {
        // Добавляем карту
        $stmt = $link->prepare("INSERT INTO `project_card` (`user_id`, `card_number`, `bday`, `fio`, `balance`) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception('Ошибка подготовки запроса для добавления карты');
        }
        
        $stmt->bind_param('sssss', $user_id, $card_number, $bday, $fio, $balance);
        if (!$stmt->execute()) {
            throw new Exception('Ошибка при отправке запроса на добавление карты');
        }
        $stmt->close();
        
        // Обновляем статус карты у пользователя
        $update_stmt = $link->prepare("UPDATE `project_user` SET `card` = 1 WHERE `id` = ?");
        if (!$update_stmt) {
            throw new Exception('Ошибка подготовки запроса для обновления поля');
        }
        
        $update_stmt->bind_param('i', $user_id);
        if (!$update_stmt->execute()) {
            throw new Exception('Ошибка при обновлении поля');
        }
        $update_stmt->close();
        
        // Фиксируем транзакцию
        mysqli_commit($link);
        setAlert('success', 'Карта успешно добавлена');
    } catch (Exception $e) {
        // Откатываем транзакцию в случае ошибки
        mysqli_rollback($link);
        setAlert('danger', $e->getMessage());
    }
    
    header('Location: profile.php');
    mysqli_close($link);
    exit();
} else {
    setAlert('danger', 'Все поля должны быть заполнены');
    header('Location: profile.php');
    mysqli_close($link);
    exit();
}
?>