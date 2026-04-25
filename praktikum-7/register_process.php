<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (:u, :p, :r)");
    $stmt->execute(['u' => $user, 'p' => $pass, 'r' => $role]);
    header("Location: index.php?status=registered");
}
?>
