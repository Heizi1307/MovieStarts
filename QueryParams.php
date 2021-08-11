<!DOCTYPE html>
<!-- File: QueryParams.php -->
<!-- Longxin Li -->

<html>

<head>

<title>Movies</title>

<link href="movies.css" type="text/css" rel="stylesheet">

</head>

<body> 
<div class="top">
			<img src="images/rancidbanner.png">
		</div>


<?php
$folder = $_GET['movie'];
$movieDir = $folder . '/';
$array = glob('./' . $folder . '/*.txt');

printTitle();
echo '<img src=' . $movieDir . 'overview.png' . '>';
printOverview();

function printTitle()
{
    global $movieDir; // global provides access to the global variable $movieDir defined above
    global $array;
    global $folder;
    $file = file($array[0]);
    $title = '';
    $year = '';
    $rate = '';
    for ($line = 0; $line < count($file); $line ++) {
        if ($line == 0) {
            $title = $file[$line];
        } else {
            if ($line == 1) {
                $year = $file[$line];
            } else {
                $rate = $file[$line];
            }
        }
    }
    echo "<p class='shadow'>" . $title . '(' . $year . ')' . '</p>' . PHP_EOL;
}

function printOverview()
{
    global $movieDir;
    global $array;
    $str = '<dl>';
    $file = file($array[1]);
    for ($line = 0; $line < count($file); $line ++) {
        $list = explode(':', $file[$line]);
        $title = $list[0] . ": \n";
        $info = wordwrap($list[1], 65, "\n", true) . "\n";
        $str .= '<dt>' . $title . '</dt>' . '<dd>' . $info . '</dd>';
    }
    $str . '</dl>';
    echo "<div class = 'info'>" . $str . '</div>' . PHP_EOL;
}

?> 



</body>

</html>