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


<p>Live fee broadcast will begin at 7:45pm Pacific Standard Time. Please check to make sure the volume is up on your player. If the feed stops, click the refresh button. Enjoy, and don’t forget to make your picks!</p>
<?php $counter=0; $ctrl=1; foreach($DATAproduct as $datum) { ?>
	<?php if($counter % 2 == 0) { ?>
	<div class="row-fluid show-grid">
	<?php } ?>	
	<div class="span6">
		<div class="product"><img alt="" src="<?=FILE_VIEW_PATH?>/<?=$datum->product_image?>" />
		<div class="heading"><?=$datum->product_name?></div>
		<p><?=$datum->product_desc?>. </p>
		
		<?php if($datum->product_type=="SHIPABLE") { ?>
		<a href="#" class="readmore productDetail" data="<?=$datum->id?>">
			Read More
		</a>
		
		<a href="javascript:;" onclick="simpleCart.add({name:'<?=$datum->product_name?>', price: <?=$datum->product_price?>,size:'<?=$datum->product_size?>',thumb:'<?=FILE_VIEW_PATH?>/<?=$datum->product_image?>'});" data="<?=$datum->id?>" class="readmore">
			Add To Cart
		</a>
		<?php } else if($datum->product_type=="DIGITAL") { ?>
		
		<a href="#" class="readmore productDownload" data="<?=$datum->id?>">
			Download
		</a>
		<?php } ?>
		
		
		</div>
	</div>
	<?php if($ctrl == 2) {  $ctrl=1; ?>
	</div>
	<?php } ?>
	
<?php $counter=$counter+1; $ctrl=$ctrl+1; } ?>







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
              <div class="productSec">
              <div class="fLft">
              <div class="row">
                <label>Product Name: </label><span>water</span></div>
              <div class="row">
                <label>Price: </label><span>$10</span></div>
              <div class="row">
                <label>Qty: </label><span>02</span></div>
              <div class="row">
                <label>Total: </label><span>$20</span></div>
              </div>
              <div class="fRgt">
              <div class="plusMinus">
              <span><a href="#">+</a></span>
              <span>2</span>
              <span><a href="#">-</a></span>
              </div>
              </div>
              <div class="row" style="margin:10px 0 0 0; padding:10px 0 0 0;">
              <button class="readmore">Remove this order</button>
              </div>
              </div>
              <div class="productSec">
              <div class="fLft">
              <div class="row">
                <label>Product Name: </label><span>water</span></div>
              <div class="row">
                <label>Price: </label><span>$10</span></div>
              <div class="row">
                <label>Qty: </label><span>02</span></div>
              <div class="row">
                <label>Total: </label><span>$20</span></div>
              </div>
              <div class="fRgt">
              <div class="plusMinus">
              <span><a href="#">+</a></span>
              <span>2</span>
              <span><a href="#">-</a></span>
              </div>
              </div>
              <div class="row" style="margin:10px 0 0 0; padding:10px 0 0 0;">
              <button class="readmore">Remove this order</button>
              </div>
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
<div class="common_font">
<p>
	Cart: <span class="simpleCart_total"> </span> 
	(<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)
	<br />
	<a href="javascript:;" class="simpleCart_empty">empty cart</a>
	<br />
</p>


<div class="simpleCart_items" ></div>



<br />
	SubTotal: <span id="simpleCart_total" class="simpleCart_total"></span> <br />
	Tax Rate: <span id="simpleCart_taxRate" class="simpleCart_taxRate"></span> <br />
	Tax: <span id="simpleCart_tax" class="simpleCart_tax"></span> <br />
	Shipping: <span id="simpleCart_shipping" class="simpleCart_shipping"></span> <br />
	-----------------------------<br />
	Final Total: <span id="simpleCart_grandTotal" class="simpleCart_grandTotal"></span> <br />

	<a href="javascript:;" class="simpleCart_checkout">checkout</a>	
	
	<div id="test_id"></div>
</div>	
<!--END Shopping cart Functionality -->






