<?php 
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];
include_once(MODELS_ADMIN."/".$model."_model.php");
switch(strtoupper($action))
{
	case "save": break;
	default:
			$objRacePlacement = new RacePlacement();
			$data=$objRacePlacement->getRace();
	}

?>