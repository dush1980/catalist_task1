<?php
/* Done By : Dushmantha Walakulpola 
 * Resone  : Interview Task 1
 * Date    : 2019/09/04
 */

$objFile=false; //CSV file object
$objDB=false; //DB object

//print welcome message
echo "Welcome to task 1 of Catalyst interview\n";
echo "---------------------------------------\n";

//get the commandline arguments
$arga=getopt('u::p::h::', array("file:", "create_table", "dry_run", "help"));

//check if help
if(isset($arga['help'])) {
	include("help.php");
	exit;
}

//open file
if(isset($arga['file'])) {
	//$objFile=new clsCSV($arga['file']);
}	

//setup default values for database
$u=((isset($arga['u'])) && ($arga['u']))?$arga['u']:'');
$p=((isset($arga['p'])) && ($arga['p']))?$arga['p']:'');
$h=((isset($arga['h'])) && ($arga['h']))?$arga['h']:'localhost');
$d='db_catalyist';

//connect to database
//$objDB=new clsDB::getDB($u,$p,$h,$d);

//create a fresh table
if($objDB) $createStatus=$objDB->createTable('users');

//just create database and table
if(isset($arga['create_table'])){
	if($objDB) {
		$objDB->createTable();
	} else {
		echo "";
		exit;
	}
}


var_dump($arga);
