<?php

require_once(dirname(__FILE__) . '/AvatarGenerator.php');

class CircleAvatarGenerator extends AvatarGenerator {
	function __construct ($aString, $width, $height) {
		parent::__construct($aString, $width, $height);
	}

	public function generateImageBitmap () {
		$bitmap = new ImageBitmap($this->width, $this->height);
		$uid = new UniqueID($this->string);

		$colors = array();
		for ($i = 0; $i < 60; $i++) {
			$colors[] = $uid->getByte($i);
		}

		// first 3 bytes = bgcolor
		$bgcolor = array_slice($colors, 0, 3);
		$bitmap->fillRect(0, 0, $this->width, $this->height, $bgcolor);

		// declare the regular radius, and then the difference margin
		// that each difference increment will amount to (7 negative
		// difference increments total, and 8 positive).
		$commonRadius = $this->width / 8.0;
		$radiusStep = $commonRadius / 15;
		for ($y = 0; $y < 4; $y++) {
			for ($x = 0; $x < 4; $x++) {
				// collect basic offset information about this circle
				$index = (($y * 4) + $x);
				$offset = ($index * 3) + 3;
				$radIndex = 52 + floor($index / 2);

				// extract the color and radius byte
				$color = array_slice($colors, $offset, 3);
				$radByte = $colors[$radIndex];
				if ($index % 2 == 0) {
					$radByte &= 0xf;
				} else {
					$radByte = ($radByte >> 4) & 0xf;
				}

				// get the radius using the common radius and difference margin
				$radius = round($commonRadius + ($radiusStep * ($radByte - 7)));

				$xcoord = round($x * ($commonRadius * 2) + $commonRadius);
				$ycoord = round($y * ($commonRadius * 2) + $commonRadius);
				$bitmap->fillCircle($xcoord, $ycoord, $radius, $color);
			}
		}

		return $bitmap;
	}
}

?>
