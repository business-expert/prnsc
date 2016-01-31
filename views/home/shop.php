<script src="<?=SIMPLECART_PATH?>inc/qunit.js"></script>
<script src="<?=SIMPLECART_PATH?>inject.js"></script>
<script src="<?=SIMPLECART_PATH?>simpleCart.js"></script>
<style type="text/css">
.common_font
{
color: #FFFFFF;
    font-size: 12px;
    line-height: normal;
    margin: 10px 0;
}	

#productModal
{
	color:#333333;
}
.model_lebel
{
	color:#333333;
	font-size: 15px;
    font-weight: bolder;
}
.model_desc
{
	color:#333333;
}
.errorMessage
{
	color:#CC0099;
}
.successMessage
{
	color:#3366FF;
}
.center
{
	text-align:center;
}
.disp_block
{
	display:block;
}

.cart_button
{
	background: none repeat scroll 0 0 #A6372B;
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    font-size: 11px;
    padding: 5px 6px;
}	

.clrboth
{
	clear:both;
}

.fright
{
	float:right;
}
.fleft
{
	float:left;
}
.operand1,.operand2,.operator,.captchaLabel
		{
			 vertical-align: middle;
			 text-align:center;
			 padding: 4px 6px;
		}
		
		.operand1,.operand2
		{
			width:30px;
		}
		.operator
		{
			width:8px;
		}
		.captchaResult
		{
			width:50px;
		}
		.captchaLabel
		{
			color:#123456;
		}
		.captchaContainer
		{
			border-radius: 4px 4px 4px 4px;
			padding: 20px 20px 10px 10px;
			border:1px solid #123456;
		}
		.dowbloadButton_container
		{
			padding: 20px 20px 10px 10px;
		}
		
		.errorBorder
		{
			border-color:#FF0000;
		}
		.itemContainer{
			width:100%;
			float:left;
		}
		.itemContainer div{
			float:left;
			margin: 5px 20px 5px 20px ;
		}
		.itemContainer a{
			text-decoration:none;
		}
		.cartHeaders{
			width:100%;
			float:left;
		}
		.cartHeaders div{
			float:left;
			margin: 5px 20px 5px 20px ;
		}
</style>


<div id="shop_contents" class="<?=(isset($_SESSION["payment_status"])) ? "hide" : "show" ?>">
<div class="heading">Shop</div>
<p>Live fee broadcast will begin at 7:45pm Pacific Standard Time. Please check to make sure the volume is up on your player. If the feed stops, click the refresh button. Enjoy, and don’t forget to make your picks!</p>
<?php $counter=0; $ctrl=1; foreach($DATAproduct as $datum) { ?>
	<?php if($counter % 2 == 0) { ?>
	<div class="row-fluid show-grid">
	<?php } ?>	
	<div class="span6">
		<div class="product"><img alt="" src="<?=FILE_VIEW_PATH?>/<?=$datum->product_image?>" />
		<div class="heading">
		<?=$datum->product_name?>

		<span style="font-size:11px;color:#666666;font-family:Helvetica,Arial,sans-serif;">( $<?=$datum->product_price?> )</span>
		</div>
		<p><?=$datum->product_desc?>.. </p>
		
		<?php if($datum->product_type=="SHIPABLE") { ?>
		<a href="#" class="readmore productDetail" data="<?=$datum->pID?>">
			Read More
		</a>
		
		<a href="javascript:;" onclick="simpleCart.add({pid:'<?=$datum->pID?>', name:'<?=$datum->product_name?>', price: <?=$datum->product_price?>,size:'<?=$datum->product_size?>',thumb:'<?=FILE_VIEW_PATH?>/<?=$datum->product_image?>'});" data="<?=$datum->pID?>" class="readmore">
			Add To Cart
		</a>
		<?php } else if($datum->product_type=="DIGITAL") { ?>
		
		<a href="#" class="readmore productDownload" data="<?=$datum->pID?>">
			Download
		</a>
		<?php } ?>
		
		
		</div>
	</div>
	<?php if($ctrl == 2) {  $ctrl=0; ?>
	</div>
	<?php } ?>
	
<?php $counter=$counter+1; $ctrl=$ctrl+1; } ?>

