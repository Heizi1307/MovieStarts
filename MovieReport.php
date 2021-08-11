<?php

//
// Rick Mercer and Longxin Li
//
// File MovieReport.php
//
// Read in a folder containing 8-20 .txt files holding movie data
// and generate a report on that movie.
//
print("Enter movie directory tmnt, tmnt2, mortalkombat, or princessbride: ");
$folder = readline();

// If you have PHP 5, install XAMPP for Windows version 7 or use this line
// $folder = stream_get_line(STDIN,20 ,PHP_EOL);

// Need $movieDir in a a couple of functions below
$movieDir = $folder . '/';
$array = glob('./princessbride/*.txt');

printTitle(); // Print the first three lines
printOverview(); // Print all elements in overview.txt
printReviews();

// Print all reviews from the files review1.txt, review2.txt, review3.txt, . . .
function printTitle()
{
    global $movieDir; // global provides access to the global variable $movieDir defined above
    global $array;
    global $folder;
    $file = file($array[0]);
    for ($line = 0; $line < count($file); $line ++) {
        if ($line == 0) {
            print($file[$line]);
        } else {
            if ($line == 1) {
                print($file[$line]);
            } else {
                print($file[$line] . "\n");
            }
        }
    }
}

function printOverview()
{
    global $movieDir;
    global $array;
    $file = file($array[1]);
    for ($line = 0; $line < count($file); $line ++) {
        $list = explode(':', $file[$line]);
        print($list[0] . ":");
        print(wordwrap($list[1], 65, "\n", true));
    }
}

function printReviews()
{
    global $movieDir;
    global $array;
    for ($i = 2; $i < count($array); $i ++) {
        $file = file($array[$i]);
        $list = explode("\n", $file[2]);
        print(wordwrap("\n".$file[0], 65, "\n", true));
        print($file[1]);
        print($list[0]."\n");

    }
}

// Add other functions here
?>