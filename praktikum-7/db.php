<?php
$servername = "localhost";
$db_user = "root"; 
$db_pass = "";     
$dbname = "studio_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi Gagal: " . $e->getMessage());
}
?>