<?php if(($counter % 2) > 0 ) { echo  "</div>"; } ?>





<div class="row-fluid show-grid">
              <div class="cartContainer">
              <div class="cartTop">
			  
			  <!-- Items quantity and price details -->
				  <span>
					Cart: <span class="simpleCart_total"> </span> 
		(<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)
				  </span>
				  
				  <a href="javascript:;" class="simpleCart_empty fright">
					<button>empty cart</button> 
				  </a>
			  <!-- Items quantity and price details -->
			  
			  
			  </div>
			  
			  <div style="clear:both;"></div>
			  <div class="productSec">
             <div class="simpleCart_items row-fluid show-grid" ></div>
			  </div>
			  
<div class="productSec productSec1">
  <div class="fLft">
  <div class="heading">Grand Total</div>
  <div class="row">
	<label>SubTotal: </label>
	<span id="simpleCart_total" class="simpleCart_total"></span>
  </div>
  <div class="row">
	<label>Tax Rate: </label>
	<span id="simpleCart_taxRate" class="simpleCart_taxRate"></span>
	</div>
  <div class="row">
	<label>Tax: </label>
	<span id="simpleCart_tax" class="simpleCart_tax"></span>
	</div>
  <div class="row">
	<label>Shipping: </label>
	<span id="simpleCart_shipping" class="simpleCart_shipping"></span>
  </div>
  <div class="row">
	<label>Final Total: </label>
	<span id="simpleCart_grandTotal" class="simpleCart_grandTotal"></span>
  </div>
  
  </div>
  
  <div class="row" style="margin:10px 0 0 0; padding:10px 0 0 0;">
  <a href="javascript:;" class="simpleCart_checkout">
	<button class="readmore">Checkout</button>
  </a>
  </div>
</div>
              </div>
              </div>






	
<!--START Shopping cart Functionality -->
<!--
<div class="common_font">
<p>
	Cart: <span class="simpleCart_total"> </span> 
	(<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)
	<br />
	<a href="javascript:;" class="simpleCart_empty">empty cart</a>
	<br />
</p>




</div>	
-->
<!--END Shopping cart Functionality -->




<!-- START Product [SHIPABLE] Details Pop up-->
<div id="productModal" class="modal hide fade">
    <div class="modal-header">
        <h3>Product Details</h3>
    </div>
	
    <div class="modal-body">
		<input type="hidden" name="product_id" id="product_id"/>
		<input type="hidden" name="product_inventory_remain_total_products" id="product_inventory_remain_total_products"/>
		<p class="center"><img src="" id="product_image" class="img200"/></p>
		<p>
			<span class="model_lebel">Product Name:</span> 
			<span class="model_desc" id="product_name"></span>
		</p>
		<p>
			<span class="model_lebel">Product Price:</span> 
			<span class="model_desc" id="product_price"></span>
		</p>
		
		<p>
			<span class="model_lebel">Product Size:</span> 
			<span class="model_desc" id="product_size"></span>
		</p>
		
		<p>
			<span class="model_lebel">Product Colour:</span> 
			<span class="model_desc" id="product_color" style="display:block;height:50px;width:50px;">
			
			</span>
		</p>
		
		<p>
			<span class="model_lebel">Product Variations:</span> 
			<span class="model_desc" id="product_variations"></span>
		</p>
		
		<p>
			<span class="model_lebel">Product Description:</span> 
			<span class="model_desc disp_block" id="product_desc"></span>
		</p>		
		<p>
		<span class="errorMessage"></span>
		<span class="successMessage"></span>
		</p>
		<p>
			<div class="fleft">
			<a href="javascript:;" class="readmore popupCartButton">
				Add To Cart
			</a>	
				<!--<button class="cart_button" name="add_to_cart" type="button" id="add_to_cart" value="Add To Cart">Add To Cart</button> -->
			</div>
			<div class="fright">
			
			<a href="javascript:;" class="simpleCart_checkout">
				<button class="readmore">Checkout</button>
			</a>
			
				<!--<button class="cart_button" name="add_to_cart" type="button" id="add_to_cart" value="Checkout">Checkout</button> -->
			</div>
			<div class="clrboth"></div>
		</p>
	
	
		
     </div>
    <div class="modal-footer">			
      <a data-dismiss="modal" class="btn" onclick="javascript:hideModelShop();">
		<button class="close" type="button" id="reedom"  onclick="javascript:hideModelShop();">×</button>
	</a> 	
    </div>
