<?php

$sum = 0;

// $file = fopen("d2_Example.txt", "r") or die("Unable to open file!");
$file = fopen("d2_Input.txt", "r") or die("Unable to open file!");

// line-by-line until end-of-file
while (!feof($file)) {
    $redMax = 0;
    $greenMax = 0;
    $blueMax = 0;

    $line = trim(fgets($file));

    $offset = strpos($line, ':') + 1;
    $shortLine = substr($line, $offset);

    $presentedCubes = preg_split("/[,;]+/", $shortLine);
    for ($i = 0; $i < count($presentedCubes); $i++) {
        $cubes = (int)trim(substr($presentedCubes[$i], 1, 2)); //Works for <100 cubes of one color

        if (str_contains($presentedCubes[$i], 'red')) {
            if ($cubes > $redMax) {
                $redMax = $cubes;
            }
        }
        if (str_contains($presentedCubes[$i], 'green')) {
            if ($cubes > $greenMax) {
                $greenMax = $cubes;
            }
        }
        if (str_contains($presentedCubes[$i], 'blue')) {
            if ($cubes > $blueMax) {
                $blueMax = $cubes;
            }
        }
    }

    $sum  += $redMax * $greenMax * $blueMax;
}
fclose($file);

echo 'The sum is ' . $sum;
