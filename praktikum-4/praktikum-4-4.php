<?php

$daftar_prodi = ["Teknik Informatika", "Teknik Komputer", "Ilmu Komputer", "Sistem Informasi", "Teknologi Informasi", "Pendidikan Teknologi Informasi"];
foreach ($daftar_prodi as $prodi) {
    echo $prodi . "<br>";
}

$screening_kesehatan = ["Nama" => "Helena", "Usia" => "34", "Pekerjaan" => "Dokter", "Golongan Darah" => "O-", "Status" => "Negatif"]; 
echo "<br>" . "--- Hasil Screening Kesehatan --- <br>";
foreach ($screening_kesehatan as $key => $value) {
    echo $key . ": " . $value . "<br>";
}
