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
					$objRace = new Race();
					$objRace->setRace($_REQUEST);
					
					$objComm->redirect('index.php?model='.$model);
				}
				
				break;
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Update')
				{
				
					$objRace = new Race();
					$objRace->setRace($_REQUEST);
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objRace = new Race();
					$datum = $objRace->getRace($_REQUEST['id'],$action);
				}
				
				break;	
				
	case 'DELETE':
	
				$objRace = new Race();
				$objRace->delRace($_REQUEST['id']);
				
				$objComm->redirect('index.php?model='.$model);
				
				break;									
	
	default:
				$objRace = new Race();
				$data = $objRace->getAllRace();
				break;
}

?>