</div>
<!-- END Product [SHIPABLE] Details Pop up-->





<!-- START Product [DIGITAL] Details Pop up and Download-->
<div id="downloadModal" class="modal hide fade">
    <div class="modal-header">
        <h3>Download Product</h3>
    </div>
	
    <div class="modal-body">
		<input type="hidden" name="product_id" id="product_id"/>
		<p class="center"><img src="" id="dproduct_image" class="img200"/></p>
		<p>
			<span class="model_lebel">Product Name:</span> 
			<span class="model_desc" id="dproduct_name"></span>
		</p>
		
		<!-- 
		<p>
			<span class="model_lebel">Product Price:</span> 
			<span class="model_desc" id="dproduct_price"></span>
		</p>
		-->
		<!-- 
		<p>
			<span class="model_lebel">Product Size:</span> 
			<span class="model_desc" id="dproduct_size"></span>
		</p>
		-->
		<p>
			<span class="model_lebel">Product Colour:</span> 
			<span class="model_desc" id="dproduct_color" style="display:block;height:50px;width:50px;">
			</span>
		</p>
		
		<!-- 
		<p>
			<span class="model_lebel">Product Variations:</span> 
			<span class="model_desc" id="dproduct_variations"></span>
		</p>
		-->
		
		<p>
			<span class="model_lebel">Product Description:</span> 
			<span class="model_desc disp_block" id="dproduct_desc"></span>
		</p>		
		<p>
		<span class="errorMessage"></span>
		<span class="successMessage"></span>
		</p>
		
		<form name="frm_dowloadProduct" id="frm_dowloadProduct" method="post" action="<?=SITE_PATH?>/export.php" target="_blnk">
			<input type="hidden" value="members" name="MODULE" />		
			<input type="hidden" value="csv" name="FILE_TYPE" />
			<input type="hidden" value="12cd495aefca6181e44c8dec88e59366" name="TOKEN" />
			
		</form>
	
		<p>
			<!-- Captcha Start here -->
			<div class="fleft captchaContainer">
				
				<div class="captchaLabel fleft">What is ? </div>
				<div class="operand1 fleft"></div>
				<div class="operator fleft"> + </div>
				<div class="operand2 fleft"></div>
				<input size="20" type="text" class="captchaResult fleft" id="captchaResult" />
				<div class="clrboth"></div>
			</div>
			<!-- Captcha End here -->
			<div class="fright dowbloadButton_container">
				<button class="cart_button" name="downloadNow" type="button" id="downloadNow" value="Download">Download</button>
			</div>
			<div class="clrboth"></div>
		</p>
		
		
     </div>
    <div class="modal-footer">
        <a data-dismiss="modal" class="btn"  onclick="javascript:hideModelShop();">
			<button class="close" type="button" id="reedom"  onclick="javascript:hideModelShop();">×</button>
		</a>        
    </div>
</div>
<!-- END Product [DIGITAL] Details Pop up and Download-->






