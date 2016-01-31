<?php include_once(MODELS."/home_model.php"); 

$model=$_REQUEST["model"];
$action=$_REQUEST["action"];

switch(strtoupper($action))
{
	case 'ADD':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Save')
				{
					$objHome = new Home();
					$objHome->setNews($_REQUEST);
					$objComm->redirect1('index.php?model='.$model);
				}
				
				break;			
	case 'UPDATE':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Update')
				{
					$objHome = new Home();
					$objHome->setNews($_REQUEST);				
					$objComm->redirect1('index.php?model='.$model);
				}
				
				break;	
	case 'UPDATE_PROFILE':
			if(isset($_REQUEST['btn_updateProfile']) && $_REQUEST['btn_updateProfile'] == 'Update Profile')
			{
				$objHome = new Home();
				$objHome->setAthleticProfile($_REQUEST);				
				$objComm->redirect1('index.php?model='.$model);
			}
					
			break;
	case 'DELETE':
		$objHome = new Home();
		$objAdmin->delAdmin($_REQUEST['id']);
		$objComm->redirect('index.php?model='.$model);
	break;									
	
	default:
		$objHome = new Home();
		$DATAproduct=$objHome->getAllProducts();
		$DATArt=$objHome->getRace();
		$DATALiveResult=$objHome->getLiveResult();
		$DATALiveStandingResult=$objHome->getLiveStandingResult();
		$DATANews=$objHome->getAllNews();
		$dataOwnNews=$objHome->getAllOwnNews();
		$athleticProfileDatum=$objHome->getAthleticProfile();
	break;
}

?>


