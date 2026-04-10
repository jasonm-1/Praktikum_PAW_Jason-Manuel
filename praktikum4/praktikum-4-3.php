<?php

class Mahasiswa {
    public $nim;
    public $nama;
    public $prodi;

    public function __construct($nim, $nama, $prodi) {
    $this->nim = $nim;    
    $this->nama = $nama;
    $this->prodi = $prodi;
    }

    public function kuliah() {
        return $this->nama . " (" . $this->nim . ") terdaftar sebagai mahasiswa " . $this->prodi . "." . "<br>";
    }

    public function ujian() {
        return $this->nama . " (" . $this->nim . ") dengan program studi " . $this->prodi . ", sedang melaksanakan ujian." . "<br>";
    }

    public function praktikum() {
        return $this->nama . " (" . $this->nim . ") dengan program studi " . $this->prodi . ", memiliki beberapa kelas praktikum." . "<br>";
    }
}

$mahasiswa1 = new Mahasiswa("249855040001173", "Lyla", "Teknik Informatika");
$mahasiswa2 = new Mahasiswa("246529030002261", "Leanor", "Teknologi Informasi");

echo $mahasiswa1->kuliah() . "<br>";
echo $mahasiswa1->ujian() . "<br>";
echo $mahasiswa1->praktikum() . "<br>";
echo $mahasiswa2->kuliah() . "<br>";
echo $mahasiswa2->ujian() . "<br>";
echo $mahasiswa2->praktikum() . "<br>";
