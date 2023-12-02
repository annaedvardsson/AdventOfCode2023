<?php

$sum = 0;

// $file = fopen("d1_Example2.txt", "r") or die("Unable to open file!");
$file = fopen("d1_Input.txt", "r") or die("Unable to open file!");

// line-by-line until end-of-file
while (!feof($file)) {
    $numbersInLine = '';
    $line = fgets($file);

    for ($i=0; $i < strlen($line)-1; $i++) { 
        if (is_numeric($line[$i])) {
            $numbersInLine .=  $line[$i];
        }
        if (substr($line, $i, 3) == 'one') {
            $numbersInLine .=  '1';
        }
        if (substr($line, $i, 3) == 'two') {
            $numbersInLine .=  '2';
        }
        if (substr($line, $i, 5) == 'three') {
            $numbersInLine .=  '3';
        }
        if (substr($line, $i, 4) == 'four') {
            $numbersInLine .=  '4';
        }
        if (substr($line, $i, 4) == 'five') {
            $numbersInLine .=  '5';
        }
        if (substr($line, $i, 3) == 'six') {
            $numbersInLine .=  '6';
        }
        if (substr($line, $i, 5) == 'seven') {
            $numbersInLine .=  '7';
        }
        if (substr($line, $i, 5) == 'eight') {
            $numbersInLine .=  '8';
        }
        if (substr($line, $i, 4) == 'nine') {
            $numbersInLine .=  '9';
        }
    }

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