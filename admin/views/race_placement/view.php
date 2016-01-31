<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('athletics_race_mapping');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=athletics_race_mapping">Athletics Race Mapping</a> <span class="divider">/</span></li>
        <li><a href="#">View Athletics Race Map</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>View Athletics Race Map</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
        <input type="hidden" name="action" id="action" value="edit" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
         <fieldset>
            
          <div class="control-group">
              <label class="control-label" for="data_arm_race_id">Choose Race</label>
              <div class="controls">
				
				<?=$objHTML->raceCombo("data_arm_race_id",$datum->arm_race_id, $extra="required",$label="Please Select")?>
           
              </div>
            </div>
           
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">Assign Athletics</label>
               <div class="controls">

				<?=$objHTML->athleticsMultiSelect("data_arm_athlete_id",$objComm->dataExplode($seperator="#",$datum->arm_athlete_id), $extra="required",$label="Please Select")?>

              </div>
            </div>

            <div class="form-actions"> <a href="index.php?model=athletics_race_mapping">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=athletics_race_mapping&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=athletics_race_mapping"><button type="button" class="btn">Cancel</button>
              </a> </div>

          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>