<script>
//Global declaration
var product_id;
$(document).ready(function(){
	//Function start for Digital product
	$('.productDownload').click(function(pdEvent){
		current=$(this);
		$(current).html("<?=PROCESSING_IMAGE_TYPE_TWO?>");
		pdEvent.preventDefault();
		product_id=$(this).attr('data');
		$.ajax({
		type	: "GET",
		url		: "ajax/ajax.php",
		data    : "ajaxcall=true&mod=getProductDetail&id="+product_id,
		success	: function(response)   {
					$(current).html("Download");
					var json = ''+response+'',
				    JSONObject = JSON.parse(json);
					if(JSONObject.status=="OK")
					{
						$("#dproduct_image").attr('src','<?=FILE_VIEW_PATH?>/'+JSONObject.product_image);
						$("#dproduct_name").html(JSONObject.product_name);	
						$("#dproduct_price").html(JSONObject.product_price);
						$("#dproduct_variations").html(JSONObject.product_variations);
						$("#dproduct_size").html(JSONObject.product_size);							
						$("#dproduct_color").css("background-color","#"+JSONObject.product_color);
						$("#dproduct_desc").html(JSONObject.product_desc);	
						$("#dproduct_id").html(JSONObject.id);	
						window.operand1=Math.floor((Math.random()*100)+1);
						window.operand2=Math.floor((Math.random()*100)+1);
						window.captchaResult=window.operand1+window.operand2;
						
						$("#dproduct_inventory_remain_total_products").val(JSONObject.product_inventory_remain_total_products);	
						
						$(".operand1").html(window.operand1);	
						$(".operand2").html(window.operand2);
						console.log(window.captchaResult+" "+window.operand1+" "+window.operand2);
						//window.captchaResult = window.operand1 + window.operand2;
						
						$('#downloadModal').removeClass('hide').addClass('in');
						//$('.successMessage').html(JSONObject.msg).show();
					}					
					else
					{
						//$('.errorMessage').html(JSONObject.msg).show();
					}					
				  }
	   });	
		
	});
	//Function end for Digital product
	
	$("#downloadNow").click(function(dnEvent){
		dnEvent.preventDefault();
		if($(".captchaResult").val()==window.captchaResult)
		{
			alert("downloaded");
		}
		else
		{
			$(".captchaResult").css('color','#FF0000').val('Wrong !');
		}
	});

//Function start shopping
$('.productDetail').click(function(pdEvent){
		current=$(this);
		$(current).html("<?=PROCESSING_IMAGE_TYPE_TWO?>");
		
		pdEvent.preventDefault();
		product_id=$(this).attr('data');
		$.ajax({
		type	: "GET",
		url		: "ajax/ajax.php",
		data    : "ajaxcall=true&mod=getProductDetail&id="+product_id,
		success	: function(response)   {
					$(current).html("Readmore");
					var json = ''+response+'',
				    JSONObject = JSON.parse(json);
					if(JSONObject.status=="OK")
					{
						$("#product_image").attr('src','<?=FILE_VIEW_PATH?>/'+JSONObject.product_image);
						$("#product_name").html(JSONObject.product_name);	
						$("#product_price").html(JSONObject.product_price);
						$("#product_variations").html(JSONObject.product_variations);
						$("#product_size").html(JSONObject.product_size);		
						$("#product_color").css("background-color","#"+JSONObject.product_color);	
						$("#product_desc").html(JSONObject.product_desc);	
						$("#product_id").html(JSONObject.id);							
						$("#product_inventory_remain_total_products").val(JSONObject.product_inventory_remain_total_products);	
						//var onClickVal = "simpleCart.add(";
						$(".popupCartButton").removeAttr("onclick"); //pid:'"+product_id+"', 
						var onClickVal = "simpleCart.add({pid:'"+product_id+"', name:'"+JSONObject.product_name+"', price:'"+JSONObject.product_price+"', size:'"+JSONObject.product_size+"', thumb: '<?=FILE_VIEW_PATH?>/"+JSONObject.product_image+"'})"; //"+encodeURI(<?=FILE_VIEW_PATH?>+"/"+JSONObject.product_image)+"
						$(".popupCartButton").attr("onclick",onClickVal) ;
						//$(".pDAToCart_"+product_id).attr("data",onClickVal) ;
						//alert(onClickVal);
						$('#productModal').addClass('fade').removeClass('hide');
						$('#productModal').addClass('fade').addClass('in');
						$('#successMessage').html(JSONObject.msg).show();
					}					
					else
					{
						$('#errorMessage').html(JSONObject.msg).show();
					}					
				  }
	   });	
	//Function start shopping   
	   
});
});
function hideModelShop()
{
	$('#productModal,#downloadModal').addClass('hide').removeClass('in');
	$(".captchaResult").css('color','').val('');
	$('.successMessage,.errorMessage').html('').hide();
}
</script>


