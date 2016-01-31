<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"> 
				<span>
				<img src="<?=IMAGES?>/logo.png" class="siteAdminLogo" />
					
				</span>
				</a>
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?=ucwords($_SESSION['admin'][SITE_SESSION.'_user'])?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<!--<li><a href="#">Profile</a></li><li class="divider"></li>-->
						<li><a href="index.php?model=login&action=logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a target="_blank" href="http://capitaldigitalarts.com/cdapronsc/">Visit Site</a></li>
						
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
  
  <div class="container-fluid">
	<div class="row-fluid">
    <!-- left menu starts -->
   	 <?php include_once(VIEWS_ADMIN."/left/left.php"); ?>
    <!-- left menu ends -->
    <div id="content" class="span10">
    <!-- content starts -->
			  
            