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
					$objBlogType = new BlogType();
					$objBlogType->setBlogType($_REQUEST);
					
					$objComm->redirect('index.php?model='.$model);
				}
				
				break;
	case 'VIEW':			
	case 'EDIT':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'Update')
				{
				
					$objBlogType = new BlogType();
					$objBlogType->setBlogType($_REQUEST);
					$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				}
				else
				{
					$objBlogType = new BlogType();
					$datum = $objBlogType->getBlogType($_REQUEST['id'],$action);
				}
				
				break;	
									
	
	default:
				$objBlogType = new BlogType();
				$data = $objBlogType->getAllBlogType();
				break;
}

?>