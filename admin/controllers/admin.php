<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'save')
				{
					$objAdmin = new Admin();
					$objAdmin->setAdmin($_REQUEST);
					
					$objComm->redirect('index.php?model='.$model);
				}
				
				break;
	
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'update')
				{
					$objAdmin = new Admin();
					$objAdmin->setAdmin($_REQUEST);
				
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objAdmin = new Admin();
					$datum = $objAdmin->getAdmin($_REQUEST['id']);
				}
				
				break;	
				
	case 'DELETE':
	
				$objAdmin = new Admin();
				$objAdmin->delAdmin($_REQUEST['id']);
				
				$objComm->redirect('index.php?model='.$model);
				
				break;									
	
	default:
				$objAdmin = new Admin();
				$data = $objAdmin->getAllAdmin();
				break;
}

?>