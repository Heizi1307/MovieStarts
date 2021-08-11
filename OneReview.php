<!DOCTYPE html>
<!-- File: QueryParams.php -->
<!-- Longxin Li -->

<html>

<head>

<title>Movies</title>

<link href="movies.css" type="text/css" rel="stylesheet">

</head>

<body>
<?php
$folder = $_GET['movie'];
$movieDir = $folder . '/';
$array = glob('./' . $folder . '/*.txt');
$rate = '';
$rating = '';
$comment = '<div class="column">';
$overview = '<div class="box"><div class="info">';
echo "<div class='top'><img src=images/rancidbanner.png></div>";
$total = '<div class="container">';
$total .= "<div class='overview'><img src=" . $movieDir . 'overview.png' . '></div>';
printTitle();
printOverview();
printReviews();
$total .= '<div class="topcurve"><img src="images/' . $rating . '.png" height="83px"/> <span
class="reviews">' . $rate . '%' . '</span></div>';
$total .= '<div class="row"><div class="content">';
$total .= $comment . '</div>';
$total .= $overview;
$total .= '</div>';
echo $total;

function printTitle()
{
    global $movieDir; // global provides access to the global variable $movieDir defined above
    global $array;
    global $folder;
    global $rate;
    global $rating;
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
                if ($rate >= 50) {
                    $rating .= 'freshlarge';
                } else {
                    $rating .= 'rottenlarge';
                }
            }
        }
    }
    echo "<p class='shadow'>" . $title . '(' . $year . ')' . '</p>' . PHP_EOL;
}

function printOverview()
{
    global $movieDir;
    global $array;
    global $overview;
    $str = '<dl>';
    $file = file($array[1]);
    for ($line = 0; $line < count($file); $line ++) {
        $list = explode(':', $file[$line]);
        $title = $list[0] . "\n";
        $info = wordwrap($list[1], 65, "\n", true) . "\n";
        $str .= '<dt>' . $title . '</dt>' . '<dd>' . $info . '</dd>';
    }
    $str . '</dl>';
    $overview .= "<div class = 'info'>" . $str . '</div></div></div>' . PHP_EOL;
}

function printReviews()
{
    global $movieDir;
    global $array;
    global $comment;
    if ((count($array) - 2) % 2 == 1) {
        $count = (count($array) - 1) / 2;
    } else {
        $count = (count($array) - 2) / 2;
    }
    $x = 1;
    for ($i = 2; $i < count($array); $i ++) {
        $file = file($array[$i]);
        $list = explode("\n", $file[2]);
        $name = $list[0];
        $comp = $file[3];
        $rate = $file[1];
        $review = wordwrap($file[0], 65, "\n", true);
        $str2 = '<p class="curved">' . '<img class="icon" src="images/' . $rate . '.gif"/>' . '<q>' . $review . '</q></p>';
        $str2 .= "<p class='name'><img class='nameicon' src='images/critic.gif' alt='Critic' />" . $name . "</br>" . $comp;
        $comment .= $str2;
        if ($count == $x) {
            $comment .= '</div><div class="column">';
        }
        $x ++;
    }
    $comment .= '</div>';
}

?>



</body>

</html>