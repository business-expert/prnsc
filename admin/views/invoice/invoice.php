<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('invoice');

?>

<div>
    <ul class="breadcrumb">
        <li><a href="index.php?model=invoice">Invoice & Product Status</a> <span class="divider">/</span><a href="#">All Products</a></li>
       
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Invoice & Product Status</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3>Search</h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right">Status: 
					<?=$objHTML->generateCustomCombo(array("INVOICE"=>"INVOICE","DISPATCH"=>"DISPATCH","RECEIVE"=>"RECEIVE"),"sr_pstatus_status",$_REQUEST["sr_pstatus_status"],$extra,$label="Select Status")?>
				</td>
                <td align="right"></td>
                <td align="right">
                	<button style="margin:-13px 0px 0 0;" class="btn btn-small btn-success">Search</button>
	                <button style="margin:-13px 0px 0 0;" class="btn btn-small btn-info" onclick="ResetSearch();">Reset</button>
                </td>                
            </tr>
        </table>
        </form>
        <div class="page-header" style="padding-bottom:0px;margin:-10px 0;"></div>
      <br />
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
        
          <tr>
			<th>Invoice #</th>
            <th>Invoice Number</th>
            <th>Customer Name</th>
            <th>Product QTY</th>
			<!--<th>Product Price</th> -->
			<th>Total Paid</th>
			<th>Add ON</th>
			<th>Status</th>
            <th nowrap>Action</th>            
          </tr>
        </thead>
        <tbody>
        
		<?php foreach($data as $datum){$view="index.php?model=invoice&action=view&pi_id=".$datum->pi_id;$edit="index.php?model=invoice&action=edit&pi_id=".$datum->pi_id;?>
				
			<tr id="<?=$datum->pi_id?>">
			<form action="index.php?model=invoice" method="post">
			<input type="hidden" name="pi_id" value="<?=$datum->pi_id?>" />
			<input type="hidden" name="action" value="update" />
				<td class="center"><?=$datum->pi_id?></td>	
				<td class="center"><?=$datum->pi_invoice_number?></td>
				<td class="center"><?=$datum->pi_purchaser_name?></td>
			
				<td class="center"><?=$datum->porder_product_qty?></td>
				<td class="center"><?=$datum->porder_product_paid_amount?></td>
				<td class="center"><?=date("Y-m-d",strtotime($datum->pstatus_invoice_date))?></td>
				<td class="center">
				<?=$objHTML->generateCustomCombo(array("INVOICE"=>"INVOICE","DISPATCH"=>"DISPATCH","RECEIVE"=>"RECEIVE"),"pstatus_status",$datum->pstatus_status,$extra,$label="Select Status")?>
				
				</td>
				<td class="center" nowrap>
				
				<a class="btn btn-success" href="<?=$view?>" alt="View Invoice" title="View Athletes"> <i class="icon-zoom-in icon-white"></i></a> 
					<button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Update" alt="Select Status from Dropdown and then Click on Update button" title="Select Status from Dropdown and then Click on Update button">Update</button>
				<a class="btn btn-danger delete_datum" id="deleted_<?=$datum->pi_id?>" data="product_invoice;pi_id;<?=$datum->pi_id?>" href="#" alt="Delete Athletes" title="Delete Athletes"> <i class="icon-trash icon-white"></i></a>
				</td>
			</form>
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