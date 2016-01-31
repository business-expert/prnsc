<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('events');


?>

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=events">Events</a> <span class="divider">/</span></li>
    <li><a href="#">Add Event</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Event</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <fieldset>
            
           <div class="control-group">
              <label class="control-label" for="data_fname">
                Event Title
              </label>
              <div class="controls">
                <input type="text" required value="<?=$datum->name?>" id="data_name" name="data_name" class="input-xsmall focused">
              </div>
            </div>
           
          
            <div class="control-group">
              <label class="control-label" for="data_season">
               Event Season
              </label>
              <div class="controls">
                 <?=$objHTML->seasonBasicCombo("data_season","", "required");?>
			  </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_season">
               Event Description
              </label>
              <div class="controls">
                 <textarea name="data_event_desc" id="data_event_desc"> 
				 
					<?=$datum->event_desc?>
				 </textarea>
			  </div>
            </div>
			
			
			
			<div class="control-group">
              <label class="control-label" for="data_season">
               Event Start
              </label>
              <div class="controls input-append date" id="event_start_date_time">
                 <input style="display:inline-none;" value="<?=$datum->event_start_date_time?>" type="text" name="data_event_start_date_time" id="data_event_start_date_time"></input>
					<span class="add-on">
					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					</span>
			  </div>
            </div>
        
		<div class="control-group">
              <label class="control-label" for="data_season">
               Event End
              </label>
              <div class="controls input-append date" id="event_end_date_time">
                 <input style="display:inline-none;" value="<?=$datum->event_end_date_time?>" type="text" name="data_event_end_date_time" id="data_event_end_date_time"></input>
					<span class="add-on">
					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					</span>
			  </div>
            </div>

		
			
			<div class="control-group">
              <label class="control-label" for="data_event_image">
               Event Image
              </label>
              <div class="controls">
                <input type="file" name="data_event_image" id="data_event_image" />
			  </div>
            </div>
			
			
            
            <div class="control-group">
              <label class="control-label" for="data_active">
                Active Status
              </label>
              <div class="controls">
			   <?=$objHTML->activeBasicCombo("data_active","", "required");?>
              </div>
			</div>
            <div class="controls">
               <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="save">Save Changes</button>
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
      $('#event_start_date_time').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss'
      });
	  
	   $('#event_end_date_time').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss'
      });
 </script>
	
	
    