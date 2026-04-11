<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $nim = $_POST["nim"];
    $email = $_POST["email"];
    
    if (empty($name) || empty ($nim) || empty($email)) {
        echo "Isi semua kolom yang tersedia!"; } 
    else {
        $sanitizedName = htmlspecialchars($name);
        $sanitizedNim = htmlspecialchars($nim);
        $sanitizedEmail = htmlspecialchars($email);
        $data = "Nama: " . $sanitizedName . "\n" . "NIM: " . $sanitizedNim . "\n" . "Email: " . $sanitizedEmail . "\n";
        
        $fileLog = "file.txt";
        
        $isiFile = fopen($fileLog, "a");
        if ($isiFile) {
            fwrite($isiFile, $data);
            fclose($isiFile);
            echo "Data sudah tersimpan pada 'file.txt'.";
        } else {
            echo "Data gagal tersimpan, silahkan coba lagi.";
        }
    }
}
?>
