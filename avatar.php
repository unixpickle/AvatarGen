<?php

require_once (dirname(__FILE__) . '/Generator.php');
error_reporting(E_ALL);

if (isset($_GET['style']) && isset($_GET['str'])) {
	$str = $_GET['str'];
	$style = $_GET['style'];
	$width = 57;
	$height = 57;
	if (isset($_GET['w']) && isset($_GET['h'])) {
		$width = intval($_GET['w']);
		$height = intval($_GET['h']);
	}
	header('Content-Type: image/png');
	output_avatar($style, $str, $width, $height);
} else {
	echo 'Usage: ' . basename(__FILE__) . '?<b>style</b>=crisscross&<b>str</b>=astr[<i>&<b>w</b>=50&<b>h</b>=50</i>]';
}

?>
