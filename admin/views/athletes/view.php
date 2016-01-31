<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$arrAthletesStatus = $objComm->getAthletesStatus();
?>

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=athletes">Athletes</a> <span class="divider">/</span></li>
    <li><a href="#">View Athletes</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Athletes</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <form class="form-horizontal">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="name">Name</label>
              <div class="controls"> <span class="input-xlarge uneditable-input">
                <?=$datum->name?>
                </span> </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name">Facebook Url</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$datum->facebook_url?>
                </span></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">Photo Url</label>
                <div class="controls">
				<span class="input-xlarge uneditable-textarea">
             
				<?php $image = (exif_imagetype($datum->photo_url) == IMAGETYPE_JPEG) ? $datum->photo_url : DEFAULT_ATHLETES_PROFILE_AVTAR; ?>			 
                </span>&nbsp;&nbsp;<img src='<?=$image?>'></div>
            </div>
         
		 
		 
		 <div class="control-group">
              <label class="control-label" for="data_education_level">Bio</label>
              <div class="controls">
					<span class="input-xlarge uneditable-textarea">
						<?=$datum->bio?>&nbsp;
					</span>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label" for="data_type">Athlete Type</label>
			  <div class="controls">
              <span class="input-xlarge uneditable-input">
                  <?=$datum->type?>
              </span>
			  </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name">Athlete Status</label>
              <div class="controls"><span class="label <?=$arrAthletesStatus[$datum->status]?>"><?=$datum->status?></span></div>
            </div>
            
            <div class="controls"> <a href="index.php?model=athletes">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=athletes&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=athletes"><button type="button" class="btn">Cancel</button>
              </a> </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!--/span--> 
  
</div>
