<?php
/* Done By : Dushmantha Walakulpola 
 * Resone  : Interview Task 1
 * Date    : 2019/09/04
 */

// Singleton to connect db
class clsDB {
	
  	private static $db = null; // holds the class instance.
  	private $conn; //holds the actual connection
  
  	private $error = false;
  	private $msg = '';
   
  	// The db connection constructor
  	private function __construct($host, $user, $pwd) {
    		
    		$this->conn = new mysqli($host, $user, $pwd);
		if ($this->conn->connect_errno) {		
			$this->msg="Could not connect to the database";
			$this->error=true;
		}
  	}
  	
  	//create a new connection if already not created
  	public static function createConn( $user, $pwd, $host) {
		if(!self::$db)  self::$db = new clsDB($host, $user, $pwd);
		return self::$db;
  	}
  	
  	//check if any error
  	public function isError() { return $this->error; } 
  	
  	//get the error message
  	public function getMsg() { return $this->msg; }
  
  	//create table / empty table
  	public function createTable($dbname, $tbl) {
  		if(!$this->conn->query('CREATE DATABASE IF NOT EXISTS `'.$dbname.'`')){
  			$this->msg="Could not create database";
			$this->error=true;
			return false;
  		}
  		if(!$this->conn->select_db($dbname)){
  			$this->msg="Could not connect to database";
			$this->error=true;
			return false;
  		}
  		if(!$this->conn->query('DROP TABLE IF EXISTS `'.$tbl.'`')){
  			$this->msg="Could not delete existing table";
			$this->error=true;
			return false;
  		}
  		if(!$this->conn->query('CREATE TABLE `'.$tbl.'` ( `name` VARCHAR(100) NOT NULL , 
  												`surname` VARCHAR(100) NOT NULL , 
  												`email` VARCHAR(100) NOT NULL , 
  												UNIQUE (`email`))')){
  			$this->msg="Could not create new table";
			$this->error=true;
			return false;
  		}
  		return true;
  	}
  	
  	//insert the row
  	//return : true on success, false on fail with error set
  	//can be false if uniqe not matched or name,surname,email exced length
  	public function insertRow($name, $surname, $email) {
  		$stmt=$this->conn->prepare("INSERT INTO  users (`name`, `surname`, `email`) VALUES(?, ?, ?)");		
		$stmt->bind_param("sss",$name,$surname, $email);
		if(!$stmt->execute()){
			$this->msg=$this->conn->error;
			$this->error=true;
			return false;
		}
		return true;
  	}
}

