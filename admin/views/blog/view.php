<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('blog');
?>

<style type="text/css">
.largeDataWrapper {width: 500px;}
</style>
<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=blog">News</a> <span class="divider">/</span></li>
    <li><a href="#">View  News</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> View News</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
   <form class="form-horizontal" method="post" action="index.php">
        <fieldset>
            
           <div class="control-group">
              <label class="control-label" for="data_product_name">
                News Title
              </label>
              <div class="controls">
			  <span class="input-xlarge uneditable-input">
				<?=$datum->post_title?>
			  </span>

              </div>
            </div>
			
			 
			
			
		
			<div class="control-group">
              <label class="control-label" for="data_product_desc">
                News Description
              </label>
              <div class="controls largeDataWrapper">
			   <span class="input-xlarge uneditable-textarea">
				<?=$datum->post_desc?>
			  </span>
				
              </div>
            </div>
            
		
			
            <div class="control-group">
              <label class="control-label" for="data_product_status">
                News Status
              </label>
              <div class="controls">
			   
				<?=$objHTML->generateCustomCombo(array("Active"=>"Active","Deactive"=>"Deactive"),"data_post_status",$datum->post_status,"required disabled",$label="Select Status")?>
			  
			  
              </div>
			</div>
			
			<div class="controls"> 
				<a href="index.php?model=blog">
					<button type="button" class="btn btn-primary">Back</button>
				</a> 
				<a href="index.php?model=blog&action=edit&id=<?=$_REQUEST['id']?>">
					<button type="button" class="btn btn-success">Edit</button>
				</a> 
					<a href="index.php?model=blog"><button type="button" class="btn">Cancel</button>
				</a> 
			</div>
			  
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>


