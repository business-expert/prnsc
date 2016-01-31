<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");
//id	season_title	season_desc	season_date	season_update
switch(strtoupper($action))
{
	case 'ADD':
		
		break;		
	case 'SAVE':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'save')
				{
					$objSeason = new Season();
					$objSeason->setSeason($_REQUEST);
					
					$objComm->redirect('index.php?model='.$model);
				}
				
				break;
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'update')
				{
					$objSeason = new Season();
					$objSeason->setSeason($_REQUEST);
				
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objSeason = new Season();
					$datum = $objSeason->getSeason($_REQUEST['id']);
				}
				
				break;	
				
	case 'DELETE':
	
				$objSeason = new Season();
				$objSeason->delSeason($_REQUEST['id']);
				
				$objComm->redirect('index.php?model='.$model);
				
				break;									
	
	default:
				$objSeason = new Season();
				$data = $objSeason->getAllSeason();
				break;
}

?>