<?php 
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];
include_once(MODELS_ADMIN."/".$model."_model.php");
switch(strtoupper($action))
{
	case 'ADD':
		
		break;		
	case 'SAVE':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Save')
				{
					$objRaceType = new RaceType();
					$objRaceType->setRaceType($_REQUEST);
					
					$objComm->redirect('index.php?model='.$model);
				}
				
				break;
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Update')
				{
				
					$objRaceType = new RaceType();
					$objRaceType->setRaceType($_REQUEST);
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objRaceType = new RaceType();
					$datum = $objRaceType->getRaceType($_REQUEST['id'],$action);
					$datumRTP = json_encode(explode(";",$datum->rtp_race_type_points));
				}
				
				break;	
									
	
	default:
				$objRaceType = new RaceType();
				$data = $objRaceType->getAllRaceType();
				break;
}

?>