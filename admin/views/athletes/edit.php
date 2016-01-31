<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('athletes');

?>

<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=athletes">Athletes</a> <span class="divider">/</span></li>
    <li><a href="#">Edit Athletes</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Athlete</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
		  <input type="hidden" name="data_facebook_id" id="data_facebook_id" value="" />	
		  <input type="hidden" name="action" id="action" value="edit" />
          <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
          <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="data_name">Name</label>
              <div class="controls">
                <input type="text" required value="<?=$datum->name?>" id="data_name" name="data_name" class="input-xsmall focused">
              </div>
            </div>
           
          
            <div class="control-group">
              <label class="control-label" for="data_facebook_url">Facebook Url</label>
              <div class="controls">
                  <input required type="text" value="<?=$datum->facebook_url?>" id="data_facebook_url" name="data_facebook_url" class="input-xlarge focused">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="data_photo_url">Photo Url</label>
              <div class="controls">
				<?php $image  =  (exif_imagetype($datum->photo_url) == IMAGETYPE_JPEG) ?  $datum->photo_url : DEFAULT_ATHLETES_PROFILE_AVTAR; ?>			 
				<input required type="text" value="<?=$image?>" id="data_photo_url" name="data_photo_url" class="input-xlarge  focused" >&nbsp;&nbsp;<a href="#" class="" data-rel="popover" data-content="<img src='<?=$image?>'>" title="Photo">View Photo</a>
              </div>
            </div>
            
			
			<div class="control-group">
              <label class="control-label" for="data_education_level">Bio</label>
              <div class="controls">
					<textarea maxlength="510" required name="data_bio" id="data_bio">
						<?=$datum->bio?>
					</textarea>
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="data_type">Athlete Type</label>
              <div class="controls">
				  <!-- Remove All from athletic type array -->	
				  <?php  $athleticTypesArray=$objComm->getAthletesType(); unset($athleticTypesArray["All"]); ?>      
                  <?=$objHTML->generateCustomCombo($athleticTypesArray,"data_type",$datum->type,"required","Please Select Type")?>
              </div>
            </div>
            
			
            <div class="control-group">
              <label class="control-label" for="data_status">Athlete Status</label>
              <div class="controls">
                <?=$objHTML->statusBasicCombo('data_status',$datum->status)?>
              </div>
            </div>
            <div class="controls">
             <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="update">Save Changes</button>
              <a href="index.php?model=<?=$model?>"><button type="button" class="btn">Cancel</button></a>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

var fbUrl,isSlash,fbNewUrl,fbPhotoUrl,fbUserName;
var fbUrlPattern = /^(http|https)\:\/\/www.facebook.com\/.*/i;

$(document).ready(function()
{
	$("#data_facebook_url").on('change', function(e)
	{
		e.preventDefault();
		fbUrl=$.trim($(this).val());
		cur_id=$("#pk_id").val();
		
		if(fbUrl!="")
		{
			if(!fbUrl.match(fbUrlPattern)) 
			{
			  alert("This is not a Facebook URL");
			}
			else 
			{
				fbUserName = fbUrl.substring(fbUrl.lastIndexOf('/') + 1);
				$.ajax({
					anync: false,
					method: "POST",
					url: "ajax.php",
					data: "ajaxcall=true&mod=getProfileContents&action=update&fbUserName="+fbUserName+"&cur_id="+cur_id,
					crossDomain: true,
					success: function(response){
					try
					{
						JSONObject=$.parseJSON(response);
						if(JSONObject.status=="OK")
						{
							$("#data_photo_url").val(JSONObject.picture);
							$("#data_name").val(JSONObject.name);
							$("#facebook_photo").attr("src",JSONObject.picture);
							$("#data_facebook_id").val(JSONObject.userid);
						}
						else if(JSONObject.status=="EXIST")
						{
							alert("This User is Already Exist");
						}
						else
						{
							alert("Error Not a valid user");
						}
					}
					catch(e)
					{
						alert("This User Does Not Exist");
					}	

					
					}
				});
			}
		}	
	});
});
</script>

