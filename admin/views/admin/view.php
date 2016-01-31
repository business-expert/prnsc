<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('admin');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=admin">Admin</a> <span class="divider">/</span></li>
        <li><a href="#">View Admin</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>View Admin</h2>
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
              <label class="control-label" for="data_admin_name">Name</label>
              <div class="controls">
                <span class="input-xlarge uneditable-input"><?=$datum->admin_name?></span>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="data_admin_email">Email</label>
              <div class="controls">
                  <span class="input-xlarge uneditable-input"><?=$datum->admin_email?></span>
              </div>
            </div>
            
            <div class="form-actions"> <a href="index.php?model=admin">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=admin&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=admin"><button type="button" class="btn">Cancel</button>
              </a> </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

