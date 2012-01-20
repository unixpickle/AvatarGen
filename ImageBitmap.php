<?php

class ImageBitmap {
	private $im = NULL;
	
	function __construct ($width, $height) {
		$this->im = imagecreatetruecolor($width, $height);
	}

	function __destruct () {
		imagedestroy($this->im);
		$this->im = NULL;
	}
	
	public function getPixel ($x, $y) {
		$rgb = imagecolorat($this->im, $x, $y);
		$red = ($rgb >> 16) & 0xff;
		$green = ($rgb >> 8) & 0xff;
		$blue = $rgb & 0xff;
		return array($red, $green, $blue);
	}
	
	public function setPixel ($x, $y, $pixel) {
		$color = imagecolorallocate($this->im, $pixel[0], $pixel[1], $pixel[2]);
		imagesetpixel($this->im, $x, $y, $color);
	}
	
	public function fillRect ($x, $y, $w, $h, $pixel) {
		$color = imagecolorallocate($this->im, $pixel[0], $pixel[1], $pixel[2]);
		imagefilledrectangle($this->im, $x, $y, $x + $w, $y + $h, $color);
	}

	public function fillCircle ($x, $y, $radius, $pixel) {
		$color = imagecolorallocate($this->im, $pixel[0], $pixel[1], $pixel[2]);
		imagefilledellipse($this->im, $x, $y, $radius * 2, $radius * 2, $color);
	}
	
	public function overlayPixel ($x, $y, $pixel, $alpha) {
		$existing = $this->getPixel($x, $y);
		$dr = ($pixel[0] - $existing[0]) * $alpha + $existing[0];
		$dg = ($pixel[1] - $existing[1]) * $alpha + $existing[1];
		$db = ($pixel[2] - $existing[2]) * $alpha + $existing[2];
		$this->setPixel($x, $y, array($dr, $dg, $db));
	}

	public function overlayRect ($x, $y, $w, $h, $pixel, $alpha) {
		for ($xcoord = $x; $xcoord < $x + $w; $xcoord++) {
			for ($ycoord = $y; $ycoord < $y + $h; $ycoord++) {
				$this->overlayPixel($xcoord, $ycoord, $pixel, $alpha);
			}
		}
	}
	
	public function outputPNG () {
		imagepng($this->im);
	}
}

?>
