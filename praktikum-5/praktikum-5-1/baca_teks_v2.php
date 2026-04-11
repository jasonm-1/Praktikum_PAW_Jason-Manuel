<?php
$isiFile = fopen("data.txt", "r");

if ($isiFile) {
    while (($line = fgets($isiFile)) !== false) {
        echo $line . "<br>";
    }
    fclose($isiFile);
}
?>
