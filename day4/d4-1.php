<?php

$lines = [];
$sum = 0;
$schematic = [];

// $file = fopen("d4_Example.txt", "r") or die("Unable to open file!");
$file = fopen("d4_Input.txt", "r") or die("Unable to open file!");

// line-by-line until end-of-file
while (!feof($file)) {    
    $lines[] = trim(fgets($file));
}
fclose($file);

$rows = count($lines);
for ($i=0; $i < $rows; $i++) { 
    $lines[$i] = str_replace('  ', ' ', $lines[$i]);
    $lines[$i] = str_replace(": ", ":", $lines[$i]);
    $lines[$i] = str_replace(" | ", "|", $lines[$i]);
    $lines[$i] = preg_split("/[:|]/", $lines[$i]);
    $lines[$i][1] = explode(" ", $lines[$i][1]);
    $lines[$i][2] = explode(" ", $lines[$i][2]);
    $winningNumbers[$i] = array_intersect($lines[$i][1], $lines[$i][2]);

    $length = count($winningNumbers[$i]);
    $points = 0;
    if ($length > 1) {
        $points = 1;
        for ($j=1; $j < $length; $j++) {
            $points *= 2;
        }
        $sum += $points;
    } else {
        $sum += $length;
    }
}

echo 'The sum is ' . $sum;
