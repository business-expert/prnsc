<?php 
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];
include_once(MODELS_ADMIN."/".$model."_model.php");
switch(strtoupper($action))
{
	case 'ADD':
		
		break;		
	case 'SAVE':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'save')
				{
					$objAthleticType = new AthleticType();
					$objAthleticType->setAthleticType($_REQUEST);
					
					$objComm->redirect('index.php?model='.$model);
				}
				
				break;
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Update')
				{
				
					$objAthleticType = new AthleticType();
					$objAthleticType->setAthleticType($_REQUEST);
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objAthleticType = new AthleticType();
					$datum = $objAthleticType->getAthleticType($_REQUEST['id'],$action);
				}
				
				break;	
									
	
	default:
				$objAthleticType = new AthleticType();
				$data = $objAthleticType->getAllAthleticType();
				break;
}

?>