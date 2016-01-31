<div class="row-fluid show-grid">
<div class="news">
	  <div class="topLinks">
	  <a class="fLft" href="#">← Treadmill Sprint 32mph with heavy incline</a>
	  <a href="#" class="fRgt">3 Slideboard Tips →</a></div>

<!--START Post Grid ////////////////////////////-->	  
<?php foreach($DATANews as $datum) { ?>
<div class="post">
	  <div class="heading">
		<a href="#" class="post_title" id="_<?=$datum->id?>" data="show">
		<!--show_whole_post / hide_whole_post-->
			<?=$datum->post_title?>
		</a>
	  </div>
	  <div class="timeStamp">
	  <div class="date"><?=date("M d",strtotime($datum->post_date))?></div>
	  <div class="postedBy">
	  <label>Posted By:</label>
	  <a href="#">
	  <?=$datum->post_add_by?>
	  </a>
	  &nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="#">
		<span id="commentCounter_<?=$datum->id?>"><?=$datum->TOTAL_COMMENTS?></span> Coments
	  </a>
	  
	  
	  </div>
	  </div>
<div class="newsInfo">
	<p>
		
		<div class="post_desc_part1" id="remain_part1_<?=$datum->id?>">
			<?=substr($datum->post_desc,0,100)?>

		</div>
		<div class="post_desc_part2 hide" id="remain_part2_<?=$datum->id?>">
			<?=$datum->post_desc?>
		</div>

		
	</p>
</div>
	   
	   
		<div class="smIcons">   
			<label>Share this:</label>
			<a href="#" onclick="
			window.open(
			'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
			'facebook-share-dialog', 
			'width=626,height=436',
			'href=http://125.63.74.122/prscn/admin/media/img/default_avatar.jpg'); 
			return false;">
			<img src="<?=IMAGES?>fbIcon.png" alt="">
			</a>


			<a href="https://twitter.com/share" class="twitter-share-button" data-size="large">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


			<a href="https://twitter.com/share" class="Xtwitter-share-button" data-size="large" >
			<img src="<?=IMAGES?>TwitterIcon.png" alt="">
			</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!--- google + --->

<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-annotation="none"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!-- Google + --->		
		</div>
	<!--	<div class=" likeUs"><label>Like this:</label>
		<img src="<?=IMAGES?>facebook.jpg" alt=""></div>
	-->	
	
	
	
	
<div class="commentForm hide" id="commentForm_<?=$datum->id?>"> 
	<form action="index.php" method="post" id="formComment_<?=$datum->id?>">
		<input type="hidden" name="comment_post_id" value="<?=$datum->id?>" />
		<div class="row">&nbsp;</div>
		<div class="row">Leave A Comment</div>
		<div class="row">&nbsp;</div>
		<div class="row"><label>Name:</label>
			<input id="comment_name_<?=$datum->id?>" name="comment_name" type="text">
		</div>
		<div class="row"><label>Email:</label>
			<input id="comment_email_<?=$datum->id?>" name="comment_email" type="text">
		</div>
		<div class="row"><label>Contact:</label>
			<input id="comment_contact_<?=$datum->id?>" name="comment_contact" type="text">
		</div>
		<div class="row"><label>Description:</label>
			<textarea id="comment_desc_<?=$datum->id?>" name="comment_desc">
			</textarea>
		</div>
		
		<div class="row">
			<a href="#" id="<?=$datum->id?>" data="_<?=$datum->id?>" class="post_comment">
				<button class="readmore">Submit</button>
			</a>
		</div>
		
		<!-- Comment posting success and error msg -->
		<div class="row hide commentMessage" id="commentErrorMsg_<?=$datum->id?>">
			<br />
			<span style="color:#F90000;">Error To Post Comment Please Try Later</span>
		</div>
		<div class="row hide commentMessage" id="commentSuccessMsg_<?=$datum->id?>">
			<br />	
			<span style="color:#123456;">Your Comment Has been posted Successfully &nbsp;&nbsp;&nbsp; Waiting for Admin Approval..</span>
		</div>
		<!-- END Comment posting success and error msg -->
		
	</form>
</div>	

<div style="border-bottom:5px solid #333;">&nbsp;</div>

</div>

 <?php }  ?>
<!--END Post Grid ////////////////////////////-->	 
</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$("div.post div.heading a.post_title").click(function(ept){
			ept.preventDefault();
			current = $(this);
			currentID=$(current).attr("id");
			currentStatus=$(current).attr("data");
			
			if(currentStatus=="show")
			{
				$("#remain_part1"+currentID).hide();
				$("#remain_part2"+currentID).show();
				$("#commentForm"+currentID).show();
				
				$(current).attr("data","hide");
			}
			else if(currentStatus=="hide") 
			{
				$("#remain_part1"+currentID).show();
				$("#remain_part2"+currentID).hide();
				$("#commentForm"+currentID).hide();
				$(current).attr("data","show");
			}
			$(".commentMessage").hide();
		});

<!-- Store comment -->

$(".post_comment").click(function(epc){
	epc.preventDefault();
	current = $(this);
	currentID=$(current).attr("id");
	currentUndID=$(current).attr("data");
	formData=$("#formComment"+currentUndID).serialize();
	decodedformData=decodeURI(formData);
$.ajax({
	type	: "GET",
	async   : "false",
	url		: "ajax/ajax.php",
	data    : "ajaxcall=true&mod=postComment&"+decodedformData,
	success	: function(response)  {
			
			try
			{
				JSONObject=$.parseJSON(response);
				if(JSONObject.status=="OK")
				{
					$("#commentSuccessMsg"+currentUndID).show();
					$("#commentErrorMsg"+currentUndID).hide();
					
					$("#commentCounter"+currentUndID).html(parseInt($("#commentCounter"+currentUndID).html()) + 1);
					
				}
				else
				{
					$("#commentSuccessMsg"+currentUndID).hide();
					$("#commentErrorMsg"+currentUndID).show();
					console.log("ERROR: ");
				}
			}
			catch(e) 
			{
				$("#commentSuccessMsg"+currentUndID).hide();
				$("#commentErrorMsg"+currentUndID).show();
				console.log("PARSE ERROR: ");
			}
			
			$("#formComment"+currentUndID)[0].reset();
		}
	});
<!-- END store comment -->
	});	
	});
</script>