<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('racetype');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=racetype">Race Type</a> <span class="divider">/</span></li>
        <li><a href="#">Update Race Type</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Update Race Type</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" onsubmit="return validatertp();" action="index.php">
        <input type="hidden" name="action" id="action" value="edit" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <fieldset>
            
          <div class="control-group">
              <label class="control-label" for="data_season_title">Race Type Title</label>
              <div class="controls">
				
                <input type="text" required value="<?=$datum->race_title?>" id="data_race_title" name="data_race_title" class="input-xsmall focused">
          
              </div>
            </div>
           
          
		  <div class="control-group">
              <label class="control-label" for="data_season_title">Race Athletic Type </label>
              <div class="controls">
				
                <?=$objHTML->generateCustomCombo($objComm->getAthletesType(),"data_race_type_athletic_code",$datum->race_type_athletic_code,"required","Select")?>
          
              </div>
            </div>
		  
		  
            <div class="control-group">
              <label class="control-label" for="data_education_level">Race Type Description</label>
               <div class="controls">
				
                <input type="text" required value="<?=$datum->race_desc?>" id="data_race_desc" name="data_race_desc" class="input-xsmall focused">
          
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label" for="data_race_type_max_picks">Maximum Picks</label>
               <div class="controls">
				<input type="hidden" name="maxAllowedrtp" id="maxAllowedrtp" />
                <input type="text" required value="<?=$datum->race_type_max_picks?>" id="data_race_type_max_picks" name="data_race_type_max_picks" class="input-xsmall focused">
          
              </div>
            </div>
			
			
<!-- START Race Picks position algorithm -->	
<!-- sheepIt Form -->
<div id="sheepItForm">
  <!-- Form template-->
  <div id="sheepItForm_template" class="control-group">
    <label class="control-label" for="sheepItForm_#index#_rtp">Race Picks Points 
	<span id="sheepItForm_label">
	</span>
	</label>
	<div class="controls">
	<input id="sheepItForm_#index#_rtp" name="rtp[rtps][#index#][rtp]" type="hidden"/>
    <input class="smallInput1 rtpnumber_#index#" id="sheepItForm_#index#_rtpnumber" name="rtp[rtps][#index#][rtpnumber]" type="text"/>
	<input class="smallInput2 rtpname_#index#" id="sheepItForm_#index#_rtpname" name="rtp[rtps][#index#][rtpname]" type="text"/>
	<input class="smallInput1 rtppoint_#index#" id="sheepItForm_#index#_rtppoint" name="rtp[rtps][#index#][rtppoint]" type="text"/>
    <a id="sheepItForm_remove_current">
      <img class="delete" src="<?=IMAGES_ADMIN?>cross.png" width="16" height="16" border="0">
    </a>
  </div>
  </div>
  <!-- /Form template-->
  <!-- No forms template -->
  <div id="sheepItForm_noforms_template">Not Defined</div>
  <!-- /No forms template-->
  <!-- Controls -->
  <div id="sheepItForm_controls" class="control-group">
  
   <label class="control-label">&nbsp;</label>
   <div class="controls">
	<div id="sheepItForm_add" style="width:10%;">
		<a class="btn btn-success">
			Add More
		</a>
	</div>

  </div>
  </div>
  <!-- /Controls -->
   
</div>
<!-- /sheepIt Form -->
<!-- END Race Picks position algorithm -->
            <div class="controls">
               <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Update">Update</button>
              <a href="index.php?model=<?=$model?>"><button type="button" class="btn">Cancel</button></a>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript" src="<?=JS_ADMIN?>jquery.sheepItPlugin.js">
</script>
<script>
$(document).ready(function() {
    var sheepItForm = $('#sheepItForm').sheepIt({
        separator: '',
        allowRemoveLast: true,
        allowRemoveCurrent: true,
        allowRemoveAll: true,
        allowAdd: true,
        allowAddN: true,
        maxFormsCount: 100,
        minFormsCount: 1,
        iniFormsCount: <?=$datum->race_type_max_picks?>,
		afterAdd: function(source,form) {
			$("#maxAllowedrtp").val(source.getFormsCount());	
        },
		afterRemoveCurrent: function(source) {
			$("#maxAllowedrtp").val(source.getFormsCount());
		}
    });
 
 
 
 //Initialize Race Type Point Algorithm//
	
	var datumRTP = '<?=$datumRTP?>';
	try
	{
		JSONDATA = $.parseJSON(datumRTP);
		$.each(JSONDATA, function(key,data){
			$(".rtpnumber_"+key).val(data.substring(0,data.indexOf("-")));
			$(".rtpname_"+key).val(data.substring(data.indexOf("-")+1,data.indexOf("#")));
			$(".rtppoint_"+key).val(data.substring(data.indexOf("#")+1));
		});
	}
	catch(e) 
	{
		alert("Error: Unable to process");
	}
 //END Initialize Race Type Point Algorithm//
});

function validatertp()
{
	if(parseInt($("#data_race_type_max_picks").val()) < parseInt($("#maxAllowedrtp").val()))
	{
		return false;
	}
}
</script>