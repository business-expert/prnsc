<style type="text/css">
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
.model_desc p
{
	color:#333333;
}

.commonLebel
{
	color:#333333;
	font-size: 15px;
    font-weight: bolder;
}
</style>
<!-- START Tab for  Account Management -->
<ul class="navMeter" id="srActToTabs">
  <li>
	<a id="accountMenu_at1" data="" href="#at1" class="selected">
		Dashboard
	</a>
  </li>
  <li>
	<a id="accountMenu_at2" data="" href="#at2">
		Account
	</a>
  </li>
  <li>
	<a id="accountMenu_at3" data="" href="#at3">
		News
	</a>
  </li>
</ul>
      
<div class="navMeter-select" id="srActToSelectTabs">
   <select id="srActToselected">
	<option value="#at1" class="selected">Dashboard</option>		
	<option value="#at2">Account</option>		
	<option value="#at3">News</option>		 
  </select>
</div>
<!-- END Tab for  Account Management -->




<!-- START Content Listing -->
<div>
<div class="commonWhiteBackground">
<div id="srActToTabsContent"> 	
<div id="at1"> 
<div class="commentForm" id="DashboardprofileWrapper"> 
	<form action="index.php" method="post" id="DashboardprofileForm">
		<div class="row">Your Current Profile!</div>
		<div class="row">&nbsp;</div>
		
		<div class="row"><label class="commonLebel">Photo :</label>
			<img src="<?=$athleticProfileDatum->photo_url?>" style="height:50px;width:50px;" />
		</div>
		<div class="row">&nbsp;</div>
		
		<div class="row"><label class="commonLebel">Name :</label>
			<?=$athleticProfileDatum->name?>
		</div>
		<div class="row">&nbsp;</div>
		
		<div class="row"><label class="commonLebel">Email :</label>
			<?=$athleticProfileDatum->athletic_email?>
		</div>
		<div class="row">&nbsp;</div>
		
		<div class="row"><label class="commonLebel">Contact :</label>
			<?=$athleticProfileDatum->contact?>
		</div>
		<div class="row">&nbsp;</div>
		
		<div class="row"><label class="commonLebel">About you :</label>
			
				<?=$athleticProfileDatum->bio?>
		</div>

	</form>
</div>	
<div style="clear:both;"></div>
</div>
	
	
<!--################## START Account Section ##################---->	
<div id="at2">
<div style="float:left;" class="hideOnClickonAnyTab">
	<?=$objComm->getSessionMessage('profileUpdate');?>
</div> 	
<div class="commentForm" id="profileWrapper"> 
	<form action="index.php" method="post" id="profileUpdateForm">
		<input type="hidden" id="model" name="model" value="home" />
		<input type="hidden" id="action" name="action" value="Update_Profile" />
		<div class="row">Update Your Profile!</div>
		<div class="row">&nbsp;</div>
		
		<div class="row"><label>Name :</label>
			<input name="data_name" id="data_name" value="<?=$athleticProfileDatum->name?>" type="text">
		</div>
		
		<div class="row"><label>Email :</label>
			<input name="data_athletic_email" id="data_athletic_email" value="<?=$athleticProfileDatum->athletic_email?>" type="text">
		</div>
		
		
		<div class="row"><label>Contact :</label>
			<input name="data_contact" id="data_contact" value="<?=$athleticProfileDatum->contact?>" type="text">
		</div>
		
		<div class="row"><label>About you :</label>
			<textarea required name="data_bio" class="data_bio" id="data_bio">
				<?=$athleticProfileDatum->bio?>
			</textarea>
		</div>
		<div class="row">&nbsp;</div>
		<div class="row">		
				<button name="btn_updateProfile" type="submit" id="btn_updateProfile" value="Update Profile" class="readmore">Update Profile</button>
		</div>

	</form>
</div>	
<div style="clear:both;"></div>
</div>


<!--################## END Account Section ##################---->

<div id="at3">
<script type="text/javascript" src="<?=MEDIA_ADMIN?>/tinymce/tinymce/tinymce.min.js">
</script>

