<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('admin');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=admin">Admin</a> <span class="divider">/</span></li>
        <li><a href="#">Update Admin</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Update Admin</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
        <input type="hidden" name="action" id="action" value="edit" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <fieldset>
            
          <div class="control-group">
              <label class="control-label" for="data_admin_name">Name</label>
              <div class="controls">
                <input type="text" required value="<?=$datum->admin_name?>" id="data_admin_name" name="data_admin_name" class="input-xsmall focused">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="data_admin_email">Email</label>
              <div class="controls">
                <input type="email" required value="<?=$datum->admin_email?>" id="data_admin_email" name="data_admin_email" class="input-xsmall focused" />
				<span id="emailExist"></span>
              </div>
            </div>
            
            <div class="controls">
               <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="update">Update</button>
              <a href="index.php?model=<?=$model?>"><button type="button" class="btn">Cancel</button></a>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
$('#data_admin_email').on('change', function(){
    if($('#data_admin_email').val().length > 10)
	{
		$.ajax({
			type	: "GET",
			url		: "ajax.php",
			data    : "ajaxcall=true&mod=checkUniqRecord&act=UPDATE&tb=admin&col_name=admin_email&col_value="+$("#data_admin_email").val()+"&cur_col=id&cur_value="+$("#pk_id").val(),
			success	: function(response)   {
						var JSONObject=$.parseJSON(response);
						if(JSONObject.status=="NO")
							$("#emailExist").html("Email is Exist");
						else
							$("#emailExist").html("");
					  }
		   });	
	}
});

	$("#btn_submit").click(function(e){

		if($("#emailExist").html()!="")
		{
			e.preventDefault();
			return false;
		}
	});
});
</script>
