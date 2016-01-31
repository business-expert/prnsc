<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
<!--<div class="vdoPlayer"><img alt="" src="<?php // echo IMAGES?>vdo.gif"></div>-->

<!-- Example row of columns -->
<div style="margin:0 0 10px 0; ">
	<div class="heading">Live Results</div><p>Click race title for complete results</p>
</div>

<div class="row" style="margin:0;">    
 
<?php foreach($DATALiveResult as $raceDatum) { ?> 
<div class="span2">
	<table class="liveResult_meter">
	  <tr>
		<td colspan="3" class="heading">
		<a href="#" id="standingTabs_<?=$raceDatum->id?>" data="mainMenu_standing" class="heading liveResultButton">
		<?=$raceDatum->race_title?>
		</a>
		</td>
	 </tr>
	 <?php
		#Determine whether an event is LIVE or not!	if Not Live "Table Name=race_placement_history" Else "Table Name=race_placement"
		$tb=($DB->totRecord("SELECT event.id FROM event WHERE event.id='".$raceDatum->event_id."' AND NOW() BETWEEN event_start_date_time AND event_end_date_time") > 0) ? "race_placement" : "race_placement_history";
		$data=$DB->fetchAll("SELECT (CASE WHEN LOCATE(' ',athlete.name) >0 THEN SUBSTRING(athlete.name,1,LOCATE(' ',athlete.name)-1) ELSE athlete.name END) AS name,athlete.facebook_url,athlete.photo_url,$tb.id,$tb.race_id,$tb.athelete_id,$tb.position,$tb.race_placement_date FROM $tb JOIN athlete ON $tb.athelete_id=athlete.id WHERE $tb.race_id='".$raceDatum->id."' ORDER BY $tb.race_placement_date LIMIT 5","");
		#IF $data is not fetch any record re-fetch it from "Table Name=race_placement_history" 
		if(!$data){ $data=$DB->fetchAll("SELECT (CASE WHEN LOCATE(' ',athlete.name) >0 THEN SUBSTRING(athlete.name,1,LOCATE(' ',athlete.name)-1) ELSE athlete.name END) AS name,athlete.facebook_url,athlete.photo_url,race_placement_history.id,race_placement_history.race_id,race_placement_history.athelete_id,race_placement_history.position,race_placement_history.race_placement_date FROM race_placement_history JOIN athlete ON race_placement_history.athelete_id=athlete.id WHERE race_placement_history.race_id='".$raceDatum->id."'ORDER BY race_placement_history.race_placement_date LIMIT 5","");  }
		else if(!$data){ $data=$DB->fetchAll("SELECT (CASE WHEN LOCATE(' ',athlete.name) >0 THEN SUBSTRING(athlete.name,1,LOCATE(' ',athlete.name)-1) ELSE athlete.name END) AS name,athlete.facebook_url,athlete.photo_url,race_placement.id,race_placement.race_id,race_placement.athelete_id,race_placement.position,race_placement.race_placement_date FROM race_placement JOIN athlete ON race_placement.athelete_id=athlete.id WHERE race_placement.race_id='".$raceDatum->id."'ORDER BY race_placement.race_placement_date,race_placement.position LIMIT 5","");  }
		$currentDate=strtotime(date("Y-m-d H:i:s"));
		#Determine is race is live or not.
		$isRaceLive=(($currentDate >= strtotime($raceDatum->race_start_datetime)) && ($currentDate <= strtotime($raceDatum->race_end_datetime))) ? true : false;
	 ?>
	 
	 <?php $counter=1; foreach($data as $datum) { ?>
	 
	  <tr>
		<td width="20%"><?=($isRaceLive) ? $datum->position : $counter++?></td>
		<td width="50%"><?=($isRaceLive) ? $datum->name : ""?></td>
		<td width="30%"><?=($isRaceLive) ? "93.5" : ""?></td>
	  </tr>
	  <?php } ?>
	</table>
</div>
<?php } ?>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$(".liveResultButton").click(function(e){
			 var currentElement=$(this).attr("data");
			 $("#"+currentElement).click();
		});
	});
</script>