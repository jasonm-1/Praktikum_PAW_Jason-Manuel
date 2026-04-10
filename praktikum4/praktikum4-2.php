<?php

function penjumlahan($angka1, $angka2) {
    return $angka1 + $angka2;
}
$jumlah1 = penjumlahan(21, 37);
echo "Hasil penjumlahan 21 + 37 = " . $jumlah1 . "<br>";

$jumlah2 = penjumlahan(18, 29);
echo "Hasil penjumlahan 18 + 29 = " . $jumlah2 . "<br>";

function countname($nama) {
    return strlen($nama);
}
$panjangnama1 = countname("Alpha Beta");
echo "Panjang gabungan nama pertama = " . $panjangnama1 . "<br>";

$panjangnama2 = countname("Delta Gamma");
echo "Panjang gabungan nama kedua = " . $panjangnama2 . "<br>";
