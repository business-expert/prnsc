<script type="text/javascript" src="<?=JS?>jquery-ui.js"></script>
<script type="text/javascript" src="<?=JS?>jquery.ui.touch-punch.min.js"></script>

				
<link rel="stylesheet" href="<?=CSS?>jquery-ui.css" />

<style>
.poolImage {height:27px;width:20%;}
.sortable_pool { min-height: 40px; }
.sortable_predict { min-height: 75px;}
.errorClassOnBorder {border: 1px solid #FF0000;}
#picksHowItWorksModel .modal-body p {color:#000000;}
</style>
<!-- background: #eee;
padding: 5px; 
-->

<div align="right" style="margin:0 0 10px 0;">
	  <a class="picksHowItWorksLink" style="color:#ba8209; font-size:10px;" href="#">How Does This Work?</a>
</div>


<!-- START Tab for  Athletics on Race type -->
<ul class="navMeter" id="srtoTabs">
 <?php $counter=1; foreach($DATArt as $datum) { ?>
  <li>
	<a id="raceTab_<?=$datum->id?>" href="#rt<?=$datum->id?>" class="<?php echo ($counter==1) ? 'selected' : '';?>"><?=$datum->race_title?></a>
  </li>
<?php $counter++; } ?> 
</ul>
      
<div class="navMeter-select" id="srtoSelectTabs">
   <select id="selectedTabs">
   <?php $counter=1; foreach($DATArt as $datum) { ?>
   <option value="#rt<?=$datum->id?>" class="<?php echo ($counter==1) ? 'selected' : 'no_active';?>"><?=$datum->race_title?></option>		 
  <?php $counter++; } ?> 
  </select>
</div>
 <!-- END Tab for  Athletics on Race type --> 
 
 
 
 
 
<!-- START Race Listing based on Race type -->
<div>
<div id="srtoTabsContent"> 	
<?php foreach($DATArt as $datum) { ?>	
	<div id="rt<?=$datum->id?>"> 
	<?php	
		$type=$datum->race_type_athletic_code;
		#Condition for the all athletic
		if($type=="All") { $CONDITON=""; } else { $CONDITON=" AND athlete.type='".$type."'"; }
		$athleticsIDSArray=array();
		$DATAracepicks=$DB->fetchAll("SELECT athelete_id FROM race_picks JOIN athlete ON athlete.id=race_picks.athelete_id WHERE race_picks.fan_id='".$FBPanel->panelGetUser()."' AND race_picks.race_id='".$datum->id."'$CONDITON","");
		foreach($DATAracepicks as $DATUMracepicks){ $athleticsIDSArray[]=$DATUMracepicks->athelete_id; }
		$athleticsIDS=$objComm->dataImplode($athleticsIDSArray,$seperator=",",$default=0);		
		$SQL="SELECT id,(CASE WHEN LOCATE(' ',athlete.name) >0 THEN SUBSTRING(athlete.name,1,LOCATE(' ',athlete.name)-1) ELSE athlete.name END) AS name,athlete.facebook_url,athlete.photo_url FROM athlete WHERE athlete.id NOT IN ($athleticsIDS)".$CONDITON;
		$type="";
		$DATAathletic=$DB->fetchAll($SQL,"");
	?>

<?php 
	  $DATArcp=$DB->fetchAll("SELECT race_picks.id,race_picks.race_id,race_picks.athelete_id,race_picks.fan_id,race_picks.position,(CASE WHEN LOCATE(' ',athlete.name) >0 THEN SUBSTRING(athlete.name,1,LOCATE(' ',athlete.name)-1) ELSE athlete.name END) AS name,athlete.photo_url,athlete.facebook_url FROM race_picks JOIN athlete ON race_picks.athelete_id=athlete.id WHERE race_picks.fan_id='".$FBPanel->panelGetUser()."' AND race_picks.race_id='".$datum->id."' ORDER BY race_picks.position","");
	  ?>
 <div class="heading"><?=$datum->race_title?></div>
      <p class="info">Each athlete has 2 laps to build their speed and one lap to post the fastest time they can. Please rank your top ten picks. Drag athletes
from the pool into the predictions box and arrange them from first to tenth. Good Luck.</p>    
<div class="container3"  id="rt<?=$datum->id?>">
<div class="predictions predict_max_error_<?=$datum->id?>">
   <div class="heading heading1 ">Predictions</div>
      <ul style="z-index:100;" id="" class="sortable_predict sortable_predict_<?=$datum->id?> droptrue_<?=$datum->id?> sortableUL row-fluid <?=$datum->id?>">
	  <?php $counter=1; foreach($DATArcp as $DATUMrcp) { ?>
	  
	  <!-- Code to check Whether give Photo-URL is exist or Not. -->
	  <?php $image = (exif_imagetype($DATUMrcp->photo_url) == IMAGETYPE_JPEG) ? $DATUMrcp->photo_url : DEFAULT_ATHLETES_PROFILE_AVTAR; ?>			 
	  
	  <li class="span2" id="<?=$DATUMrcp->fan_id?>#<?=$DATUMrcp->race_id?>#<?=$DATUMrcp->athelete_id?>#<?=$DATUMrcp->id?>">
       
	  <div class="block">
		  <a href="<?=$DATUMrcp->facebook_url?>" target="_blnk" data="<?=$DATUMrcp->fan_id?>#<?=$DATUMrcp->race_id?>#<?=$DATUMrcp->athelete_id?>#<?=$DATUMrcp->id?>">
			  <img src="<?=$image?>" alt=""><div class="fRgt">
			  <label class="picklabel" id="<?=$datum->id?>"><?=$counter++?></label><label><?=$DATUMrcp->name?></label></div>
		  </a>
	  </div>
      </li>
	  <?php } ?>
<!-- $counter=1 == 0 -->
	</ul>
	<!--
	<ul class="row-fluid" style="z-index:99;margin-bottom: 0;margin-left: auto;margin-right: auto;margin-top: -80px; position: absolute;" >
	<?php// for($i=($counter); $i <= $datum->race_type_max_picks; $i++) { ?>
	<li class="span2">      
	  <div class="block thisplaceHolder">
		  
	  </div>
    </li>
	  
	<?php // } ?>
	</ul>
	-->
 </div>
	  
	  
<!-- START ALL racers ////////////////////////////////////////--------->	  
	<div class="predictions athletePool">
	<div class="heading heading1 ">Athlete Pool</div>
		 <ul id="" class="sortable_pool sortable_pool_<?=$datum->id?> droptrue_<?=$datum->id?> row-fluid">
		 <?php foreach($DATAathletic as $DATUMathletic) { ?>
		 <!-- Code to check Whether give Photo-URL is exist or Not. -->
		 <?php $image = (exif_imagetype($DATUMathletic->photo_url) == IMAGETYPE_JPEG) ? $DATUMathletic->photo_url : DEFAULT_ATHLETES_PROFILE_AVTAR; ?>			 
				<li class="span2">
				
	   
				<div class="block">
				<a href="<?=$DATUMathletic->facebook_url?>" target="_blnk" data="<?=$FBPanel->panelGetUser()?>#<?=$datum->id?>#<?=$DATUMathletic->id?>">
				
				<img src="<?=$image?>" class="poolImage">
				<div class="fRgt">
				<label><?=$DATUMathletic->name?></label></div>
				</a>
				</div>
			  </li>
		<?php } ?> 
	</ul>	

     
      </div>
<!-- END ALL racers ////////////////////////////////////////--------->	  
</div>
<br />
<a align="center" href="#" class="savePositionButton readmore" data="<?=$datum->id?>">Save Position</a>
</div>
<a href="#" class="currentRace" data="<?=$datum->id?>"></a>
<?php } ?>	
</div>
<div class="btmBtn" align="right">
<a href="#" class="nextRaceButton"><img src="media/img/nextRace.png" alt=""></a>
<a href="#" class="clearPicksButton"><img src="media/img/clearPicks.png" alt=""></a>

</div>
          

</div>







<script type="text/javascript">
$(function() {
	//# When code run desktop / tablet
	$("#srtoTabs").srtoTabs({
	});
	
	//# When code run on mobile
	$("#srtoSelectTabs").srtoSelectTabs({
	});
});
</script>




<!---########## START Drag Drop Picks Pages  #####################-->
<!-- START Loop for each race A Unique Sortable Jquery Function -->
<?php foreach($DATArt as $datum) { ?>	

<!--## START ensure user can not position picks exceeded to max -->
<script type="text/javascript">
$(document).ready(function(){	
$('.sortable_pool_<?=$datum->id?> li').mousedown(function(){
    //##Check number of Max Picks already in each sortable
    $('.sortable_predict_<?=$datum->id?>').not($(this).parent()).each(function(){
        var $this = $(this);
        //##Check maximum picks exceeded if YES disable sortable.
        if($this.find('li').length >= <?=$datum->race_type_max_picks?>){
            $this.sortable('disable');
			$(".predict_max_error_<?=$datum->id?>").addClass("errorClassOnBorder");
        } else {
            $this.sortable('enable');
			$(".predict_max_error_<?=$datum->id?>").removeClass("errorClassOnBorder");
        }
    });
})
});
</script>
<!--## END ensure user can not position picks exceeded to max -->


<script>
var currentData,oldData,newData='<label class="picklabel">1</label>';
  $(function() {
    $( "ul.droptrue_<?=$datum->id?>" ).sortable({
      connectWith: "ul",	
	  placeholder: "placeHolder",
		stop: function(){
        // Enable all sortables
        $('.sortable_predict_<?=$datum->id?>').each(function(){
            var $this = $(this);
            
            $this.css('borderColor','gray');
            $this.sortable('enable');
        });
    },
	   receive: function(e, ui) {
        if(ui.item.closest('ul').hasClass('sortable_predict'))
		{
			var counter=1;
			oldData=$(ui.item).find('div.block div.fRgt').html(); currentData = newData+""+oldData;$(ui.item).find('div.block img').removeClass('poolImage'); $(ui.item).find('div.block div.fRgt').html(currentData);
			$("ul.sortable_predict_<?=$datum->id?>").children().each(function() {
				
				$(this).find("div.block label.picklabel").html(counter);
				counter = counter + 1;		
			});
		}
		else
		{
			oldData=$(ui.item).find('div.block div.fRgt label.picklabel').remove();
			$(ui.item).find('div.block img').addClass('poolImage');
			
			var counter=1;
			$("ul.sortable_predict_<?=$datum->id?>").children().each(function() {	
					
			$(this).find("div.block label.picklabel").html(counter);
		    counter = counter + 1;
			});
		}
		},
		update: function(ev,ui){
			var counter=1;
			$("ul.sortable_predict_<?=$datum->id?>").children().each(function() {		
			
				$(this).find("div.block label.picklabel").html(counter);
				counter = counter + 1;	
			});
			$(".predict_max_error_<?=$datum->id?>").removeClass("errorClassOnBorder");
		}
    });
    $( "ul.dropfalse_<?=$datum->id?>" ).sortable({
      connectWith: "ul",
      dropOnEmpty: false
    });
 
    $( ".sortable_pool_<?=$datum->id?>, .sortable_predict_<?=$datum->id?>" ).disableSelection();
  });
 </script>

<?php } ?>
<!-- END Loop for each race A Unique Sortable Jquery Function -->
<!---########## END Drag Drop Picks Pages  #####################--> 



<!---########## START Save Picks Position  #####################-->
<script>
$(document).ready(function(){	
		$(".savePositionButton").click(function(e){
		e.preventDefault();
		$(".savePositionButton").html("<?=PROCESSING_IMAGE_TYPE_TWO?>");
		var currentRace=$(this).attr("data");
		var items = [];
		var counter=1;
		$("ul."+currentRace).children().each(function() {
			
		var data=$(this).find("div.block a").attr("data").split("#");
		console.log($(this).find("div.block a").attr("data"));
		
		var item = {fan_id:data[0],race_id:data[1],athelete_id:data[2],position:counter,id:data[3]};
		
		counter = counter + 1;
		
		items.push(item);
		
		});
		var jsonData = {picksdata:items};
		$.post("ajax/ajax.php?ajaxcall=true&mod=setRacePicks&race_id="+currentRace, jsonData, function(response) {
			var JSONDATA=$.parseJSON(response);
			if(JSONDATA.status=="RACE_COMPELED")
			{
				alert("Race Has been finished, So you can't make Position");
			}
			if(JSONDATA.status=="RACE_NOT_LIVE")
			{
				alert("Race is not live, So you can't make Position");
			}
			if(JSONDATA.status=="OK")
			{
				alert("Position Has been Saved");
			}
			
			$(".savePositionButton").html("Save Position");	
		});
	});
});
</script>
<!---########## END Save Picks Position  #####################-->


<!---########## START Clear Picks  #####################-->
<script>
$(document).ready(function(){	
		$(".clearPicksButton").click(function(e){
		e.preventDefault();
		var currentRace=$(".currentRace").attr("data");
		$.post("ajax/ajax.php?ajaxcall=true&mod=clearPicks&race_id="+currentRace, function(response) {
			var JSONDATA=$.parseJSON(response);
			if(JSONDATA.status=="OK")
			{
				top.location.href="<?=SITE_PATH?>";
			}
			else
			{
				alert("ERROR");
			}
		});
});
});
</script>
<!---########## END Save Picks Position  #####################-->



<!---########## START Code for Next Button  #####################-->
<script type="text/javascript">
var raceTabsArray=new Array();
var maxRaceTabs=0;
<?php $counter=1; foreach($DATArt as $datum) { ?>
	raceTabsArray[<?=$counter?>]="raceTab_<?=$datum->id?>";
 <?php $counter++; } ?>
  maxRaceTabs=<?=$counter-1?>;
  
$(document).ready(function(){	
	$(".nextRaceButton").click(function(e){
		counter=1;
		$("ul#srtoTabs").children().each(function() {
		if($(this).find("a").attr("class").indexOf("selected") >= 0)
		{
			counter = counter + 1;
			if(counter>maxRaceTabs)		
			{
				$("#"+raceTabsArray[1]).click();
			}
			else
			{
				$("#"+raceTabsArray[counter]).click();
			}
			return false;
		}
		counter=counter+1;
	});	
});	
});	
</script>
<!---########## END Code for Next Button  #####################-->



<!-- START How it works Pop up-->
<div id="picksHowItWorksModel" class="modal hide fade">
    <div class="modal-header">
        <h3>How Does This Work?</h3>
    </div>
	
    <div class="modal-body" >
		<p>
			Eu ridiculus hymenaeos velit. Porttitor hendrerit. At. Sollicitudin viverra a quisque aenean id nonummy bibendum dignissim laoreet litora sed risus Proin lacinia blandit tortor viverra bibendum mi condimentum facilisis felis dignissim ad felis nonummy. Nisl.

Vivamus justo magna et netus condimentum sapien nam maecenas, pretium sit platea nec sociosqu cras faucibus metus cursus Dignissim parturient bibendum sapien scelerisque pede in iaculis ac fringilla.

Hymenaeos dictum felis fusce metus mus amet mi enim nec dolor convallis aliquam phasellus. Eleifend vel fames faucibus. Odio. Semper facilisi fames a, ligula congue malesuada nisl leo. Magna consectetuer scelerisque. Gravida. Sociis facilisis. Lobortis libero duis.
		</p>
     </div>
    <div class="modal-footer">
	
		
      <a data-dismiss="modal" class="btn" onclick="javascript:hidepicksHowItWorksModel();">
		<button class="close" type="button" id="reedom"  onclick="javascript:hidepicksHowItWorksModel();">×</button>
	</a> 

		
    </div>
</div>
<!-- END How it works Pop up-->
<script type="text/javascript">
function hidepicksHowItWorksModel()
{
	$('#picksHowItWorksModel').addClass('hide').removeClass('in');
}

$(document).ready(function(){
	$(".picksHowItWorksLink").click(function(e){
		e.preventDefault();
		$('#picksHowItWorksModel').removeClass('hide').addClass('in');	
	});
});
</script>