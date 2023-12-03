<?php

define('RED_MAX', 12);
define('GREEN_MAX', 13);
define('BLUE_MAX', 14);

$gameId = 0;
$sum = 0;

// $file = fopen("d2_Example.txt", "r") or die("Unable to open file!");
$file = fopen("d2_Input.txt", "r") or die("Unable to open file!");

// line-by-line until end-of-file
while (!feof($file)) {
    $gameId++;
    $validGame = true;
    
    $line = trim(fgets($file));

    $offset = strpos($line, ':') + 1;
    $shortLine = substr($line, $offset);

    $persentedCubes = preg_split("/[,;]+/", $shortLine);
    for ($i=0; $i < count($persentedCubes); $i++) {
        $cubes = (int)trim(substr($persentedCubes[$i], 1, 2));

        if ($cubes > RED_MAX && str_contains($persentedCubes[$i], 'red') ||
            $cubes > GREEN_MAX && str_contains($persentedCubes[$i], 'green') ||
            $cubes > BLUE_MAX && str_contains($persentedCubes[$i], 'blue')) {

            $validGame = false;
            break;
        }
    }

    if ($validGame) {
        $sum  += $gameId;  
    }
}
fclose($file);

echo 'The sum is ' . $sum;
