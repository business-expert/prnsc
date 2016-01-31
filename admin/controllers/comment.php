<?php 
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];
include_once(MODELS_ADMIN."/".$model."_model.php");
switch(strtoupper($action))
{
	case 'VIEW':	
		$objComment = new Comment();
		$datum = $objComment->getComment($_REQUEST['id']);
		break;
	case 'UPDATE':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Update')
				{
					$objComment = new Comment();
					$objComment->setComment($_REQUEST);
					$objComm->redirect('index.php?model='.$model);
				}
				break;	
	default:
				$objComment = new Comment();
				$data = $objComment->getAllComment();
				break;
}

?>