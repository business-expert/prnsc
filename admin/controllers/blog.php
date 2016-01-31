<?php 
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];
include_once(MODELS_ADMIN."/".$model."_model.php");
switch(strtoupper($action))
{
	case 'ADD':
			if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Save')
			{
				$objBlog = new Blog();
				$objBlog->setBlog($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model);
			}
			break;
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Update')
				{
					$objBlog = new Blog();
					$objBlog->setBlog($_REQUEST);
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objBlog = new Blog();
					$datum = $objBlog->getBlog($_REQUEST['id']);
				}
				
				break;	
				
	default:
				$objBlog = new Blog();
				$data = $objBlog->getAllBlog();
				break;
}

?>