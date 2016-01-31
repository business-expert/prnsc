<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
?>

<style type="text/css">
.largeDataWrapper {width: 500px;}
</style>
<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=comment">Comment</a> <span class="divider">/</span></li>
    <li><a href="#">View Comment</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> View Comment</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="box-content">
	<div style="padding-bottom:5px;margin:8px 0;" class="page-header">
	<h3>
	News Title: <?=$datum->post_title?> ,  Total Comments: <?=$datum->TOTAL_COMMENTS?>
	</h3>
	</div>
   <form class="form-horizontal" method="post" action="index.php">
        <fieldset>
            
           <div class="control-group">
              <label class="control-label" for="data_comment_name">
                Name
              </label>
              <div class="controls">
               <span class="input-xlarge uneditable-input">
			   <?=$datum->comment_name?>
			   </span>
              </div>
            </div>
			

			<div class="control-group">
              <label class="control-label" for="data_comment_email">
                Email
              </label>
              <div class="controls">
               <span class="input-xlarge uneditable-input">
			   <?=$datum->comment_email?>
			   </span>
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_comment_contact">
                Contact
              </label>
              <div class="controls">
               <span class="input-xlarge uneditable-input">
			   <?=$datum->comment_contact?>
			   </span>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label" for="data_comment_desc">
                Description
              </label>
              <div class="controls">
				<span class="input-xlarge uneditable-textarea">
					<?=$datum->comment_desc?>
				</span>
              </div>
            </div>

			
            <div class="control-group">
              <label class="control-label" for="data_product_status">
                Status
              </label>
              <div class="controls">
			  
			  <?=$objHTML->generateCustomCombo(array("Active"=>"Active","Deactive"=>"Deactive"),"data_comment_status",$datum->comment_status,"disabled",$label="Select Status")?>
			  
              </div>
			</div>
			
			<div class="controls"> 
				<a href="index.php?model=comment">
					<button type="button" class="btn btn-primary">Back</button>
				</a> 
				
					<a href="index.php?model=comment"><button type="button" class="btn">Cancel</button>
				</a> 
			</div>
			  
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>


