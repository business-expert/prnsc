<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('race');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=athletictype">Athletic Type</a> <span class="divider">/</span></li>
        <li><a href="#">View Athletic Type</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>View Athletic Type</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
          <fieldset>
            
          <div class="control-group">
              <label class="control-label" for="data_season_title">Athletic Type Title</label>
              <div class="controls">
				<span class="input-xlarge uneditable-textarea">
               <?=$datum->athletic_type_title?>
				</span>
              </div>
            </div>
           
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">Athletic Type Description</label>
               <div class="controls">
				<span class="input-xlarge uneditable-textarea">
                <?=$datum->athletic_type_desc?>
				</span>
              </div>
            </div>
			
			
            <div class="form-actions"> <a href="index.php?model=athletictype">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=athletictype&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=athletictype"><button type="button" class="btn">Cancel</button>
              </a> </div>
			  
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>