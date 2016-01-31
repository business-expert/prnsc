<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('race');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=blogtype">News Type</a> <span class="divider">/</span></li>
        <li><a href="#">View News Type</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>View News Type</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
          <fieldset>
            
          <div class="control-group">
              <label class="control-label" for="data_season_title">News Type Title</label>
              <div class="controls">
				<span class="input-xlarge uneditable-input">
               <?=$datum->cat_title?>
				</span>
              </div>
            </div>
           
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">News Type Description</label>
               <div class="controls">
				<span class="input-xlarge uneditable-textarea">
                <?=$datum->cat_desc?>
				</span>
              </div>
            </div>
			
			 <div class="control-group">
              <label class="control-label" for="name">News Type Status</label>
              <div class="controls"><?=$objHTML->statusBasicCombo('data_cat_status',$datum->cat_status,"disabled")?></div>
            </div>
			
			
            <div class="form-actions"> <a href="index.php?model=blogtype">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=blogtype&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=blogtype"><button type="button" class="btn">Cancel</button>
              </a> </div>
			  
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>