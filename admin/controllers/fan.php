<?php 
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];
include_once(MODELS_ADMIN."/".$model."_model.php");
switch(strtoupper($action))
{
	case 'ADD':
			if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'save')
			{
				$objFan = new Fan();
				$objFan->setProduct($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model);
			}
			break;
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Update')
				{
					$objFan = new Fan();
					$objFan->setFan($_REQUEST);
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objFan = new Fan();
					$datum = $objFan->getFan($_REQUEST['id']);
				}
				
				break;	
				
	default:
				$objFan = new Fan();
				$data = $objFan->getAllFan();
				break;
}

?>