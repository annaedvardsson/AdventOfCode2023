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
for ($i = 0; $i < $yCountInitial; $i++) {
    array_unshift($schematic[$i], ".");
    array_push($schematic[$i], ".");
}

$xCount = count($schematic[0]);

$extraLine = str_repeat(".", $xCount);
array_unshift($schematic, str_split($extraLine));
array_push($schematic, str_split($extraLine));

$yCount = count($schematic);

// Check for partnumbers and save if next to *
for ($y = 0; $y < $yCount; $y++) {
    for ($x = 0; $x < $yCount; $x++) {
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
        // Check if * on left 
        if ($schematic[$y][$i] == '*') {
            $potentialGearNumbers[] = [$y, $i, $partNumber];
            continue;
        // Check if * on right 
        } elseif ($schematic[$y][$x] == '*') {
            $potentialGearNumbers[] = [$y, $x, $partNumber];
            continue;
        } else {
            for ($i; $i < ($x + 1); $i++) {
                // Check if * below 
                if ($schematic[$y + 1][$i] == '*') {
                    $potentialGearNumbers[] = [$y+1, $i, $partNumber];
                    break;
                }
                // Check if * above 
                if ($schematic[$y - 1][$i] == '*') {
                    $potentialGearNumbers[] = [$y-1, $i, $partNumber];
                    break;
                }
            }
        }
    }
}

// Check for two partnumbers next to same *
while (count($potentialGearNumbers) > 1) {
    unset($match);
    $match = array_pop($potentialGearNumbers);

    for ($j = count($potentialGearNumbers) - 1; $j >= 0 ; $j--) {
        if ($match[0] == $potentialGearNumbers[$j][0] &&
            $match[1] == $potentialGearNumbers[$j][1])
        {
            $sum += $match[2] * $potentialGearNumbers[$j][2];

            //Remove "2nd pair part" and re-index array
            unset($potentialGearNumbers[$j]);
            $potentialGearNumbers = array_values($potentialGearNumbers);
            break;
        }
    }
}

echo 'The sum is ' . $sum;
