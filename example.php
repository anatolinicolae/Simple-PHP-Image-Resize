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
 * Examples
 *
 * @since 1.0
 */

// Base64 encoding function with compression magic
if (!function_exists('ts_b64Image')) {
	function ts_b64Image($url, $size) {
		$resize = ts_file_contents(ASI_PLUGIN_URL . '/core/resize.php?w=' . $size . '&i=' . $url . '');
		
		if(ini_get("zlib.output_compression")) {
		    $b64Image = base64_encode(gzcompress($resize, 9));
		} else {
		    $b64Image = base64_encode($resize);
		}
		
		return $b64Image;
	}
}

$url = urlencode('http://1.s3.envato.com/files/35577209/ts.jpg'); // Encoded URL to the image or a path - $url = 'path/to/image.png';
$width = 400; // Size in pixels, integer values only

print '<img src="data:image/jpg;base64,' . ts_b64Image($url, $width) . '" width="' . $width . '" />'; // Outputs the image encoded in base64

print '<img src="resize.php?i=' . $url . '&w=' . $width . '" width="' . $width . '" />'; // Outputs the image form the script PHP

?>