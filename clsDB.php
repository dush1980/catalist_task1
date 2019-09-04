<?
// Singleton to connect db
class clsDB {
	
  	private static $db = null; // holds the class instance.
  	private $conn; //holds the actual connection
  
  	private $error = false;
  	private $msg = '';
   
  	// The db connection constructor
  	private function __construct($host, $user, $pwd, $db) {
    		$this->conn = new mysqli($host, $user, $pwd, $db);
		if ($this->conn->connect_errno) {		
			$this->msg="Could not connect to the database";
			$this->error=true;
		}
  	}
  	
  	//create a new connection if already not created
  	public static function createConn($host, $user, $pwd, $db) {
		if(!self::$db)  self::$db = new clsDB();
		return self::$db;
  	}
  	
  	//check if any error
  	public function isError() { return $this->$error; } 
  	
  	//get the error message
  	public function getMsg() { return $this->msg; }
  
  	//create table / empty table
  	public function createTable($tbl) {
  	
  	}
  	
  	//insert the row
  	//return : true on success, false on fail with error set
  	//can be false if uniqe not matched
  	public function insertRow($name, $surname, $email) {
  	
  	}
}

