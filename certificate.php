<?php
session_start();
$acc_name = $_SESSION['login'];
$im = imagecreatefromjpeg('background.jpg');
$imagesize = getimagesize('background.jpg');
$x_offset = 30;
$y_offset = $imagesize[1] - 210;
$textcolor = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
imagestring($im, 5, $x_offset, $y_offset, "You successfully completed Web Development course, $acc_name.", $textcolor);
header('Content-type: image/jpg');
imagejpeg($im);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Modificari</h1>
    <h2>Si mai multe modificari</h2>
    <h3>More modificari!!!</h3>
    <h1>Modificari</h1>
    <h2>Si mai multe modificari</h2>
    <h3>More modificari!!!</h3>
    <h1>Modificari</h1>
    <h2>Si mai multe modificari</h2>
    <h3>More modificari!!!</h3>
</body>
</html>