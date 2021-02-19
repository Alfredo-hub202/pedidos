<?php
include 'functions.php';

$imagepath= $GLOBALS['server'] . $_GET['image'];
$image=imagecreatefromjpeg($imagepath);
header('Content-Type: image/jpeg');
imagejpeg($image);		
?>
