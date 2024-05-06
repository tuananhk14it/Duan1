<?php
$image = @imagecreatetruecolor(120, 30) or die("Cannot Initialize new GD image stream");
$background = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
echo $image;
?>