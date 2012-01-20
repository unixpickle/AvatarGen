<?php

require_once(dirname(__FILE__) . '/AvatarGenerator.php');

class CrissCrossAvatarGenerator extends AvatarGenerator {
	function __construct ($aString, $width, $height) {
		parent::__construct($aString, $width, $height);
	}

	public function generateImageBitmap () {
		$bitmap = new ImageBitmap($this->width, $this->height);
		$uid = new UniqueID($this->string);

		$components = array();
		for ($i = 0; $i < 24; $i++) {
			$components[] = $uid->getByte($i);
		}

		// the colors exist in order in our color array
		$col1 = array_slice($components, 0, 3);
		$col2 = array_slice($components, 3, 3);
		$col3 = array_slice($components, 6, 3);
		$col4 = array_slice($components, 9, 3);
		$row1 = array_slice($components, 12, 3);
		$row2 = array_slice($components, 15, 3);
		$row3 = array_slice($components, 18, 3);
		$row4 = array_slice($components, 21, 3);

		$colWidth = round($this->width / 4);
		$colHeight = round($this->height / 4);

		$bitmap->fillRect(0, 0, $colWidth, $this->height, $col1);
		$bitmap->fillRect($colWidth, 0, $colWidth, $this->height, $col2);
		$bitmap->fillRect($colWidth*2, 0, $colWidth, $this->height, $col3);
		$bitmap->fillRect($colWidth*3, 0, $colWidth, $this->height, $col4);
		$bitmap->overlayRect(0, 0, $this->width, $colHeight, $row1, 0.5);
		$bitmap->overlayRect(0, $colHeight, $this->width, $colHeight, $row2, 0.5);
		$bitmap->overlayRect(0, $colHeight * 2, $this->width, $colHeight, $row3, 0.5);
		$bitmap->overlayRect(0, $colHeight * 3, $this->width, $colHeight, $row4, 0.5);

		return $bitmap;
	}
}

?>
