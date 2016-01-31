<?php include_once(CONTROLLERS."/home.php");  ?>
<div class="container container1">  
<div id="sTabsContent"> 
<div align="right" class="logoutBtm" style="margin-bottom:10px;">
	<a class="logoutFromApp" id="logoutFromApp" href="logout.php">
		<img alt="" src="<?=IMAGES."font_logout.png"?>" />
	</a>
</div>

	
	



<!---- START rules ---->
<div class="container2" id="rules">

	<div class="heading">Rules</div>
	<?php include_once(VIEWS."/home/rules.php");?>
</div>
<!---- START rules ---->

<!---- START PICKS ---->
<div class="container2 hide" id="picks">
	<!--<div class="heading">Picks</div>-->
	<?php include_once(VIEWS."/home/picks.php");?>
</div>
<!---- END PICKS ---->


<!---- START feed ---->
<div class="container2 hide" id="feed">
	<div class="heading">Live Feed</div>
		<?php include_once(VIEWS."/home/feed.php");?>
</div>
<!---- END feed ---->



<!---- START standing ---->
<div class="container2 hide" id="standing">
	<div class="heading">Live Feed STANDING</div>
		<?php include_once(VIEWS."/home/standing.php");?>
</div>
<!---- END standing ---->


<!---- START shop ---->
<div class="container2 hide" id="shop">
<!--<div class="heading">Shop</div> -->
      <?php include_once(VIEWS."/home/shop.php");?>  
</div>
<!---- END shop ---->

<!---- START news ---->
<div class="container2 hide" id="news">
<div class="heading">News</div>
      <?php include_once(VIEWS."/home/news.php");?>       
</div>
<!---- END news ---->

<!---- START nsc ---->
<div class="container2 hide" id="nsc">
	<div class="heading">NSC</div>
		<?php include_once(VIEWS."/home/nsc.php");?>
</div>
<!---- END nsc ---->

<!---- START Account ---->
<div class="container2 hide" id="account">
	<div class="heading">ACCOUNT</div>
		<?php include_once(VIEWS."/home/account.php");?>
</div>
<!---- END Account ---->


</div>

</div> 
	
<!-- /container -->
<!-- content part end here -->
