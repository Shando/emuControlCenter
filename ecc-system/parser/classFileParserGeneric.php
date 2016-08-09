<?php
/*
* Nintendo N64 Parser
* Dieser Parser kann informationen aus N64-Roms
* extrahieren.
*/
class FileParserGeneric implements FileParser {
	
	private $_file_ext = false;
	
	/*
	*
	*/
	public function __construct($file_ext=false) {
		$this->_file_ext = $file_ext;
	}
	
	/*
	*
	*/
	public function parse($fhdl, $file_name, $file_name_direct=false, $file_name_packed=false) {
		
		$ret = array();
		
		// Infos zur datei holen
		$file_info = FileIO::ecc_file_get_info($file_name);
		$ret['FILE_NAME'] = $file_info['NAME'];
		$ret['FILE_PATH'] = $file_name_direct;
		$ret['FILE_PATH_PACK'] = $file_name_packed;
		$ret['FILE_EXT'] = (isset($this->_file_ext[0])) ? strtoupper($this->_file_ext[0]) : strtoupper($file_info['EXT']) ;
		$fstat = fstat($fhdl);
		$ret['FILE_SIZE'] = $fstat['size'];
		
		// Checksummen ermitteln.
		// Aus performancegr�nden zuerst in string einlesen
		while (gtk::events_pending()) gtk::main_iteration();
		$file_content = FileIO::ecc_read_file($fhdl, false, false, $file_name);
		
		#while (gtk::events_pending()) gtk::main_iteration();
		#$ret['FILE_MD5'] = FileIO::ecc_get_md5_from_string($file_content);
		$ret['FILE_MD5'] = NULL;
		
		while (gtk::events_pending()) gtk::main_iteration();
		$ret['FILE_CRC32'] = FileIO::ecc_get_crc32_from_string($file_content);
		
		$ret['FILE_VALID'] = true;
		
		return $ret;
	}
}
?>