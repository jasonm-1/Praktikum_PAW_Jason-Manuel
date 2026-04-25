<?php
session_start();
require 'db.php';

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

if (!empty($user) && !empty($pass)) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :u");
    $stmt->execute(['u' => $user]);
    $data = $stmt->fetch();

    if ($data && password_verify($pass, $data['password'])) {
        $_SESSION['user_id'] = $data['id']; 
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        
        header("Location: page_c.php");
        exit(); 
    } else {
        header("Location: index.php?error=wrong");
        exit();
    }
} else {
    header("Location: index.php?error=empty");
    exit();
}
