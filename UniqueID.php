<?php

class UniqueID {
	private $buffer;

	function __construct ($string) {
		$this->buffer = hash('sha512', $string, TRUE);
	}

	public function getByte ($index) {
		$str = substr($this->buffer, $index, 1);
		$unpacked = unpack('C', $str);
		return $unpacked[1];
	}
}

?>
