<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('product');
?>

<!-- START Code for Color Picker -->
<link rel="stylesheet" href="media/colorPicker/pick-a-color-1.1.7.min.css">	  
<style type="text/css">
.color-menu-tabs span a{ display: inline; }
.btn-group {float:left;}
</style>	
<!-- END Code for Color Picker -->

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=product">Product</a> <span class="divider">/</span></li>
    <li><a href="#">Update  Product</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Update Product</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php" enctype="multipart/form-data">
       <input type="hidden" name="action" id="action" value="edit" />
          <input type="hidden" name="model"  id="model"  value="<?=$_REQUEST['model']?>" />
          <input type="hidden" name="pk_id"  id="pk_id"  value="<?=$_REQUEST['id']?>" />
        <fieldset>
            
           <div class="control-group">
              <label class="control-label" for="data_fname">
                Product Title
              </label>
              <div class="controls">
                <input type="text" required value="<?=$datum->product_name?>" id="data_product_name" name="data_product_name" class="input-xsmall focused">
              </div>
            </div>
			
			 <div class="control-group">
              <label class="control-label" for="data_product_type_id">
                Product Type
              </label>
              <div class="controls">
			   <?=$objHTML->productTypeCombo("data_product_type_id",$datum->product_type_id, "required");?>
              </div>
			</div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_price">
                Product Price
              </label>
              <div class="controls">
                <input type="text" required value="<?=$datum->product_price?>" id="data_product_price" name="data_product_price" class="input-xsmall focused">
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_variations">
                Product Variations
              </label>
              <div class="controls">
                <input type="text" required value="<?=$datum->product_variations?>" id="data_product_variations" name="data_product_variations" class="input-xsmall focused">
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_size">
                Product Size
              </label>
              <div class="controls">
                <?=$objHTML->generateCustomCombo(array("SMALL"=>"SMALL","MEDIUM"=>"MEDIUM","BIG"=>"BIG"),"data_product_size",$datum->product_size,$extra,$label="Select Product Size")?>
              </div>
            </div>
		
			<div class="control-group">
              <label class="control-label" for="data_product_desc">
                Product Description
              </label>
              <div class="controls">
				<textarea name="data_product_desc" id="data_product_desc">
				<?=$datum->product_desc?>
				</textarea>
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_color">
                 Product Colour
              </label>
              <div class="controls">
                <input type="text" required value="<?=$datum->product_color?>" id="data_product_color" name="data_product_color" class="input-xsmall focused pick-a-color"  style="width:140px;" />
              </div>
            </div>


			
			<div class="control-group">
              <label class="control-label" for="data_product_image">
               Product Image
              </label>
              <div class="controls">
                <input type="file" name="data_product_image" id="data_product_image" />
				<img src="<?=FILE_VIEW_PATH?>/<?=$datum->product_image?>" class="img100" />
			  </div>
            </div>
	
            
			
			<div class="control-group">
              <label class="control-label" for="data_product_total_products">
                Products in Inventory
              </label>
              <div class="controls">
                <input type="text" required value="<?=$datum->product_total_products?>" id="data_product_total_products" name="data_product_total_products" class="input-xsmall focused">
              </div>
            </div>
			
            <div class="control-group">
              <label class="control-label" for="data_product_status">
                Product Status
              </label>
              <div class="controls">
			   <?=$objHTML->statusBasicCombo("data_product_status",$datum->product_status, "required");?>
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


<!-- START Code for Color Picker -->
<script src="media/colorPicker/tinycolor-0.9.15.min.js"></script>
<script src="media/colorPicker/pick-a-color.js"></script>	
<script type="text/javascript">	
$(document).ready(function () {
	$(".pick-a-color").pickAColor({
	  showSpectrum            : true,
		showSavedColors         : true,
		saveColorsPerElement    : true,
		fadeMenuToggle          : true,
		showAdvanced						: true,
		showBasicColors         : true,
		showHexInput            : true,
		allowBlank							: true
	});			
});	
</script>
<!-- END Code for Color Picker -->
