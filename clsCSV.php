<?php
//class to handle CSV fill
class clsCSV {
	
	private $fpointer=null; //holds file pointer
	
	public function __construct() {
		//dose nothing
	}
	
	public function openFile($fname){
		if(!is_file($fname)) return false;
		if(!($this->fpointer=fopen($fname,'r'))) return false;
		
		//skip first line
		fgetcsv($this->fpointer);		
	}
	
	//read a single record from CSV
	public function getRow() {
		return fgetcsv($this->fpointer);		
	}
}
