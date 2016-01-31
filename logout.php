<?php
error_reporting(1);
ini_set('error_reporting', E_ALL^E_NOTICE^E_WARNING);
$RequestURI = '/prscn';
include_once($_SERVER['DOCUMENT_ROOT'].$RequestURI.'/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].$RequestURI.'/FBPanel/FBPanel.php');

$FBPanel = new FBPanel();

$FBPanel->panelLogoutUser();


?>


