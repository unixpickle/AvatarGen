<?php

require_once(dirname(__FILE__) . '/ImageBitmap.php');
require_once(dirname(__FILE__) . '/UniqueID.php');

class AvatarGenerator {
	protected $string;
	protected $width, $height;
	
	function __construct ($aString, $width, $height) {
		$this->string = $aString;
		$this->width = $width;
		$this->height = $height;
	}
	
	public function generateImageBitmap () {
		return NULL;
	}
}

?>
