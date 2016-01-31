<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('race_placement');
?>
<script type="text/javascript" src="<?=JS_ADMIN?>jquery-ui.js"></script>
<script type="text/javascript" src="<?=JS_ADMIN?>jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?=JS_ADMIN?>common_func.js"></script>
<link rel="stylesheet" href="<?=CSS_ADMIN?>jquery-ui.css" />
<style>
  #sortable1 { min-height: 300px; list-style-type: none; margin: 0; 
  padding: 0; float: left; margin-right: 10px; 
  padding: 5px; width: 250px;}
  #sortable1 li {  font-size: 1.2em; width: 250px;padding:10px; }
  #srtoTabs ul li {margin-right:20px;}
  #srtoTabs ul li a {border-left: 1px solid;
    border-right: 1px solid;
    display: block;
    padding: 10px;}
	.span6 {padding-left:10px;}

</style>

<div>
    <ul class="breadcrumb">
        <li><a href="index.php?model=race_placement">Race Placement</a> <span class="divider">/</span></li>
        <li><a href="#">All Race Placement</a></li>
   </ul>
</div>
<?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> All Race Placement </h2>
      <div class="box-icon"></div>
    </div>
<div class="box-content">

  <h5>
  Select Race and then Drag - Drop its position to adjust the Race Placement
  </h5>
  </div>

<!------>
<div class="row" style="margin:0;">
	<!-- START Tab for  Athletics on Race type -->
	<div class="breadcrumb" id="srtoTabs">
	  <ul class="navMeter">
		<?php $counter=1; foreach($data as $datum) { ?>
		  <li class="<?php echo ($counter==1) ? 'active' : 'no_active';?>">
			<a href="#rt<?=$datum->id?>"><?=$datum->race_title?></a>
		  </li>
		 <?php $counter++; } ?> 
	  </ul>
	</div>
	<!-- END Tab for  Athletics on Race type -->
	
	
<!-- START Athletics Listing based on Race Map -->
<div id="srtoTabsContent"> 	
<div class="heading heading1 ">Drag-Drop at Specified Position</div>
<?php foreach($data as $datum) { ?>	
	<div class="span6" id="rt<?=$datum->id?>">
	<?php
	////////////////////////////////
	$SQL="SELECT 
	race_placement.id,
	race_placement.race_id,
	race_placement.athelete_id,
	race_placement.position,
	athlete.name,
	athlete.facebook_url,
	athlete.photo_url,
	athlete.type,
	athlete.status
	FROM race_placement
	JOIN athlete ON athlete.id=race_placement.athelete_id
	WHERE athlete.status='Active' AND race_placement.race_id='".$datum->id."' ORDER BY race_placement.position";
	$response=$DB->fetchAll($SQL,"");
	if(count($response)>0)
	{
		$NEWDATA=$response;
		$action="UPDATE";
	}
	else
	{
		$athletics=str_replace("#",",",$datum->arm_athlete_id);//JOIN race_picks ON race_picks.athelete_id=athlete.id 
		if($athletics==""){ $athletics=0; }
		$SQL="SELECT athlete.id AS athelete_id,athlete.name,athlete.facebook_url,athlete.photo_url FROM athlete WHERE athlete.id IN ($athletics)";
		$NEWDATA=$DB->fetchAll($SQL,"");
		$action="ADD";
	}	
	?>
	  
	  <!-- START Athletics Listing -->
		  <ul id="sortable1" class="droptrue rt<?=$datum->id?>">
		  <?php $counter=1; foreach($NEWDATA as $NEWDATUM) { ?>
			  <li class="draggable ui-state-default">
			  
			  <a href="<?=$NEWDATUM->facebook_url?>" data="<?=$datum->id?>#<?=$NEWDATUM->athelete_id?>#<?=$NEWDATUM->position?>#<?=$NEWDATUM->id?>">
				 
				<span class="positionCounter"><?=$counter?></span>
				 <span class="userImg">
					<img src="<?=$NEWDATUM->photo_url?>" alt="">
				  </span>
				  &nbsp;&nbsp;
				  <span class="userName">
					<?=$NEWDATUM->name?>
				  </span>
			  </a>
			  </li>
		 <?php $counter++; } ?>	  
		  </ul>
		  
	  <!-- END Athletics Listing -->
	  <br style="clear:both;" /><br />
	  
	  <a href="#" id="add<?=$datum->id?>" data="ADD" rel="rt<?=$datum->id?>" style="margin-left:10px;" class="saveRacePlacement <?=($action=="ADD") ? "show" : "hide";?>">
		<button type="button" class="btn btn-primary">
			ADD
		</button>
	  </a>
	  
	  
	  <a href="#" id="update<?=$datum->id?>" data="UPDATE" rel="rt<?=$datum->id?>" style="margin-left:10px;" class="updateRacePlacement <?php echo ($action=="UPDATE") ? "show" : "hide"; ?>">
		<button type="button" class="btn btn-primary">
			UPDATE
		</button>
	  </a>
	  
	   <a href="#" id="delete<?=$datum->id?>" data="DELETE" rel="rt<?=$datum->id?>" style="margin-left:10px;" class="deleteRacePlacement <?php echo ($action=="UPDATE") ? "show" : "hide"; ?>">
		<button type="button" class="btn btn-primary">
			RESET
		</button>
	  </a>
	  
	  
	  <a href="#" id="publish<?=$datum->id?>" data="" rel="rt<?=$datum->id?>" style="margin-left:10px;" class="publishRacePlacement">
		<button type="button" class="btn btn-primary">
			PUBLISH
		</button>
	  </a>
	  
	  
	</div>
<?php } ?>	
</div>	
</div>
<br />
</div>
</div>
 <!--/span--> 
</div>



<script type="text/javascript">
$(function() {
	$("#srtoTabs").srtoTabs({
	});
});
</script>

<!--- START Drag Drop Picks Pages -->
<script>
  $(function() {
    $( "ul.droptrue" ).sortable({
      connectWith: "ul"
    });
 
    $( "ul.dropfalse" ).sortable({
      connectWith: "ul",
      dropOnEmpty: false
    });
 
    $( "#sortable1, #sortable3" ).disableSelection();
  });
 </script>
  
<script>
	$(document).ready(function(){
		$(".saveRacePlacement,.updateRacePlacement,.deleteRacePlacement").click(function(e){
		e.preventDefault();
		var currentRace=$(this).attr("rel");
		var action=$(this).attr("data");
		var curRef = currentRace.substring(2, currentRace.length);
		var items = [];
		var counter = 1;
		$("ul."+currentRace).children().each(function() {
			
		var data=$(this).find("a").attr("data").split("#");
		
		var item = {race_id:data[0],athelete_id:data[1],position:counter,id:data[3]};
		
		counter = counter + 1;
		
		items.push(item);
		
		});
		var jsonData = {picksdata:items};
		$.post("ajax.php?ajaxcall=true&mod=setRacePlacement&action="+action, jsonData, function(response) {
			if(action=="DELETE")
			{
				//location.href = "index.php?model=race_placement";			
			}
			else if(action=="ADD")
			{
				//$("#add"+curRef).hide();
				//$("#update"+curRef).show();	
				//$("#delete"+curRef).show();	
				//positionIterate(currentRace);

			}
			else if(action="UPDATE")
			{
				//positionIterate(currentRace);
				
			}
		});
	});
});
	
function positionIterate(currentRace)
{
	counter=1;
	$("ul."+currentRace).children().each(function() {
		$(this).find("span.positionCounter").html(counter);			
		counter = counter + 1;	
	});//positionCounter
}	
</script>
<!--- END Drag Drop Picks Pages -->	


		