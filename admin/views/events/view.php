<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
?>

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=events">Events</a> <span class="divider">/</span></li>
    <li><a href="#">Event Details</a></li>
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
        <form class="form-horizontal">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="typeahead">Event Id</label>
              <div class="controls"> <span class="input-xlarge uneditable-input">
                <?=$datum->id?>
                </span> </div>
            </div>
             
            <div class="control-group">
              <label class="control-label" for="name">Event Title</label>
              <div class="controls"> <span class="input-xlarge uneditable-input">
                <?=$datum->name?>
                </span> </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name">Season</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$datum->season?>
                </span></div>
            </div>
			
			
			
				<div class="control-group">
              <label class="control-label" for="data_season">
               Event Description
              </label>
              <div class="controls">
			  <span class="input-xlarge uneditable-textarea span270">

					<?=$datum->event_desc?>

				</span> 
			  </div>
            </div>
			
			
			
			<div class="control-group">
              <label class="control-label" for="data_season">
               Event Start
              </label>
              <div class="controls">
			  <span class="input-xlarge uneditable-input">
                <?=$datum->event_start_date_time?>
			</span>		
			  </div>
            </div>
			
			<div class="control-group">
              <label class="control-label" for="data_season">
              Event End
              </label>
              <div class="controls">
			  <span class="input-xlarge uneditable-input">
                <?=$datum->event_end_date_time?>
			</span>		
			  </div>
            </div>
      
			
			<div class="control-group">
              <label class="control-label" for="data_season">
               Event Image
              </label>
              <div class="controls">
			
				<img src="<?=FILE_VIEW_PATH?>/<?=$datum->event_image?>" style="height:100px;width:100px;" />
				
			  </div>
            </div>
			
            <div class="control-group">
              <label class="control-label" for="name">Active</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$datum->active?>
                </span></div>
            </div>
         
          
            <div class="controls"> <a href="index.php?model=events">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=events&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=events"><button type="button" class="btn">Cancel</button>
              </a> </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!--/span--> 
  
</div>
