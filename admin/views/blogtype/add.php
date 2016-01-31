<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('athletictype');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=blogtype">News Type</a> <span class="divider">/</span></li>
        <li><a href="#">Add News Type</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Add News Type</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
        <input type="hidden" name="action" id="action" value="Save" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
          <fieldset>
            
          <div class="control-group">
              <label class="control-label" for="data_season_title">News Type Title</label>
              <div class="controls">
				
                <input type="text" required value="<?=$datum->cat_title?>" id="data_cat_title" name="data_cat_title" class="input-xsmall focused">
          
              </div>
            </div>
           
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">News Type Description</label>
               <div class="controls">
				
				<textarea id="data_cat_desc" name="data_cat_desc" required="" maxlength="510" aria-invalid="false">											
					<?=$datum->cat_desc?>
				</textarea>
				
                
          
              </div>
            </div>
            <!-- id, cat_title, cat_desc, cat_date, cat_status-->
			 <div class="control-group">
              <label class="control-label" for="name">News Type Status</label>
              <div class="controls"><?=$objHTML->statusBasicCombo('data_cat_status',$datum->cat_status,"required")?></div>
            </div>
     

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