<script type="text/javascript">
	tinymce.init({
		selector: ".data_post_desc",
		plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
</script>

<style type="text/css">
.newsHandleTable
{
	float:;eft;
}
.clear
{
	clear:both;
}
</style>
<!--
newsHandleTable
--->

<div style="float:left;" class="hideOnClickonAnyTab"><?=$objComm->getSessionMessage('news');?></div>

<div  style="float:right;"> 
	<a href="#" class="addNewNewsButton btn btn-success">
			Add News
	</a>

	<a href="#" class="AllNewNewsButton btn btn-success hide">
			All News
	</a>
</div>
<br style="clear:both;" />
<br />
	
<!--------------------------------------------------------->
<div class="commentForm NewsAddFormWrapper" id="allNewsWrapper"> 
<table class="table table-bordered table-striped table-condensed datatable1 newsHandleTable">
        <thead>
          <tr>
			<th>News #</th>
            <th>Title</th>
            <th>Comments</th>
			<th>Status</th>
            <th nowrap>Action</th>            
          </tr>
        </thead>
        <tbody>
        
		<?php foreach($dataOwnNews as $datum){$view="index.php?model=blog&action=view&id=".$datum->id;$edit="index.php?model=blog&action=edit&id=".$datum->id;?>
				<tr id="<?=$datum->id?>">
				<td class="center"><?=$datum->id?></td>	
				<td class="center"><?=$datum->post_title?></td>
				<td class="center"><?=$datum->TOTAL_COMMENTS?></td>
				<td class="center">
					<span class="label">
						<?=$datum->post_status?>
					</span>
				</td>
				<td class="center" nowrap>
				
				<a class="btn btn-success viewNewsButton" data="<?=$datum->id?>" href="<?=$view?>" alt="View News" title="View News"> <i class="icon-zoom-in icon-white"></i></a> 
				<a class="btn btn-info updateNewsButton" data="<?=$datum->id?>" href="<?=$edit?>" alt="Edit News" title="Edit News"> <i class="icon-edit icon-white"></i></a> 
				<a class="btn btn-danger delete_datum" id="deleted_<?=$datum->id?>" data="post;id;<?=$datum->id?>" href="#" alt="Delete News" title="Delete News"> <i class="icon-trash icon-white"></i></a>
				</td>
				</tr>
		<?php } ?>
        </tbody>
	</table>
	<div style="clear:both;"></div>
</div>	

<!--------------------------------------------------------->


<!--------------------------------------------------------->
<div class="commentForm NewsAddFormWrapper hide" id="addNewsWrapper"> 
	<form action="index.php" method="post" id="NewsAddForm">
		 <input type="hidden" name="data_post_status" id="data_post_status" value="DEACTIVE" />
		 <input type="hidden" name="action" id="action" value="add" />
		 
         <input type="hidden" name="model" id="model" value="home" />
		
		
		<div class="row">Add News Here !</div>
		<div class="row">&nbsp;</div>
		
		<div class="row"><label>News Cateogry :</label>
		<?=$objHTML->postCategoryBasicCombo("data_post_cat_id",$postDatum->post_cat_id,"required")?>
		</div>
		
		<div class="row"><label>News Title :</label>
			<input id="" name="data_post_title" id="data_post_title" value="" type="text">
		</div>
		
		<div class="row"><label>News Description:</label>
			<textarea required name="data_post_desc" class="data_post_desc" id="data_post_desc">
			<strong>How To Add Video Media: </strong>Insert Menu -> Insert Video -> Embed. And Now Paste  <br /> &lt; iframe width="100%" height="345" src="your video URL" &gt; &lt; /iframe &gt;</p>
			<p><br />For EG: &lt; iframe width="100%" height="345" src="http://www.youtube.com/embed/XGSy3_Czz8k" &gt; &lt; /iframe &gt;
			</textarea>
		</div>
		<div class="row">&nbsp;</div>
		<div class="row">		
				<button name="btn_submit" type="submit" value="Save" class="readmore">Save</button>
		</div>

	</form>
</div>	
<!--------------------------------------------------------->
<div style="clear:both;"></div>

		
	</div>
</div>
</div>
<div style="clear:both;"></div>
</div>
<!-- END Content Listing -->






<!-- START News View  Pop up-->
<div id="newsViewModal" class="modal hide fade">
    <div class="modal-header">
        <h3>View News</h3>
    </div>
	
    <div class="modal-body">
		<input type="hidden" name="product_id" id="product_id"/>
		<p>
			<span class="model_lebel">News Title:</span> 
			<span class="model_desc" id="post_title"></span>
		</p>
		<p style="height:auto;width:80%;">
			<span class="model_lebel">News Description:</span> 
			<div class="model_desc" id="post_desc" style="">
			
			</div>
		</p>
		
		<p>
			<span class="model_lebel">News Status:</span> 
			<span class="model_desc" id="post_status"></span>
		</p>
		
		<p>
			<span class="model_lebel">Total Comment:</span> 
			<span class="model_desc" id="TOTAL_COMMENTS">
			
			</span>
		</p>

     </div>
    <div class="modal-footer">			
      <a data-dismiss="modal" class="btn" onclick="javascript:hideNewsModel();">
		<button class="close" type="button" id="reedom"  onclick="javascript:hideNewsModel();">×</button>
	</a> 	
    </div>
</div>
<!-- END News View  Pop up-->


<!-- START News Update Model -->
<div id="newsUpdateModal" class="modal hide fade">
<form action="index.php" method="post" id="NewsUpdateForm">
	<input type="hidden" name="data_post_status" id="data_post_status" value="DEACTIVE" />
	<input type="hidden" name="action" id="action" value="Update" />
	<input type="hidden" id="pk_id" name="pk_id" value="" />
	<input type="hidden" name="model" id="model" value="home" />

    <div class="modal-header">
        <h3>Update News</h3>
    </div>
	
    <div class="modal-body commentForm">		
		<p>
		<div class="row"><label>News Cateogry :</label>
			<?=$objHTML->postCategoryBasicCombo("data_post_cat_id","","required")?>
		</div>
		</p>
		
		<p>
			<div class="row"><label>News Title :</label>
				<input name="data_post_title" id="update_data_post_title" value="" type="text">
			</div>
		</p>
		
		
		<p>
			<div class="row"><label>News Description :</label>
				<textarea required name="data_post_desc" class="data_post_desc" id="update_data_post_desc">
					
				</textarea>
			</div>
		
		</p>
		
		
		<p>
			<div class="row">&nbsp;</div>
			<div class="row">		
				<button name="btn_submit" type="submit" value="Update" class="readmore">Update</button>
			</div>

		</p>
		<p>&nbsp;</p>
		
     </div>
    <div class="modal-footer">			
      <a data-dismiss="modal" class="btn" onclick="javascript:hideNewsModel();">
		<button class="close" type="button" id="reedom"  onclick="javascript:hideNewsModel();">×</button>
	</a> 	
    </div>
</form>	
</div>	
<!-- END News Update Model -->



<script type="text/javascript">
$(document).ready(function(){
$('.viewNewsButton').click(function(evn){
		current=$(this);
		buttonContent=$(current).html();
		$(current).html("<?=PROCESSING_IMAGE_TYPE_ONE?>");
		evn.preventDefault();
		post_id=$(this).attr('data');
		$.ajax({
		type	: "GET",
		url		: "ajax/ajax.php",
		data    : "ajaxcall=true&mod=getNewsDetail&id="+post_id,
		success	: function(response)   {
					$(current).html(buttonContent);
					try
					{
						JSONObject = JSON.parse(response);
						//alert(JSONObject.status);
						if(JSONObject.status=="OK")
						{
							$("#post_title").html(JSONObject.post_title);	
							$("#post_desc").html(JSONObject.post_desc);
							$("#TOTAL_COMMENTS").html(JSONObject.TOTAL_COMMENTS);
							$("#post_status").html(JSONObject.post_status);												
							$('#newsViewModal').addClass('fade').removeClass('hide');
							$('#newsViewModal').addClass('fade').addClass('in');
						}					
						else
						{
							alert("Unable to View This News Please Try Later.");
						}					
					}
					catch(e)
					{
						alert("Unable to View This News Please Try Later.");
					}
				    
					
				  }
	   });	    
});


$('.updateNewsButton').click(function(evn){
		current=$(this);
		buttonContent=$(current).html();
		$(current).html("<?=PROCESSING_IMAGE_TYPE_ONE?>");
		evn.preventDefault();
		post_id=$(this).attr('data');
		$.ajax({
		type	: "GET",
		url		: "ajax/ajax.php",
		data    : "ajaxcall=true&mod=getNewsDetailForUpdate&id="+post_id,
		success	: function(response)   {
					$(current).html(buttonContent);
					try
					{
						JSONObject = JSON.parse(response);
						//alert(JSONObject.status);
						if(JSONObject.status=="OK")
						{
							$("#pk_id").val(post_id);							
							$(".post_category_id").val(JSONObject.post_cat_id);	
							$("#update_data_post_title").val(JSONObject.post_title);	
							$('#update_data_post_desc_ifr').contents().find('body').html(JSONObject.post_desc);					
							$('#newsUpdateModal').addClass('fade').removeClass('hide');
							$('#newsUpdateModal').addClass('fade').addClass('in');
						}					
						else
						{
							alert("Unable to View This News Please Try Later.");
						}					
					}
					catch(e)
					{
						alert("Unable to View This News Please Try Later.");
					}
				    
					
				  }
	   });	 	   
});




});
function hideNewsModel()
{
	$('#newsViewModal, #newsUpdateModal').addClass('hide').removeClass('in');
}

</script>





<script type="text/javascript">
$(function() {
	//# When code run desktop / tablet
	$("#srActToTabs").srActToTabs({
	});
	
	//# When code run on mobile
	$("#srActToSelectTabs").srActToSelectTabs({
	});
});
</script>

<script type="text/javascript">

$(document).ready(function(){
	$(".addNewNewsButton").click(function(eannb){
		eannb.preventDefault();
		current=$(this);
		$(".addNewNewsButton").hide();
		$("#addNewsWrapper").show();
		$(".AllNewNewsButton").show();
		$("#allNewsWrapper").hide();

	});
	
	$(".AllNewNewsButton").click(function(eannb){
		eannb.preventDefault();
		current=$(this);
		$(".addNewNewsButton").show();
		$("#addNewsWrapper").hide();
		
		$(".AllNewNewsButton").hide();
		$("#allNewsWrapper").show();
		
		
	});
});
</script>


<script type="text/javascript" src="<?=JS?>common_func.js"></script>
<script type="text/javascript">
$(function() {
	$(".delete_datum").deleteData({
	dataOnDeleted : function(response){
		var JSONObject = $.parseJSON(response);
	}
	});
});
</script>
