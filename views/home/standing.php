<p>Live fee broadcast will begin at 7:45pm Pacific Standard Time. Please check to make sure the volume is up on your player. If the feed stops, click the refresh button. Enjoy, and don’t forget to make your picks!</p>
<div class="row-fluid predictions">
<span class="span3" id="srStngtoTabs">
	<ul class="navMeter navMeter1">
	<?php $counter=1; foreach($DATALiveStandingResult as $raceDatum) { ?> 
		<li>
			<a id="" href="#<?=$raceDatum->id?>" class="<?php echo ($counter==1) ? 'selected' : '';?>"><?=$raceDatum->race_title?></a>
		</li>
	<?php $counter++; } ?>	
  </ul>
<div class="navMeter-select" id="srStngtoSelectTabs">
	<select id="srStngSelectedTabs">
	<?php $counter=1; foreach($DATALiveStandingResult as $raceDatum) { ?> 
		<option value="#rt<?=$datum->id?>" <?php echo ($counter==1) ? 'selected' : '';?>></option>
	<?php $counter++; } ?>		
	</select>
</div>
</span>


<div id="srStngtoTabsContent"> 
<?php foreach($DATALiveStandingResult as $raceDatum) { ?> 

	<?php
		#Determine whether an event is LIVE or not!	if Not Live "Table Name=race_placement_history" Else "Table Name=race_placement"
		$tb=($DB->totRecord("SELECT event.id FROM event WHERE event.id='".$raceDatum->event_id."' AND NOW() BETWEEN event_start_date_time AND event_end_date_time") > 0) ? "race_placement" : "race_placement_history";
		$data=$DB->fetchAll("SELECT (CASE WHEN LOCATE(' ',athlete.name) >0 THEN SUBSTRING(athlete.name,1,LOCATE(' ',athlete.name)-1) ELSE athlete.name END) AS name,athlete.facebook_url,athlete.photo_url,$tb.id,$tb.race_id,$tb.athelete_id,$tb.position,$tb.race_placement_date FROM $tb JOIN athlete ON $tb.athelete_id=athlete.id WHERE $tb.race_id='".$raceDatum->id."' ORDER BY $tb.race_placement_date LIMIT 10","");
		#IF $data is not fetch any record re-fetch it from "Table Name=race_placement_history" 
		if(!$data){ $data=$DB->fetchAll("SELECT (CASE WHEN LOCATE(' ',athlete.name) >0 THEN SUBSTRING(athlete.name,1,LOCATE(' ',athlete.name)-1) ELSE athlete.name END) AS name,athlete.facebook_url,athlete.photo_url,race_placement_history.id,race_placement_history.race_id,race_placement_history.athelete_id,race_placement_history.position,race_placement_history.race_placement_date FROM race_placement_history JOIN athlete ON race_placement_history.athelete_id=athlete.id WHERE race_placement_history.race_id='".$raceDatum->id."'ORDER BY race_placement_history.race_placement_date LIMIT 10","");  }
		else if(!$data){ $data=$DB->fetchAll("SELECT (CASE WHEN LOCATE(' ',athlete.name) >0 THEN SUBSTRING(athlete.name,1,LOCATE(' ',athlete.name)-1) ELSE athlete.name END) AS name,athlete.facebook_url,athlete.photo_url,race_placement.id,race_placement.race_id,race_placement.athelete_id,race_placement.position,race_placement.race_placement_date FROM race_placement JOIN athlete ON race_placement.athelete_id=athlete.id WHERE race_placement.race_id='".$raceDatum->id."'ORDER BY race_placement.race_placement_date,race_placement.position LIMIT 10","");  }
		$currentDate=strtotime(date("Y-m-d H:i:s"));
		#Determine is race is live or not.
		$isRaceLive=(($currentDate >= strtotime($raceDatum->race_start_datetime)) && ($currentDate <= strtotime($raceDatum->race_end_datetime))) ? true : false;
	 ?>
	 
<div id="<?=$raceDatum->id?>">
<!-- START Race Result -->
<span class="span3">
	<ul class="row-fluid divOverflow">
	<?php $counter=1; foreach($data as $datum) { ?>
	<!-- Code to check Whether give Photo-URL is exist or Not. -->
	<?php $image = (exif_imagetype($datum->photo_url) == IMAGETYPE_JPEG) ? $datum->photo_url : DEFAULT_ATHLETES_PROFILE_AVTAR; ?>			 
		 
		<li class="span2">
		<div class="block">
		<?php if($isRaceLive) { echo "<img src='".$image."'>";} ?>
		<div class="fRgt">
		<label><?=$counter++;?></label><label><?=($isRaceLive) ? $datum->name : $counter++;?></label></div></div>
		</li>
	<?php } ?>	
	</ul>
</span>
<!-- END Race Result -->


<!-- START Fan Result -->
<?php 
	$data=$DB->fetchAll("SELECT facebook.fb_name,facebook.fb_picture FROM race_picks_points JOIN facebook ON facebook.fb_id=race_picks_points.rpp_fan_id WHERE race_picks_points.rpp_race_id='".$raceDatum->id."' ORDER BY race_picks_points.rpp_date,race_picks_points.rpp_points DESC LIMIT 10");
?>
<span class="span3">
	<ul class="row-fluid divOverflow">
		<?php $counter=1; foreach($data as $datum) { ?>
		<!-- Code to check Whether give Photo-URL is exist or Not. -->
		<?php $photoUrl=($objComm->isLocationExist($datum->fb_picture)) ? $datum->fb_picture : DEFAULT_ATHLETES_PROFILE_AVTAR; ?>
	
		<li class="span2">
		<div class="block">
		<?php echo "<img src='".$photoUrl."'>"; ?>
		<div class="fRgt">
		<label><?=$counter++;?></label><label><?=$datum->name?></label></div></div>
		</li>
	<?php } ?>	
	</ul>
</span>
<!-- END Fan Result -->  
	

<!-- START Fan All Time -->	
<?php 
	$data=$DB->fetchAll("SELECT SUM(race_picks_points.rpp_points) AS ALL_TOTAL_POINTS, facebook.fb_name,facebook.fb_picture FROM race_picks_points JOIN facebook ON facebook.fb_id=race_picks_points.rpp_fan_id GROUP BY race_picks_points.rpp_fan_id ORDER BY ALL_TOTAL_POINTS DESC LIMIT 10");
	//echo "SELECT SUM(race_picks_points.rpp_points), facebook.fb_name,facebook.fb_picture FROM race_picks_points JOIN facebook ON facebook.fb_id=race_picks_points.rpp_fan_id WHERE race_picks_points.rpp_race_id='".$raceDatum->id."' GROUP BY race_picks_points.rpp_fan_id ORDER BY race_picks_points.rpp_date,race_picks_points.rpp_points DESC LIMIT 10";
	?>
<span class="span3">
	<ul class="row-fluid divOverflow">
		<?php $counter=1; foreach($data as $datum) { ?>
		<!-- Code to check Whether give Photo-URL is exist or Not. -->
		<?php $photoUrl=($objComm->isLocationExist($datum->fb_picture)) ? $datum->fb_picture : DEFAULT_ATHLETES_PROFILE_AVTAR; ?>
		
		<li class="span2">
		<div class="block">
		<?php echo "<img src='".$photoUrl."'>"; ?>
		<div class="fRgt">
		<label><?=$counter++;?></label><label><?=$datum->name?> [<?=$datum->ALL_TOTAL_POINTS?>]</label></div></div>
		</li>
	<?php } ?>	
	</ul>
</span>
<!-- END Fan All Time -->	
</div>

<?php } ?> 
</div>

  
</div>
	
<script type="text/javascript">
$(function() {
	$("#srStngtoTabs").srStngtoTabs({
	});
});
</script>	