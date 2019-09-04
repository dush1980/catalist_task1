<?php
//class to handle CSV fill
class clsCSV {
	
	private $fpointer=null; //holds file pointer
	
	private $error = false;
  	private $msg = '';
  	
	public function __construct($fname) {
		if(!is_file($fname)) {
			$this->error=true;
			$this->msg='File dose not exist';	
			return;		
		}
		if(!($this->fpointer=fopen($fname,'r'))) {
			$this->error=true;
			$this->msg='File Could not open to read';
			return;
		}
		
		//skip first line
		fgetcsv($this->fpointer);		
	}
	
	//check if any error
  	public function isError() { return $this->error; } 
  	
  	//get the error message
  	public function getMsg() { return $this->msg; }
  	
	//read a single record from CSV
	public function getRow() {
		return fgetcsv($this->fpointer);		
	}
}
