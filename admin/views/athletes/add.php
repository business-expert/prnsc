<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('athletes');

$arrDateName = array('date_year','date_month','date_date');
$arrDateID = array('date_year','date_month','date_date');
$arrDateVal = $row->birth_date;

?>

<div>
 <ul class="breadcrumb">
        <li><a href="index.php?model=athletes">Athletes</a> <span class="divider">/</span></li>
        <li><a href="#">Add Athletes</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Athletes</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
		 <input type="hidden" name="data_facebook_id" id="data_facebook_id" value="" />
        <input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <fieldset>
            
          <div class="control-group">
              <label class="control-label" for="data_fname">Name</label>
              <div class="controls">
                <input type="text" required value="<?=$row->name?>" id="data_name" name="data_name" class="input-xsmall focused">
              </div>
            </div>
           
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">Facebook Url</label>
              <div class="controls">
                  <input required type="text" placeholder='http://www.facebook.com/username' value="<?=$row->facebook_url?>" id="data_facebook_url" name="data_facebook_url" class="input-xsmall focused" >
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="data_education_level">Photo Url</label>
              <div class="controls">
                  <input required type="text" value="<?=$row->photo_url?>" id="data_photo_url" name="data_photo_url" class="input-xsmall focused" >
              &nbsp;&nbsp;<img src='<?=$datum->photo_url?>' id='facebook_photo'></div>
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
                  <?=$objHTML->generateCustomCombo($athleticTypesArray,"data_type",$datum->type,"required","Select")?>
              </div>
            </div>
            
			
			
			
            <div class="control-group">
              <label class="control-label" for="name">Athlete Status</label>
              <div class="controls"><?=$objHTML->statusBasicCombo('data_status',$row->status,"required")?></div>
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


<script type="text/javascript">

var fbUrl,isSlash,fbNewUrl,fbPhotoUrl,fbUserName;
var fbUrlPattern = /^(http|https)\:\/\/www.facebook.com\/.*/i;

$(document).ready(function()
{
	$("#data_facebook_url").on('change', function(e)
	{
		e.preventDefault();
		fbUrl=$.trim($(this).val());
		
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
					data: "ajaxcall=true&mod=getProfileContents&fbUserName="+fbUserName,
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
