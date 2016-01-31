<?php
session_start();
error_reporting(1);
ini_set('error_reporting', E_ALL^E_NOTICE^E_WARNING);
$RequestURI = '/prscn';
include_once($_SERVER['DOCUMENT_ROOT'].$RequestURI.'/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].$RequestURI.'/config/database.php');
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
	if(is_object($classname))
		return '';
		
	if(file_exists(MODELS. "/".$classname."/". $classname . 'model.php')){
		include_once MODELS. "/".$classname."/". $classname . 'model.php';
	}
	else
	{
		if(file_exists(LIBS. "/". $classname . '.php')){
			include_once LIBS. "/". $classname . '.php';
		}
		else{
			echo "<br>Class Name '".$classname .".php' not Found";
			echo "<br>".MODELS. "/". $classname . '_model.php';	
			echo "<br>".LIBS. "/". $classname . '.php<br>';
		}
	}
}


?>