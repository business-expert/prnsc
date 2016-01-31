<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('product');

?>

<div>
    <ul class="breadcrumb">
        <li><a href="index.php?model=product">Product</a> <span class="divider">/</span><a href="#">All Products</a></li>
       
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Product</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3>Search</h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right">Name : <input type="search" name="sr_name" id="sr_name" value="<?=$_REQUEST['sr_name']?>"  /></td>
                <td align="right"></td>
                <td align="right">
                	<button style="margin:-13px 0px 0 0;" class="btn btn-small btn-success">Search</button>
	                <button style="margin:-13px 0px 0 0;" class="btn btn-small btn-info" onclick="ResetSearch();">Reset</button>
                </td>                
            </tr>
        </table>
        </form>
        <div class="page-header" style="padding-bottom:0px;margin:-10px 0;"></div>
      
      <div class="control-group" style="text-align:right;margin:20px 0 0 0;">
        <div class="controls"> 
           <a class="btn btn-success" href="index.php?model=product&action=add"><i class="icon-plus icon-white"></i> Add New Product</a> 
        </div>
      </div>
      <br />
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
        
          <tr>
			<th>Product #</th>
            <th>Product Title</th>
            <th>Product Price</th>
            <th>Product Total</th>
			<th>Product Remain</th>
			<th>Add ON</th>
			<th>Active</th>
            <th nowrap>Action</th>            
          </tr>
        </thead>
        <tbody>
        
		<?php foreach($data as $datum){$view="index.php?model=product&action=view&id=".$datum->id;$edit="index.php?model=product&action=edit&id=".$datum->id;?>
				<tr id="<?=$datum->id?>">
				<td class="center"><?=$datum->id?></td>	
				<td class="center"><?=$datum->product_name?></td>
				<td class="center"><?=$datum->product_price?></td>
				<td class="center"><?=$datum->product_total_products?></td>
				<td class="center"><?=$datum->product_remain_total_products?></td>
				<td class="center"><?=$datum->product_date?></td>
				<td class="center"><span class="label"><?=$datum->product_status?></span></td>
				<td class="center" nowrap>
				
				<a class="btn btn-success" href="<?=$view?>" alt="View Athletes" title="View Athletes"> <i class="icon-zoom-in icon-white"></i></a> 
				<a class="btn btn-info" href="<?=$edit?>" alt="Edit Athletes" title="Edit Athletes"> <i class="icon-edit icon-white"></i></a> 
				<a class="btn btn-danger delete_datum" id="deleted_<?=$datum->id?>" data="product;id;<?=$datum->id?>" href="#" alt="Delete Athletes" title="Delete Athletes"> <i class="icon-trash icon-white"></i></a>
				</td>
				</tr>
		<?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/span--> 
  
</div>


<script>

//"sDom":'<"bottom"<"clear">>rt<"bottom"iflp<"clear">>'
//"sDom": "<'top'<'row-fluid'<'span6'><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",	

$( document ).ready(function() {
	$('.datatable1').dataTable({
		"sDom": "<'row-fluid'<'span6'><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {"sLengthMenu": "_MENU_ records per page"},
	    "bFilter": false,
	} );
});


function ResetSearch()
{
	$("#frm_search input,select").val('');
	$("#frm_search").submit();
}

	
</script>	
<script type="text/javascript" src="<?=JS_ADMIN?>common_func.js"></script>
<script type="text/javascript">
$(function() {
	$(".delete_datum").deleteData({
	dataOnDeleted : function(response){
		var JSONObject = $.parseJSON(response);
	}
	});
});
</script>	