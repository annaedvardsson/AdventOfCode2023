<?php

$sum = 0;
$schematic = [];

// $file = fopen("d3_Example.txt", "r") or die("Unable to open file!");
$file = fopen("d3_Input.txt", "r") or die("Unable to open file!");

// line-by-line until end-of-file
while (!feof($file)) {    
    $line = trim(fgets($file));
    $schematic[] = str_split($line);
}
fclose($file);

// Add outer "frame" with "." to allow easier adjacent checks
$yCountInitial = count($schematic);
for ($i=0; $i < $yCountInitial; $i++) {
    array_unshift($schematic[$i], "."); 
    array_push($schematic[$i], "."); 
}

$xCount = count($schematic[0]);

$extraLine = str_repeat(".", $xCount);
array_unshift($schematic, str_split($extraLine));
array_push($schematic, str_split($extraLine));

$yCount = count($schematic);

// Check for partnumbers and determine if valid
for ($y=0; $y < $yCount; $y++) { 
    for ($x=0; $x < $yCount; $x++) {
        $partNumber = '';
        
        // Continue if not a number
        if (!is_Numeric($schematic[$y][$x])) {
            continue;
        }
        
        // Get part number and length
        while (is_Numeric($schematic[$y][$x])) {
            $partNumber .= $schematic[$y][$x];
            $x++;
        }
        $adjacentLength = strlen($partNumber);

        $i = $x - $adjacentLength - 1;
        // Check if special character on left or right 
        if ((!is_Numeric($schematic[$y][$i]) && $schematic[$y][$i] != '.') ||
            (!is_Numeric($schematic[$y][$x]) && $schematic[$y][$x] != '.')) {
            $sum += $partNumber;
            continue;
        } else {
            for ($i; $i < ($x+1); $i++) { 
                // Check if special character below 
                if (!is_Numeric($schematic[$y+1][$i]) && $schematic[$y+1][$i] != '.') {
                    $sum += $partNumber;
                    break;
                }
                // Check if special character above 
                if (!is_Numeric($schematic[$y-1][$i]) && $schematic[$y-1][$i] != '.') {
                    $sum += $partNumber;
                    break;
                }
            }
        }
    }
}

echo 'The sum is ' . $sum;
