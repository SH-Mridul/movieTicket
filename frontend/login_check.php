<?php
session_start();
if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true || !isset($_SESSION['username']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'users') {
    header("Location: login.php");
    exit;
}
?>