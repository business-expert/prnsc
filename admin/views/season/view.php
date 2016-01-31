<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

?>

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=season">Season</a> <span class="divider">/</span></li>
        <li><a href="#">View Season</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>View Season</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <form class="form-horizontal">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="typeahead">Season Id</label>
              <div class="controls"> <span class="input-xlarge uneditable-input">
                <?=$datum->id?>
                </span> </div>
            </div>
             
            <div class="control-group">
              <label class="control-label" for="name">Season Name</label>
              <div class="controls"> <span class="input-xlarge uneditable-input">
                <?=$datum->season_title?>
                </span> </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name">Season Description</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$datum->season_desc?>
                </span></div>
            </div>
			
			<div class="control-group">
              <label class="control-label" for="data_season">
               Season Start
              </label>
              <div class="controls input-append date" id="data_season_start_date">
			  <span class="input-xlarge uneditable-input">
				<?=$datum->season_start_date?>
			  </span>
                
					
			  </div>
            </div>
        
		<div class="control-group">
              <label class="control-label" for="data_season">
               Season End
              </label>
              <div class="controls input-append date" id="data_season_end_date">
                 <span class="input-xlarge uneditable-input">
				<?=$datum->season_end_date?>
			  </span>
			  </div>
            </div>
			
			
			
            <div class="control-group">
              <label class="control-label" for="name">Add On</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=date("Y-m-d",strtotime($datum->season_date))?>
                </span></div>
            </div>
         
            <div class="control-group">
              <label class="control-label" for="name">Season Status</label>
              <div class="controls"><span class="label"><?=$datum->season_status?></span></div>
            </div>
            <div class="form-actions"> <a href="index.php?model=season">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=season&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=season"><button type="button" class="btn">Cancel</button>
              </a> </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!--/span--> 
  
</div>
