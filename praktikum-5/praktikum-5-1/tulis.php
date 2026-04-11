<?php
$isiFile = "Ini adalah percobaan menulis file dengan file_put_contents.\n";
file_put_contents("catatan.txt", $isiFile);
echo "File 'catatan.txt' berhasil dibuat dan diisi!";
?>
