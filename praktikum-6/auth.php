<?php
session_start();

function checkAccess($allowedRoles) {
    if (!isset($_SESSION['role'])) {
        if (!in_array('guest', $allowedRoles)) {
            header("Location: index.php?error=guest");
            exit();
        }
    } else {
        if (!in_array($_SESSION['role'], $allowedRoles)) {
            header("Location: page_c.php?error=unauthorized");
            exit();
        }
    }
}

if (!isset($_COOKIE['last_visit'])) {
    setcookie("last_visit", date("d-m-Y H:i:s"), time() + (86400 * 30), "/");
}
?>
