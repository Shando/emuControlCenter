<?php
define('REGEX_VALID_FILENAME', "/^[ a-zA-Z0-9_\-\+\(\)\[\]\!\.]*$/");

class Valid {

	static public function fileName($fileName) {
		if (!trim($fileName)) return false;
		return preg_match(REGEX_VALID_FILENAME, $fileName, $matches);
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $string
	 * @param unknown_type $maxLenght
	 * @param unknown_type $minLength
	 * @return unknown
	 */
	static public function string($string, $maxLenght=255, $minLength=0, $regex=false) {
		#assert(is_string($string));
		if (!is_string($string) || strlen($string) < $minLength || strlen($string) > $maxLenght) return false;
		if ($regex && !preg_match($regex, $string))	return false;
		return true;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $number
	 * @param unknown_type $minValue
	 * @param unknown_type $maxValue
	 * @return unknown
	 */
	static public function int($number, $minValue=0, $maxValue=255) {
		if (!isset($number)) return false;
		if ($number < $minValue || $number > $maxValue) return false;
		return true;
	}
	
	static public function eccident($eccident, $validEccidents = false) {
		if (!VALID::string($eccident, 10, 2, "/^[a-z0-9]*$/")) return false;
		return true;
	}
	
	static public function crc32($crc32) {
		return (VALID::string($crc32, 8, 8, "/^[A-Za-z0-9]*$/")) ? true : false;
	}
	
	static public function color($colorHex) {
		return (VALID::string($colorHex, 7, 7, "/^#[A-F0-9]{6}$/")) ? true : false;
	}
	
	public function strip_chars_subfolder_url($string=array()) {
		$regex = '/([^0-9a-z_\-,]+)/iU';
		$split = explode(",", $string);
		$result = array();
		foreach ($split as $string) {
			$result[] = preg_replace($regex, "", trim($string));
		}
		return implode(",", $result);
	}
	
}
?>