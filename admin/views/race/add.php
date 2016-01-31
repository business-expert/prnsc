<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('race');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=race">Race</a> <span class="divider">/</span></li>
        <li><a href="#">Add Race</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Add Race</h2>
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
              <label class="control-label" for="data_race_title">Race Title / Type</label>
              <div class="controls">
				<?=$objHTML->raceTypeCombo('data_race_type',"","required", "Select Race Type")?> 
              </div>
            </div>
			
			<!-- race_title race_start_datetime 

<div class="controls">
			  <input type="text" required value="<?=$datum->race_title?>" id="data_race_title" name="data_race_title" class="input-xsmall focused">
				
              </div>
			race_end_datetime  -->
			
			
         
           
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">Event</label>
              <div class="controls">
				<?=$objHTML->eventTypeCombo('data_event_id',"","required","Select Event")?> 
    
              </div>
            </div>
            
			
			<div class="control-group">
              <label class="control-label" for="data_season">
               Race Start
              </label>
              <div class="controls input-append date" id="data_race_start_datetime">
                 <input style="display:inline-none;" value="<?=$datum->race_start_datetime?>" type="text" name="data_race_start_datetime" id="data_race_start_datetime"></input>
					<span class="add-on">
					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					</span>
			  </div>
            </div>
        
		<div class="control-group">
              <label class="control-label" for="data_season">
               Race End
              </label>
              <div class="controls input-append date" id="data_race_end_datetime">
                 <input style="display:inline-none;" value="<?=$datum->race_end_datetime?>" type="text" name="data_race_end_datetime" id="data_race_end_datetime"></input>
					<span class="add-on">
					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					</span>
			  </div>
            </div>

            
            <div class="control-group">
              <label class="control-label" for="name">Race Status</label>
              <div class="controls"><?=$objHTML->statusBasicCombo('data_race_active',"","required")?></div>
            </div>

            <div class="controls">
               <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="save">Save</button>
              <a href="index.php?model=<?=$model?>"><button type="button" class="btn">Cancel</button></a>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<link type="text/css" rel="stylesheet" href="<?=CSS_ADMIN?>bootstrap-datetimepicker.min.css" />
<script src="<?=JS_ADMIN?>jquery-1.8.3.js"></script>
<script src="<?=JS_ADMIN?>bootstrap.min.js"></script>
<script src="<?=JS_ADMIN?>bootstrap-datetimepicker.min.js"></script>
<script src="<?=JS_ADMIN?>bootstrap-datetimepicker.pt-BR.js"></script>
<script type="text/javascript">
      $('#data_race_start_datetime').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss'
      });
	  
	   $('#data_race_end_datetime').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss'
      });
 </script>