<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('race');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=race">Race</a> <span class="divider">/</span></li>
        <li><a href="#">View Race</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>View Race</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
          <fieldset>
            
			
			<div class="control-group">
              <label class="control-label" for="data_race_title">Race Title</label>
              <div class="controls">
			  <span class="input-xlarge uneditable-input">
				<?=$datum->race_title?>
			  </span>	
			  
				
              </div>
            </div>
      
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">Event</label>
              <div class="controls">
				<span class="input-xlarge uneditable-input">
				<?=$datum->name?>
			  </span>	
              </div>
            </div>
            

				<div class="control-group">
              <label class="control-label" for="data_season">
               Race Start
              </label>
              <div class="controls input-append date" id="data_race_start_datetime">
                <span class="input-xlarge uneditable-input">
					<?=$datum->race_start_datetime?>
					</span>
			  </div>
            </div>
        
		<div class="control-group">
              <label class="control-label" for="data_season">
               Race End
              </label>
              <div class="controls input-append date" id="data_race_end_datetime">
                 <span class="input-xlarge uneditable-input">
				 <?=$datum->race_end_datetime?>
					
					</span>
			  </div>
            </div>
			
            
            <div class="control-group">
              <label class="control-label" for="name">Race Status</label>
              <div class="controls">
			  <span class="input-xlarge uneditable-input">
			  <?=$datum->race_active?>
			  </span>
			  </div>
            </div>

            <div class="form-actions"> <a href="index.php?model=race">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=race&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=race"><button type="button" class="btn">Cancel</button>
              </a> </div>
			  
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>