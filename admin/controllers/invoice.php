<?php 
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];
include_once(MODELS_ADMIN."/".$model."_model.php");
switch(strtoupper($action))
{

	case 'VIEW':	
		$objInvoice = new Invoice();
		$data = $objInvoice->getInovoice($_REQUEST['pi_id']);					
	break;
	
	case 'UPDATE':
		$objInvoice = new Invoice();
		$objInvoice->updateInvoice($_REQUEST);
		$objComm->redirect('index.php?model='.$model);
	break;	
				
	default:
				$objInvoice = new Invoice();
				$data = $objInvoice->getAllinvoice();
				break;
}

?>