<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('athletictype');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=athletictype">Athletic Type</a> <span class="divider">/</span></li>
        <li><a href="#">Update Athletic Type</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Update Athletic Type</h2>
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
              <label class="control-label" for="data_season_title">Athletic Type Title</label>
              <div class="controls">
				
                <input type="text" required value="<?=$datum->athletic_type_title?>" id="data_athletic_type_title" name="data_athletic_type_title" class="input-xsmall focused">
          
              </div>
            </div>
           
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">Athletic Type Description</label>
               <div class="controls">
				
				<textarea id="data_athletic_type_desc" name="data_athletic_type_desc" required="" maxlength="510" aria-invalid="false">											
					<?=$datum->athletic_type_desc?>
				</textarea>
				
               
          
              </div>
            </div>

            <div class="controls">
               <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Update">Update</button>
              <a href="index.php?model=<?=$model?>"><button type="button" class="btn">Cancel</button></a>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>