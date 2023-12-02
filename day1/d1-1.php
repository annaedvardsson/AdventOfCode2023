<?php

$sum = 0;

// $file = fopen("d1_Example.txt", "r") or die("Unable to open file!");
$file = fopen("d1_Input.txt", "r") or die("Unable to open file!");

// line-by-line until end-of-file
while (!feof($file)) {

    $line = fgets($file);
    $numbersInLine = preg_replace('/[^0-9]/', '', $line);

    if (strlen($numbersInLine) == 1) {
        $sum += (int) ($numbersInLine . $numbersInLine); 
    }
    if (strlen($numbersInLine) == 2) {
        $sum += (int) $numbersInLine; 
    }
    if (strlen($numbersInLine) >2) {
        $sum += (int) (substr($numbersInLine, 0, 1) . substr($numbersInLine, -1)); 
    }
}
fclose($file);

echo 'The sum is ' . $sum;