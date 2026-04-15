<?php
session_start();

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if (!empty($user) && !empty($pass)) {
    
    $_SESSION['username'] = $user;
    $_SESSION['role'] = $role;

    setcookie("last_user", $user, time() + (86400 * 30), "/");

    header("Location: page_c.php");
    exit();
} else {
    header("Location: index.php?error=empty");
    exit();
}
