<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('blog');
?>

<script type="text/javascript" src="<?=MEDIA_ADMIN?>/tinymce/tinymce/tinymce.min.js">
</script>

<script type="text/javascript">
tinymce.init({
    selector: "#data_post_desc",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=blog">News</a> <span class="divider">/</span></li>
    <li><a href="#">Update News</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Update News</h2>
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
                News Title
              </label>
              <div class="controls">
                <input type="text" required value="<?=$datum->post_title?>" id="data_post_title" name="data_post_title" class="input-xsmall focused">
              </div>
            </div>
			

			<div class="control-group">
              <label class="control-label" for="data_post_desc">
                News Description
              </label>
              <div class="controls">
				<textarea required name="data_post_desc" id="data_post_desc">
				<?=$datum->post_desc?>
				</textarea>
              </div>
            </div>
			
			
		

			<!--
			<div class="control-group">
              <label class="control-label" for="data_product_image" id="product_image_label">
               Product Image
              </label>
              <div class="controls">
                <input required type="file" name="data_product_image" id="data_product_image" />
			  </div>
            </div>
			-->
            
			
			
            <div class="control-group">
              <label class="control-label" for="data_product_status">
                News Status
              </label>
              <div class="controls">
			  
			  <?=$objHTML->generateCustomCombo(array("Active"=>"Active","Deactive"=>"Deactive"),"data_post_status",$datum->post_status,"required",$label="Select Status")?>
			  
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
