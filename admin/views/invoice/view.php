<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('invoice');
?>

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=invoice">Invoice & Product Status</a> <span class="divider">/</span></li>
    <li><a href="#">View  Invoice & Product Status</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> View Invoice & Product Status</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
		  <div class="page-header">
		  <h1></h1>
		  <small>Invoice:&nbsp;&nbsp;#<?=$data[0]->pi_invoice_number?>,
		  &nbsp;&nbsp;&nbsp;&nbsp;To:&nbsp;&nbsp;<?=$data[0]->pi_purchaser_name?>, 
		  &nbsp;&nbsp;&nbsp;&nbsp;Status:&nbsp;&nbsp;<?=$data[0]->pstatus_status?>	
		  </small>
	
		</div>
		
		
		
<div class="row-fluid">
	<div class="span6">
	<h3>Items Description</h3>
	<p>
		&nbsp;
	</p>
	</div>
	<div class="span6">
	<h3>Total Amount</h3>
	<p>
		&nbsp;
	</p>
  </div>
</div>
		
			
		
<?php 
$totalAmount=0;
$counter=1;
foreach($data as $datum)
{
	$totalAmount += (float)$datum->porder_product_paid_amount;
?>
			




<div class="row-fluid">
	<div class="span6">
	<p>
		Item Number:  <?=$counter++?>
	</p>
	<p>
		&nbsp;
	</p>
	</div>
	<div class="span6">
	<p>
		&nbsp;	
	</p>
	<p>
		&nbsp;
	</p>
  </div>
</div>


<div class="row-fluid">
	<div class="span6">
	<p>
		 Item Name: <?=$datum->porder_product_name?>
	</p>
	<p>
		&nbsp;
	</p>
	</div>
	<div class="span6">
	<p>
		&nbsp;
	</p>
	<p>
		&nbsp;
	</p>
  </div>
</div>



<div class="row-fluid">
	<div class="span6">
	<p>
		 Item QTY: <?=$datum->porder_product_qty?>
	</p>
	<p>
		&nbsp;
	</p>
	</div>
	<div class="span6">
	<p>
		&nbsp;
	</p>
	<p>
		&nbsp;
	</p>
  </div>
</div>


<div class="row-fluid">
	<div class="span6">
	<p>
		 Item Price:  $ <?=$datum->porder_product_price?>
	</p>
	<p>
		&nbsp;
	</p>
	</div>
	<div class="span6">
	<p>
		$ <?=$datum->porder_product_paid_amount?>
	</p>
	<p>
		&nbsp;
	</p>
  </div>
</div>
<div class="page-header" style="margin:-30px 0;"></div>



<?php } ?>
	

<div class="row-fluid">
	<div class="span6">
	<h3>Total Paid Amount</h3>
	<p>
		&nbsp;
	</p>
	</div>
	<div class="span6">
	<h3>$ <?=$totalAmount?></h3>
	<p>
		&nbsp;
	</p>
  </div>
</div>

<div class="page-header" style="margin:-30px 0;"></div>
	
	
	
<div class="row-fluid">
	<div class="span6">	
		<p>
			<a href="index.php?model=invoice">
			<button type="button" class="btn btn-primary">Back</button>
			</a> 
			<a href="index.php?model=invoice"><button type="button" class="btn">Cancel</button>
			</a> 
		</p>
	</div>
	
	<div class="span6">	
		<p>
	<form name="download_invoice" action="<?=SITE_PATH?>/download.php" method="post">
			<input type="hidden" name="downloadType" value="INVOICE" />
			<input type="hidden" name="pi_invoice_file" value="<?=$datum->pi_invoice_file?>" />
					
			<a href="#">
				<button alt="Not Working" title="Not Working" type="button" class="btn btn-success">Email Invoice</button>
			</a> 
			
				<button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Download Invoice" alt="Download Invoice" title="Download Invoice">
					Download Invoice
				</button>
			</form> 
			
			
			
		</p>
	</div>
</div>

	

			  
        
      </div>
    </div>
  </div>
</div>


