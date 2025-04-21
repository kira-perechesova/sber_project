<?php
// 	require 'system/config.php';
// 	require 'system/functions.php';

// 	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// 	if(!$link){
// 		die('Ошибка подключения к базе данных');
// 	}

// if(!empty($_POST['problem']) && !empty($_POST['user_name']) && !empty($_POST['user_email']) && !empty($_POST['page_id']) && !empty($_POST['page_url']) && !empty($_SESSION['id'])){
// 	$comment = $_POST['problem'];
// 	$q = "INSERT INTO `project_support` (`name`, `mail`, `problem`) 
// 	VALUES ({$_POST['user_name']}, {$_POST['user_email']}, '{$comment}')";
// 	if(mysqli_query($link, $q)){
// 		setAlert('success', 'Вопрос отправлен, ответ придёт на указанную почту');
// 		header('Location: page.php?url='.$_POST['page_url']);
// 		exit();
// 	}
// }	
    session_start(); // Start the session to use session variables

    require 'system/config.php';
    require 'system/functions.php';

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$link) {
        die('Ошибка подключения к базе данных');
    }

    if (isset($_POST['problem'], $_POST['user_name'], $_POST['user_email'], $_POST['page_id'], $_POST['page_url'], $_SESSION['id'])) {
        $user_name = mysqli_real_escape_string($link, $_POST['user_name']);
        $user_email = mysqli_real_escape_string($link, $_POST['user_email']);
        $problem = mysqli_real_escape_string($link, $_POST['problem']);
        $page_url = mysqli_real_escape_string($link, $_POST['page_url']);

        // Prepared statement to prevent SQL injection
        $q = "INSERT INTO `project_support` (`name`, `mail`, `problem`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($link, $q);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sss', $user_name, $user_email, $problem);

            if (mysqli_stmt_execute($stmt)) {
                setAlert('success', 'Вопрос отправлен, ответ придёт на указанную почту');
                header('Location: page.php?url=support');
                exit();
            } else {
                setAlert('danger', 'Ошибка при отправке запроса');
            }

            mysqli_stmt_close($stmt);
        } else {
            setAlert('danger', 'Ошибка подготовки запроса');
        }
    } else {
        setAlert('danger', 'Все поля должны быть заполнены');
    }
?>
