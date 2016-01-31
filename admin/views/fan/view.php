<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('product');
?>

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=fan">Fan</a> <span class="divider">/</span></li>
    <li><a href="#">View  Fan</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> View Fan</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
   <form class="form-horizontal" method="post" action="index.php">
        <fieldset>
            
           <div class="control-group">
              <label class="control-label" for="data_product_name">
                Fan Name
              </label>
              <div class="controls">
			  <span class="input-xlarge uneditable-input">
				<?=$datum->fb_name?>
			  </span>

              </div>
            </div>
			
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan Email
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-input">
						<?=$datum->fb_email?>
					  </span>
				  </div>
			 </div>
			 
			 
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan User Name
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-input">
						<?=$datum->fb_username?>
					  </span>
				  </div>
			 </div>
			 
			 
			 
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan Picture
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-textarea">
						<img src="<?=$datum->fb_picture?>" class="img100" />
					  </span>
				  </div>
			 </div>
			 
			 
			 
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan Contact
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-input">
						<?=$datum->fb_phone?>
					  </span>
				  </div>
			 </div>
			 
			 
			 
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan Location
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-input">
						<?=$datum->fb_location?>
					  </span>
				  </div>
			 </div>
			 
			 
			 
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan Bio
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-textarea">
						<?=$datum->fb_bio?>
					  </span>
				  </div>
			 </div>
			 
			 
			 
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan Friend List
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-textarea">
						<?php echo (is_null($datum->fb_friendlists)) ? 0 : $datum->fb_friendlists;?>
					  </span>
				  </div>
			 </div>
			 
			 
			 
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan Visited
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-input">
						<?=$datum->fb_visit_count?>
					  </span>
				  </div>
			 </div>
			 
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan Points
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-input">
						<?=$datum->TOTAL_POINTS?>
					  </span>
				  </div>
			 </div>
			 
			 
			 <div class="control-group">
				  <label class="control-label" for="data_product_type_id">
					Fan Add ON
				  </label>
				  <div class="controls">
					  <span class="input-xlarge uneditable-input">
						<?=date("Y-m-d",strtotime($datum->fb_date))?>
					  </span>
				  </div>
			 </div>


            <div class="control-group">
              <label class="control-label" for="data_product_status">
                Fan Status
              </label>
              <div class="controls">
			   <span class="input-xlarge uneditable-input">
				<?=$datum->fb_status?>
			  </span>
			  
              </div>
			</div>
			
			<div class="controls"> 
				<a href="index.php?model=fan">
					<button type="button" class="btn btn-primary">Back</button>
				</a> 
				<!--<a href="index.php?model=product&action=edit&id=<?php //echo $_REQUEST['id']?>">
					<button type="button" class="btn btn-success">Edit</button>
				</a> 
				-->
				<a href="index.php?model=fan"><button type="button" class="btn">Cancel</button>
				</a> 
			</div>
			  
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>