<!-- START Product Details Pop up-->

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
			<span class="model_desc" id="product_color"></span>
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
				<button class="cart_button" name="add_to_cart" type="button" id="add_to_cart" value="Add To Cart">Add To Cart</button>
			</div>
			<div class="fright">
				<button class="cart_button" name="add_to_cart" type="button" id="add_to_cart" value="Checkout">Checkout</button>
			</div>
			<div class="clrboth"></div>
		</p>
	
	
		
     </div>
    <div class="modal-footer">
	
		
      <a data-dismiss="modal" class="btn">
		<button class="close" type="button" id="reedom"  onclick="javascript:hideModel();">×</button>
	</a> 

		
    </div>
</div>
<!-- END Product Details Pop up-->





<!--START download model -->
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
		<p>
			<span class="model_lebel">Product Price:</span> 
			<span class="model_desc" id="dproduct_price"></span>
		</p>
		
		<p>
			<span class="model_lebel">Product Size:</span> 
			<span class="model_desc" id="dproduct_size"></span>
		</p>
		
		<p>
			<span class="model_lebel">Product Colour:</span> 
			<span class="model_desc" id="dproduct_color"></span>
		</p>
		
		<p>
			<span class="model_lebel">Product Variations:</span> 
			<span class="model_desc" id="dproduct_variations"></span>
		</p>
		
		<p>
			<span class="model_lebel">Product Description:</span> 
			<span class="model_desc disp_block" id="dproduct_desc"></span>
		</p>		
		<p>
		<span class="errorMessage"></span>
		<span class="successMessage"></span>
		</p>
		
		
		<style type="text/css">
		
		</style>
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
        <a data-dismiss="modal" class="btn">
			<button class="close" type="button" id="reedom"  onclick="javascript:hideModel();">×</button>
		</a>        
    </div>
</div>
<!--END download model -->



<script>
//Global declaration
var product_id;
$(document).ready(function(){
	//Function start for Digital product
	$('.productDownload').click(function(pdEvent){
		pdEvent.preventDefault();
		product_id=$(this).attr('data');
		$.ajax({
		type	: "GET",
		url		: "ajax/ajax.php",
		data    : "ajaxcall=true&mod=getProductDetail&id="+product_id,
		success	: function(response)   {
					var json = ''+response+'',
				    JSONObject = JSON.parse(json);
					if(JSONObject.status=="OK")
					{
						$("#dproduct_image").attr('src','<?=FILE_VIEW_PATH?>/'+JSONObject.product_image);
						$("#dproduct_name").html(JSONObject.product_name);	
						$("#dproduct_price").html(JSONObject.product_price);
						$("#dproduct_variations").html(JSONObject.product_variations);
						$("#dproduct_size").html(JSONObject.product_size);		
						$("#dproduct_color").html(JSONObject.product_color);	
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
						$('.successMessage').html(JSONObject.msg).show();
					}					
					else
					{
						$('.errorMessage').html(JSONObject.msg).show();
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
		pdEvent.preventDefault();
		product_id=$(this).attr('data');
		$.ajax({
		type	: "GET",
		url		: "ajax/ajax.php",
		data    : "ajaxcall=true&mod=getProductDetail&id="+product_id,
		success	: function(response)   {
					var json = ''+response+'',
				    JSONObject = JSON.parse(json);
					if(JSONObject.status=="OK")
					{
						$("#product_image").attr('src','<?=FILE_VIEW_PATH?>/'+JSONObject.product_image);
						$("#product_name").html(JSONObject.product_name);	
						$("#product_price").html(JSONObject.product_price);
						$("#product_variations").html(JSONObject.product_variations);
						$("#product_size").html(JSONObject.product_size);		
						$("#product_color").val(JSONObject.product_color);	
						$("#product_desc").html(JSONObject.product_desc);	
						$("#product_id").html(JSONObject.id);							
						$("#product_inventory_remain_total_products").val(JSONObject.product_inventory_remain_total_products);	
						
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
function hideModel()
{
	$('#productModal,#downloadModal').addClass('hide').removeClass('in');
	$(".captchaResult").css('color','').val('');
	$('.successMessage,.errorMessage').html('').hide();
}
</script>

<script src="<?=SIMPLECART_PATH?>inc/qunit.js"></script>
<script src="<?=SIMPLECART_PATH?>inject.js"></script>
<script src="<?=SIMPLECART_PATH?>simpleCart.js"></script>





