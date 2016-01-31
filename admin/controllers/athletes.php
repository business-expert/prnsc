<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'save')
				{
					$objAthletes = new athletes();
					$objAthletes->setAthletes($_REQUEST);
					
					$objComm->redirect('index.php?model='.$model);
				}
				
				break;
	
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'update')
				{
					$objAthletes = new athletes();
					$objAthletes->setAthletes($_REQUEST);
				
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objAthletes = new athletes();
					$datum = $objAthletes->getAthletes($_REQUEST['id']);
				}
				
				break;	
				
		case "PENALTY_EDIT":
		
				$objAthletes = new athletes();
				$CombineData = $objAthletes->getPenalty($_REQUEST['athlete_id']);
				$data=$CombineData["dataPenalty"];$athleticData=$CombineData["athleticData"];
				
				break;
		case "PENALTY_UPDATE":
	
				$objAthletes = new athletes();
				$data = $objAthletes->setPenalty($_REQUEST['athlete_id']);
				$objComm->redirect('index.php?model='.$model.'&action=penalty_edit&athlete_id='.$_REQUEST['athlete_id']);
				break;		
	
	default:
				$objAthletes = new athletes();
				$Records = $objAthletes->getAllAthletes();
				break;
}

?>