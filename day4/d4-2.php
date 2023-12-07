<?php

$cards =[];
$sum = 0;

// $file = fopen("d4_Example.txt", "r") or die("Unable to open file!");
$file = fopen("d4_Input.txt", "r") or die("Unable to open file!");

// line-by-line until end-of-file
while (!feof($file)) {    
    $line = trim(fgets($file));

    $line = str_replace('  ', ' ', $line);
    $line = str_replace(": ", ":", $line);
    $line = str_replace(" | ", "|", $line);
    $lineAsArray = preg_split("/[:|]/", $line);
    $lineAsArray[0] = explode(" ", $lineAsArray[0]);
    $lineAsArray[1] = explode(" ", $lineAsArray[1]);
    $lineAsArray[2] = explode(" ", $lineAsArray[2]);

    $winningNumbers = count(array_intersect($lineAsArray[1], $lineAsArray[2]));
    $cards[] = [1, $winningNumbers];
}
fclose($file);

$individualCards = count($cards);
for ($i=0; $i < $individualCards; $i++) {
    $winningNumbers = $cards[$i][1];
    if ($winningNumbers > 0) {
        for ($k=0; $k < $cards[$i][0]; $k++) {
            for ($j=0; $j < $cards[$i][1]; $j++) {
                $cards[$i+$j+1][0]++;
            }
        }
    }
    $sum += $cards[$i][0];
}

// var_dump($cards);
// die;

echo 'Total number of cards: ' . $sum;



// Memory size exhausted with variant below
// while (!feof($file)) {
//     $lines[] = trim(fgets($file));
// }
// fclose($file);

// $rows = count($lines);

// for ($i = 0; $i < $rows; $i++) {
//     $lines[$i] = str_replace('  ', ' ', $lines[$i]);
//     $lines[$i] = str_replace(": ", ":", $lines[$i]);
//     $lines[$i] = str_replace(" | ", "|", $lines[$i]);
//     $lines[$i] = preg_split("/[:|]/", $lines[$i]);
//     $lines[$i][0] = explode(" ", $lines[$i][0]);
//     $lines[$i][1] = explode(" ", $lines[$i][1]);
//     $lines[$i][2] = explode(" ", $lines[$i][2]);
// }

// for ($i = 0; $i < $rows; $i++) {
//     $winningNumbers = count(array_intersect($lines[$i][1], $lines[$i][2]));

//     $card = (int) $lines[$i][0][1];
//     if ($winningNumbers > 0) {
//         for ($j = 0; $j < $winningNumbers; $j++) {
//             $lines[] = $lines[$card + $j];
//         }
//     }

//     $rows += $winningNumbers;
// }
// $sum = count($lines);
// echo 'The sum is ' . $sum;
