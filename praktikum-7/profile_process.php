<?php
include 'auth.php';
require 'db.php';
$id = $_SESSION['user_id'];
$action = $_POST['action'] ?? '';

if ($action == 'update') {
    $new_user = $_POST['new_username'];
    $stmt = $conn->prepare("UPDATE users SET username = :u WHERE id = :id");
    $stmt->execute(['u' => $new_user, 'id' => $id]);
    $_SESSION['username'] = $new_user; 
    header("Location: profile.php?status=updated");
    exit();

} elseif ($action == 'delete') {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    session_destroy();
    header("Location: index.php?status=deleted");
    exit();

} elseif ($action == 'cancel_membership') {
    $stmt = $conn->prepare("UPDATE users SET role = 'public' WHERE id = :id");
    $stmt->execute(['id' => $id]);
    
    $_SESSION['role'] = 'public';
    
    header("Location: index.php?info=membership_ended");
    exit();
} else {
    header("Location: page_c.php");
    exit();
}
?>