<!-- START function to find Cart data's attribute -->
<script>
var items = [];
	$(document).ready(function(){	
		$("#CurrentCartItems").click(function(e){
			e.preventDefault();
			alert(simpleCart.items().length);
			/*simpleCart.each(function( item , x ){
				items = {item_pid:item.get('pid'),item_name:item.get('name'),item_quantity:item.quantity(),item_currency:simpleCart.currency().code,item_price:item.price(),item_total:item.total()};
				console.log(items);
			});*/
			
		
		});
	});
</script>
<!-- END function to find Cart data's attribute -->
</div>

<!-- <a href="#" id="CurrentCartItems"> IS CART HAS ITEM </a> -->

<div id="shipping_success_contents" class="row-fluid show-grid <?=(isset($_SESSION["payment_status"]) && $_SESSION["payment_status"]=="success") ? "show" : "hide" ?>">
<div class="heading">Shipping Detail</div>
<p>
	<span style="color:#FFFFFF;font-size:18px;font-weight:bolder;">
	Purchase Completed successfully
	</span>
</p>
	
<?php if(isset($_SESSION["payment_status"]) && $_SESSION["payment_status"]=="success") { ?>
	<!--<div class="row-fluid show-grid"> -->
		<div class="heading">Invoice Detail of Your Order</div>
		<div class="" id="miniCart">
		<div class="small head wrap">Descriptions<span class="amount">Amount</span></div><ol class="small wrap items limit-a"><li class="seller1"><ul><li class="itmdet" id="multiitem1">
		<?php
			$pi_id=$_SESSION["porder_pi_id"];
			$SQL="SELECT * FROM product_invoice LEFT JOIN product_order ON product_invoice.pi_id=product_order.porder_pi_id WHERE product_invoice.pi_id='".$pi_id."'";
			$data=$DB->fetchAll($SQL,"");
			$totalAmount=0;
			$counter=1;
		?>
		<?php foreach($data as $datum) {  $totalAmount += (float)$datum->porder_product_paid_amount;	?>
		<ul class="item1">
		<li class="dark">
		<span class="name">
		<a id="showname0" title="" href="#name0" class="autoTooltip">
		<?=$datum->porder_product_name?><span class="accessAid">&nbsp;</span></a>
		</span><span class="amount">$<?=(float)$datum->porder_product_paid_amount?></span></li>
		<li class="secondary">
		Item number: <?=$counter++?></li><li class="secondary">
		<span>Item price: $<?=(float)$datum->porder_product_price?></span></li>	
		<li class="secondary">Quantity: <?=$datum->porder_product_qty?></li>
		</ul>
		<?php } ?>


		</li></ul>
		<div style="float:left; width:100%;"><div class="wrap items totals item1"><ul><li class="small heavy">Item total <span class="amount">$<?=(float)$totalAmount?></span></li></ul></div><div class="small wrap items totals item1"><ul><li class="heavy highlight finalTotal"><span class="grandTotal amount highlight">Total $<?=(float)$totalAmount?> USD</span></li></ul></div></div>
		</li></ol>
		<div><div></div><div></div></div>
		</div>
		
		<div align="right" class="btmBtn">
			<div style="float:right;">
			<button onclick="javascript:top.location.href='<?=SITE_PATH?>'" class="readmore" type="button" name="Print Invoice" value="Print Invoice">
					Continue
			</button>
			</div>
			<div style="width:10px;float:right;">&nbsp;</div>
			<div style="float:right;">
			
			<form name="downloadInvoiceForm" id="downloadInvoiceForm" action="<?=SITE_PATH?>/download.php" method="post">
				<input type="hidden" name="downloadType" value="INVOICE" />
				<input type="hidden" name="pi_invoice_file" value="<?=$data[0]->pi_invoice_file?>" />	
				
				<button class="readmore" type="submit" name="Download Invoice" value="Download Invoice">
					Download Invoice
				</button>
				<!-- <a class="downloadInvoice readmore" href="#">Download Invoice</a> -->
			</form>
			</div>
			
		</div>
		
	<!-- </div> -->
	
	
	
<?php } ?>
	
