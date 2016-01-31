<?php 
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];
include_once(MODELS_ADMIN."/".$model."_model.php");
switch(strtoupper($action))
{
	case 'ADD':
			if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'save')
			{
				$objProduct = new product();
				$objProduct->setProduct($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model);
			}
			break;
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Update')
				{
					$objProduct = new product();
					$objProduct->setProduct($_REQUEST);
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objProduct = new product();
					$datum = $objProduct->getProduct($_REQUEST['id']);
				}
				
				break;	
				
	default:
				$objProduct = new product();
				$data = $objProduct->getAllproduct();
				break;
}

?>