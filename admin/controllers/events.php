<?php 
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'save')
				{
					$objEvents = new events();
					$objEvents->setEvents($_REQUEST);
					
					$objComm->redirect('index.php?model='.$model);
				}
				
				break;
	
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'update')
				{
					$objEvents = new events();
					$objEvents->setEvents($_REQUEST);
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objEvents = new events();
					$datum = $objEvents->getEvents($_REQUEST['id']);
				}
				
				break;	

	
	default:
				$objEvents = new events();
				$Records = $objEvents->getAllEvents();
				break;
}

?>