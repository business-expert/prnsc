<?php
session_start();
error_reporting(1);
ini_set('error_reporting', E_ALL^E_NOTICE^E_WARNING);
date_default_timezone_set('America/Los_Angeles');

$RequestURI = '/prscn';
require_once($_SERVER['DOCUMENT_ROOT'].$RequestURI.'/config/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].$RequestURI.'/config/database.php');
include_once($_SERVER['DOCUMENT_ROOT'].$RequestURI.'/FBPanel/FBPanel.php');

$objLog		=	new logs(LOG_FILE_NAME);
$QErrLog	=	new logs(SQL_ERROR_FILE_NAME);

$DB 		=	new database(HOST, USER, PASS, DATABASE);
$ln 		=	$DB->dbConnect();

$objComm    = 	new common();
$objHTML    = 	new html();

$FBPanel = new FBPanel();

function __autoload($classname)
{
	if(file_exists(MODELS_ADMIN. "/". $classname . '_model.php')){
		include_once MODELS_ADMIN. "/". $classname . '_model.php';
	}
	else
	{
		if(file_exists(LIBS. "/". $classname . '.php')){
			include_once LIBS. "/". $classname . '.php';
		}
		else if(file_exists(LIBS_ADMIN. "/". $classname . '.php')){
			include_once LIBS_ADMIN. "/". $classname . '.php';
		}
		else{
			echo "Class Name '".$classname .".php' not Found";
			echo "<br>".MODELS_ADMIN. "/". $classname . '_model.php';	
			echo "<br>".LIBS. "/". $classname . '.php';
			echo "<br>".LIBS_ADMIN. "/". $classname . '.php'."<br>";			
		}
	}
}

?>