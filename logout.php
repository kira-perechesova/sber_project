<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['admin']);
unset($_SESSION['id']);
header('Location: login.php');