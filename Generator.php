<?php

require_once(dirname(__FILE__) . '/CrissCrossAvatarGenerator.php');
require_once(dirname(__FILE__) . '/CircleAvatarGenerator.php');

function output_avatar ($style, $string, $width = 57, $height = 57) {
	$gen = NULL;
	$classes = array('crisscross' => 'CrissCrossAvatarGenerator',
					 'circles' => 'CircleAvatarGenerator');

	if (!isset($classes[$style])) {
		echo "Not set";
		return;
	}
	$genClass = $classes[$style];
	$gen = new $genClass($string, $width, $height);

	$bmp = $gen->generateImageBitmap();
	$bmp->outputPNG();
}

?>
