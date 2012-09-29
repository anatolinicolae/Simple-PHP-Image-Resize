<?php

/*
Script Name: Simple PHP Image Resize
Script URL: https://github.com/anatolinicolae/Simple-PHP-Image-Resize
Description: A PHP script that resizes images from URLs or from the server.
Version: 1.0
Author: Anatoli Nicolae
Author URI: http://www.anatolinicolae.com
*/

/**
 * Main Script
 *
 * @since 1.0
 */

$file = $_GET['i'];
$width = $_GET['w'];

list($width_orig, $height_orig) = getimagesize($file);
	
$aspectRatio = $height_orig / $width_orig;

$height = intval($aspectRatio * $width);

$image_p = imagecreatetruecolor($width, $height);
$image = imagecreatefromstring(file_get_contents($file));
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig,$height_orig);

header('Content-Type: image/jpeg');

imagejpeg($image_p, null, 90);

imagedestroy($image_p);
imagedestroy($image);

?>