</div>


<div id="shipping_failed_contents" class="row-fluid show-grid <?=(isset($_SESSION["payment_status"]) && $_SESSION["payment_status"]=="failed") ? "show" : "hide" ?>">
<div class="heading">Shipping Detail</div>
<p>
	<span style="color:#FFFFFF;font-size:18px;font-weight:bolder;">
	Payment Error, purchase process does not completed
	</span>
</p>
<?php if(isset($_SESSION["payment_status"]) && $_SESSION["payment_status"]=="failed") { ?>	

	<!--<div class="row-fluid show-grid"> -->
		<div class="heading">Invoice Detail of Your Order</div>
		<div class="" id="miniCart">
		<div class="small head wrap">Descriptions<span class="amount">Amount</span></div><ol class="small wrap items limit-a"><li class="seller1"><ul><li class="itmdet" id="multiitem1">
		<?php
			$pi_id=1;//$_SESSION["porder_pi_id"];	
			$SQL="SELECT * FROM product_invoice LEFT JOIN product_order ON product_invoice.pi_id=product_order.porder_pi_id WHERE product_invoice.pi_id='".$pi_id."'";
			$data=$DB->fetchAll($SQL,"");
			$totalAmount=0;
			$counter=1;
		?>
		<?php foreach($data as $datum) {  $totalAmount += (float)$datum->porder_product_paid_amount;	?>
		<ul class="item1">
		<li class="dark">
		<span class="name">
		<a id="showname0" title="" href="#name0" class="autoTooltip">
		<?=$datum->porder_product_name?><span class="accessAid">&nbsp;</span></a>
		</span><span class="amount">$<?=(float)$datum->porder_product_paid_amount?></span></li>
		<li class="secondary">
		Item number: <?=$counter++?></li><li class="secondary">
		<span>Item price: $<?=(float)$datum->porder_product_price?></span></li>	
		<li class="secondary">Quantity: <?=$datum->porder_product_qty?></li>
		</ul>
		<?php } ?>


		</li></ul>
		<div style="float:left; width:100%;"><div class="wrap items totals item1"><ul><li class="small heavy">Item total <span class="amount">$<?=(float)$totalAmount?></span></li></ul></div><div class="small wrap items totals item1"><ul><li class="heavy highlight finalTotal"><span class="grandTotal amount highlight">Total $<?=(float)$totalAmount?> USD</span></li></ul></div></div>
		</li></ol>
		<div><div></div><div></div></div>
		</div>
		
		<div align="right" class="btmBtn">
			<a href="<?=SITE_PATH?>"  class="readmore">
				Continue
			</a>
		</div>
		
	<!-- </div> -->

	<?php } ?>
</div>

<?php 
	#reset paymenet session
	unset($_SESSION["payment_status"]);
?>




