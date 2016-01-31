<!-- left menu starts -->
<?php

$arrLink['Main'] 			= array(
'dashboard' => array('Dashboard', 'index.php?model=dashboard', 'icon-home'),
'Site Admin' => array('Site Admin', 'index.php?model=admin', 'icon-user'), 																	   
);


$arrLink['Athletes Section'] = array(
									'Athletic Type' => array('Athletic Type', 'index.php?model=athletictype', 'icon-user'),		
									'athletes' 	=> array('Athletes', 'index.php?model=athletes', 'icon-user'),									

									);
									
									
$arrLink['Fan'] 			= array(
									'Fan' => array('Fan', 'index.php?model=fan', 'icon-user'), 
									);	

									
									
									
									

$arrLink['Events & Race'] 			= array(
									'Season' => array('Season', 'index.php?model=season', 'icon-calendar'),	
									'events' => array('Events', 'index.php?model=events', 'icon-calendar'),   
									'Race Type' => array('Race Type', 'index.php?model=racetype', 'icon-calendar'),											
									'Race' => array('Race', 'index.php?model=race', 'icon-calendar'),
									'Race Placement' => array('Race Placement', 'index.php?model=race_placement', 'icon-user'), 
								   );
				


								   
$arrLink['Product'] 			= array(
									'Product' => array('Product', 'index.php?model=product', 'icon-user'),
									'Invoice' => array('Invoice', 'index.php?model=invoice', 'icon-user'), 									
									);	
$arrLink['News System'] 			= array(
									'News Category' => array('News Category', 'index.php?model=blogtype', 'icon-user'),
									'News' => array('News', 'index.php?model=blog', 'icon-user'),
									'Comments' => array('Comments', 'index.php?model=comment', 'icon-user'), 									
									);	
									
								   
foreach($arrLink as $key => $link)
{	
	 $strNav = '<li class="nav-header hidden-tablet">'.$key.'</li>';
	 $arrNav = array();

	 foreach($link as $title => $arrDetail)
	 {
		 $arrNav[] = '<li>
						<a class="ajax-link" href="'.$arrDetail['1'].'">
							<i class="'.$arrDetail['2'].'"></i><span class="hidden-tablet"> '.$arrDetail['0'].'</span>
						</a>
					</li>';	 
	 }
	
	 if(count($arrNav) > 0)
	 {
		$arrFinalNav[] = $strNav.implode(" ",$arrNav);
	 }
}

$strNavigation = '';

if($_SESSION['admin'][SITE_SESSION.'_user'] != '')
	$strNavigation = implode(" " ,$arrFinalNav);
?>

<div class="span2 main-menu-span">
  <div class="well nav-collapse sidebar-nav">
    <ul class="nav nav-tabs nav-stacked main-menu">
   	<?=$strNavigation?>
    </ul>
  </div>
  <!--/.well --> 
</div>
<!--/span--> 
<!-- left menu ends -->

<noscript>
<div class="alert alert-block span10">
  <h4 class="alert-heading">Warning!</h4>
  <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
</div>
</noscript>
