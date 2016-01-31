<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('product');
?>

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=product">Product</a> <span class="divider">/</span></li>
    <li><a href="#">View  Product</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> View Product</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
   <form class="form-horizontal" method="post" action="index.php">
        <fieldset>
            
           <div class="control-group">
              <label class="control-label" for="data_product_name">
                Product Title
              </label>
              <div class="controls">
			  <span class="input-xlarge uneditable-input">
				<?=$datum->product_name?>
			  </span>

              </div>
            </div>
			
			 <div class="control-group">
              <label class="control-label" for="data_product_type_id">
                Product Type
              </label>
              <div class="controls">
			  <span class="input-xlarge uneditable-input">
				<?=$datum->product_type?>
			  </span>
			   
              </div>
			</div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_price">
                Product Price
              </label>
              <div class="controls">
			   <span class="input-xlarge uneditable-input">
				<?=$datum->product_price?>
			  </span>
                
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_variations">
                Product Variations
              </label>
              <div class="controls">
			   <span class="input-xlarge uneditable-input">
				<?=$datum->product_variations?>
			  </span>
                
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_size">
                Product Size
              </label>
              <div class="controls">
			   <span class="input-xlarge uneditable-input">
				<?=$datum->product_size?>
			  </span>
                
              </div>
            </div>
		
			<div class="control-group">
              <label class="control-label" for="data_product_desc">
                Product Description
              </label>
              <div class="controls">
			   <span class="input-xlarge uneditable-textarea">
				<?=$datum->product_desc?>
			  </span>
				
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_color">
                 Product Colour
              </label>
              <div class="controls">
			   <span class="input-xlarge uneditable-input" style="background-color:#<?=$datum->product_color?>">
				
			  </span>
          
              </div>
            </div>


			
			<div class="control-group">
              <label class="control-label" for="data_product_image">
               Product Image
              </label>
              <div class="controls">
			   <span class="input-xlarge uneditable-textarea">
				<img src="<?=FILE_VIEW_PATH?>/<?=$datum->product_image?>" class="img200"/>
			  </span>
          		
			  </div>
            </div>
	
            
			
			<div class="control-group">
              <label class="control-label" for="data_product_inventory_total_products">
                Products in Inventory
              </label>
              <div class="controls">
			   <span class="input-xlarge uneditable-input">
				<?=$datum->product_total_products?>
			  </span>
                
              </div>
            </div>
			
            <div class="control-group">
              <label class="control-label" for="data_product_status">
                Product Status
              </label>
              <div class="controls">
			   <span class="input-xlarge uneditable-input">
				<?=$datum->product_status?>
			  </span>
			  
              </div>
			</div>
			
			<div class="controls"> 
				<a href="index.php?model=product">
					<button type="button" class="btn btn-primary">Back</button>
				</a> 
				<a href="index.php?model=product&action=edit&id=<?=$_REQUEST['id']?>">
					<button type="button" class="btn btn-success">Edit</button>
				</a> 
					<a href="index.php?model=product"><button type="button" class="btn">Cancel</button>
				</a> 
			</div>
			  
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>


