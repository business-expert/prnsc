<?php
include_once(dirname(__FILE__).'/bootstrap.php');
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

$sessionUser = $_SESSION['admin'][SITE_SESSION.'_user'];

if($sessionUser != '')
{
	if($model == 'login' && $action != 'logout')
		$model = 'dashboard';
		
	#echo "1";
	if($model != '')
	{
		#echo "2";

		if(file_exists(VIEWS_ADMIN. "/".$model."/".$model.'.php'))
		{
			#echo "3";
			include_once(VIEWS_ADMIN ."/header/header_css.php");		
			include_once(VIEWS_ADMIN ."/header/header.php");
			
			if($action != '')
			{
				
				#echo "4";
				if(file_exists(VIEWS_ADMIN. "/".$model."/".$action.'.php'))
				{
					#echo "5";	die;
					include_once(VIEWS_ADMIN. "/".$model."/".$action.'.php');
				}
				else
				{
					#echo "6";		die;				
					include_once(VIEWS_ADMIN. "/".$model."/".$model.'.php');
				}
				
				#echo VIEWS_ADMIN. "/".$model."/".$action.'.php'; die;
			}
			else
			{
				#echo "7";
				include_once(VIEWS_ADMIN. "/".$model."/".$model.'.php');
			}
			
			include_once(VIEWS_ADMIN ."/footer/footer.php");
			include_once(VIEWS_ADMIN ."/footer/footer_js.php");
		}
		else
		{
			#echo "8";
			include_once(VIEWS_ADMIN. "/error/error.php");	
		}
	}
	else
	{
		#echo "9";
		include_once(VIEWS_ADMIN ."/header/header_css.php");	
		include_once(VIEWS_ADMIN ."/header/header.php");
		include_once(VIEWS_ADMIN. "/dashboard/dashboard.php");	
		include_once(VIEWS_ADMIN ."/footer/footer.php");	
		include_once(VIEWS_ADMIN ."/footer/footer_js.php");	
	}
}
else
{
	#echo "10";
	include_once(VIEWS_ADMIN ."/header/header_css.php");
	include_once(VIEWS_ADMIN. "/login/login.php");
	include_once(VIEWS_ADMIN ."/footer/footer_js.php");
}



?>