<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");
$objCalender = new calendar();

switch(strtoupper($action))
{	
	case 'ENROLMENT':
		 $Records=$objCalender->getEnrolledEventsDetail();	
		 break;
	default:
		$records=$objCalender->getAllEvents();
		
		break;
}





?>