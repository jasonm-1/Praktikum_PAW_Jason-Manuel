<?php
$handle = fopen("catatan.txt", "a");

if ($handle) {
    $dataTambahan = "Ini adalah baris kedua yang baru saja ditambahkan.\n";

    fwrite($handle, $dataTambahan);
    fclose($handle);
    
    echo "Data berhasil ditambahkan ke 'catatan.txt'!";
} else {
    echo "Gagal membuka file.";
}
?>
