<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('racetype');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=racetype">Race Type</a> <span class="divider">/</span></li>
        <li><a href="#">Add Race Type</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Add Race Type</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
        <input type="hidden" name="action" id="action" value="save" />
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
				
                <?=$objHTML->generateCustomCombo($objComm->getAthletesType(),"data_race_type_athletic_code",$datum->type,"required","Select")?>
          
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
				
                <input type="text" required value="<?=$datum->race_type_max_picks?>" id="data_race_type_max_picks" name="data_race_type_max_picks" class="input-xsmall focused">
          
              </div>
            </div>
			
			
<!-- START Race Picks position algorithm -->	
<!-- sheepIt Form -->
<div id="sheepItForm">
  <!-- Form template-->
  <div id="sheepItForm_template" class="control-group">
    <label class="control-label" for="sheepItForm_#index#_phone">Race Picks Points <span id="sheepItForm_label">
	</span></label>
	<div class="controls">
    <input id="sheepItForm_#index#_phone" name="person[phones][#index#][phone]" type="text"/>
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
               <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Save">Save</button>
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
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 1
    });
 
});
</script>