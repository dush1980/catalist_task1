<?php
/* Done By : Dushmantha Walakulpola 
 * Resone  : Interview Task 1
 * Date    : 2019/09/04
 */

include "clsDB.php";
include "clsCSV.php";

$objFile=null; //CSV file object
$objDB=null; //DB object

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

//initialize dry_run variable
$dry_run=((isset($arga['dry_run']))?true:false);

//create database and table (if not dry run)
if(!$dry_run){
	if((!isset($arga['u']))||(!isset($arga['p']))||(!isset($arga['h']))){
		echo "Can not create table. Missing data to connect to database";
		exit;
	}
	
	//setup default values for database
	$u=(($arga['u'])?$arga['u']:'');
	$p=(($arga['p'])?$arga['p']:'');
	$h=(($arga['h'])?$arga['h']:'localhost');
	$d='db_catalyist';
	$t='users';
	
	//connect to database
	$objDB=clsDB::createConn($u,$p,$h);
	
	if($objDB->isError()){
		echo $objDB->getMsg();
		exit;
	}
	
	if(!$objDB->createTable($d, $t)){
		echo $objDB->getMsg();
		exit;
	}
}

//stop processing futher if only create table
if (isset($arga['create_table'])) {
	echo "Table Created";
	exit;
}

//check if file parameter is set
if(!isset($arga['file'])) {
	echo "CSV File required";
	exit;
}

//open file
$objFile=new clsCSV($arga['file']);
if($objFile->isError()) {
	echo $objFile->getMsg();
	exit;
}

while($csv=$objFile->getRow()){
	print_r($csv);
}

