<?php include_once(MODELS_ADMIN."/".$model."_model.php"); 


$objDash = new dashboard();

$LetestAthlets = $objDash->getLetestAddedAthletes();
$LetestEvent = $objDash->getLetestAddedEvent();
$arrFanVisisted = $objDash->getMostVisitedFanList();


?>

