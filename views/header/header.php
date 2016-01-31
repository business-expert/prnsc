<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>NSC-index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?=CSS?>bootstrap.css" rel="stylesheet">
    
    <link href="<?=CSS?>bootstrap-responsive.css" rel="stylesheet">
    
    <link href="<?=CSS?>custom.css" rel="stylesheet">
	<link href="<?=CSS?>popup.css" rel="stylesheet"> 
	<link href="<?=CSS?>this.css" rel="stylesheet"> 
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                  <link rel="shortcut icon" href="../assets/ico/favicon.png">
 
<script src="<?=JS?>jquery.js"></script>
<script src="<?=JS?>jstorage.js"></script>
 
 <style type="text/css">
.ajax_loader
{
	background: url("admin/media/img/ajax-loaders/processing.gif") no-repeat scroll center center rgba(0, 0, 0, 0);
	height: 100%;
	width: 100%;
}
</style>
 </head>
<body>

<!-- First time when App is being loaded  Ensure user can't click On a link that is not loaded yet.'-->
<div id="firsttimebeingprocessed" style="background-color:rgb(255, 255, 255); opacity: 0.20; width: 100%; height: 100%; position: absolute; top: 0px; left: 0px; z-index: 99999;" class="ajax_overlay">
	<div class="ajax_loader"></div>
</div>

<!-- On Each tab click  Ensure user can't click On a link that is not loaded yet.'-->  
<div id="beingprocessed" style="display:none;background-color:rgb(255, 255, 255); opacity: 0.7; width: 100%; height: 700%; position: absolute; top: 0px; left: 0px; z-index: 99999;" class="ajax_overlay">
	<div class="ajax_loader"></div>
</div>

	 
<div class="logo"><img src="<?=IMAGES?>logo.png" alt=""></div>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner" style="border:none;">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		 
		 


		  
		  <!-- Menu part Start Here -->
			<?php include_once(VIEWS ."/menu/menu.php"); ?>
		  <!-- Menu Part End Here -->
		  
        </div>
      </div>
    </div>
<!--- header end here --->


<!-- INCLUDING JS FILES --->   
	
    <script src="<?=JS?>transition.js"></script>
    <script src="<?=JS?>alert.js"></script>
    <script src="<?=JS?>modal.js"></script>
    <script src="<?=JS?>dropdown.js"></script>
    <script src="<?=JS?>scrollspy.js"></script>
    <script src="<?=JS?>tab.js"></script>
    <script src="<?=JS?>tooltip.js"></script>
    <script src="<?=JS?>popover.js"></script>
    <script src="<?=JS?>button.js"></script>
    <script src="<?=JS?>collapse.js"></script>
    <script src="<?=JS?>carousel.js"></script>
    <script src="<?=JS?>typeahead.js"></script>
    <script src="<?=JS?>bootstrap.js"></script>
	<script src="<?=JS?>common_func.js"></script>
	<script src="<?=JWPLAYER_PATH?>assets/jwplayer.js"></script> <!--JW Player -->
	 <script src="<?=JS?>bootstrap-modal.js"></script>
<!-- END INCLUDING JS FILES --->  	
	
	<script type="text/javascript">
		$( document ).ready(function() {
			$("#firsttimebeingprocessed").hide();
		});
		
	</script>
	
<!-- START Script for a jquery based job -->	
<!--- START JW Player -->
<script type="text/javascript">
var primaryCookie = 'html5';
var cookies = document.cookie.split(";");
for (i=0; i < cookies.length; i++) {
	var x = cookies[i].substr(0, cookies[i].indexOf("="));
	var y = cookies[i].substr(cookies[i].indexOf("=") + 1);
	x = x.replace(/^\s+|\s+$/g,"");
	if (x == 'primaryCookie') {
		primaryCookie = y;
	}
}
</script>
<!--- END JW Player -->	
 
 
 
 
<!-- START Script for a jquery based job -->
