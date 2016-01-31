<?php

	include_once(dirname(__FILE__).'/bootstrap.php');
	
	$downloadType=$_REQUEST["downloadType"];
	switch($downloadType)
	{
		case "INVOICE":
			$pi_invoice_file=$_REQUEST["pi_invoice_file"];
			$objComm->downloadFile($pi_invoice_file,INVOICE_PATH."".$pi_invoice_file);
		break;
		default:
			header("Location: index.php?model=unauthorized");
		break;
	}
	
	
	
?>