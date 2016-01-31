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
    <li><a href="#">Add Product</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Add Product</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
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
			   <?=$objHTML->productTypeCombo("data_product_type_id","", "required class='productType'");?>
              </div>
			</div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_price">
                Product Price
              </label>
              <div class="controls">
                <input type="text" value="<?=$datum->product_price?>" id="data_product_price" name="data_product_price" class="input-xsmall focused">
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_variations">
                Product Variations
              </label>
              <div class="controls">
                <input type="text" value="<?=$datum->product_variations?>" id="data_product_variations" name="data_product_variations" class="input-xsmall focused">
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_product_size">
                Product Size
              </label>
              <div class="controls">
			  <?=$objHTML->generateCustomCombo(array("SMALL"=>"SMALL","MEDIUM"=>"MEDIUM","BIG"=>"BIG"),"data_product_size",$datum->product_size,$extra,$label="Select Product Size")?>
               <!-- <input type="text" required value="<?=$datum->product_size?>" id="data_product_size" name="data_product_size" class="input-xsmall focused">-->
              </div>
            </div>
		
			<div class="control-group">
              <label class="control-label" for="data_product_desc">
                Product Description
              </label>
              <div class="controls">
				<textarea required name="data_product_desc" id="data_product_desc">
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
              <label class="control-label" for="data_product_image" id="product_image_label">
               Product Image
              </label>
              <div class="controls">
                <input required type="file" name="data_product_image" id="data_product_image" />
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
			   <?=$objHTML->statusBasicCombo("product_status","", "required");?>
              </div>
			</div>
			
            <div class="controls">
               <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="save">Save Changes</button>
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


<!-- START Code Disable/enable input fields based on Product type -->
<script type="text/javascript">	
$(document).ready(function () {
	$(".productType").change(function(e){
		e.preventDefault();
		
		if($(this).val()==1)
		{
			
			$("#data_product_price").attr('disabled','disabled');
			$("#data_product_variations").attr('disabled','disabled');
			$("#data_product_size").attr('disabled','disabled');

			$("#product_image_label").html("Upload Product");
		}
		else if($(this).val()==2)
		{
			$("#data_product_price").prop('disabled', false);
			$("#data_product_variations").prop('disabled', false);
			$("#data_product_size").prop('disabled', false);
			$("#product_image_label").html("Product Image");
		}
	});			
});	
</script>
<!-- END Code Disable/enable input fields based on Product type -->
