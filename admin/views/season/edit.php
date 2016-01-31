<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('season');

$arrDateName = array('date_year','date_month','date_date');
$arrDateID = array('date_year','date_month','date_date');
$arrDateVal = $row->birth_date;

?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=season">Season</a> <span class="divider">/</span></li>
        <li><a href="#">Add Season</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>Add Season</h2>
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
              <label class="control-label" for="data_season_title">Season Name</label>
              <div class="controls">
                <input type="text" required  value="<?=$datum->season_title?>" id="data_season_title" name="data_season_title" class="input-xsmall focused">
				<span class="recordExist"></span>
			  </div>
            </div>
           
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">Season Description</label>
              <div class="controls">
				<textarea required name="data_season_desc" id="data_season_desc" class="input-xsmall focused">
					<?=$datum->season_desc?>
				</textarea>
    
              </div>
            </div>
            

			<div class="control-group">
              <label class="control-label" for="data_season">
               Season Start
              </label>
              <div class="controls input-append date" id="data_season_start_date">
                 <input style="display:inline-none;" value="<?=$datum->season_start_date?>" type="text" name="data_season_start_date" id="data_season_start_date"></input>
					<span class="add-on">
					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					</span>
			  </div>
            </div>
        
		<div class="control-group">
              <label class="control-label" for="data_season">
               Season End
              </label>
              <div class="controls input-append date" id="data_season_end_date">
                 <input style="display:inline-none;" value="<?=$datum->season_end_date?>" type="text" name="data_season_end_date" id="data_season_end_date"></input>
					<span class="add-on">
					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					</span>
			  </div>
            </div>
				
            
            <div class="control-group">
              <label class="control-label" for="name">Season Status</label>
              <div class="controls"><?=$objHTML->statusBasicCombo("data_season_status",$datum->season_status,"required")?></div>
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





<script>
$(document).ready(function(){
$('#data_season_title').on('change', function(){

		$.ajax({
			type	: "GET",
			url		: "ajax.php",
			data    : "ajaxcall=true&mod=checkUniqRecord&act=UPDATE&tb=season&col_name=season_title&col_value="+$("#data_season_title").val()+"&cur_col=id&cur_value="+$("#pk_id").val(),
			success	: function(response) {
						var JSONObject=$.parseJSON(response);
						if(JSONObject.status=="NO")
							$(".recordExist").html("Record is Exist");
						else
							$(".recordExist").html("");
					 }
		  });	//season_add_form
});

	$("#btn_submit").click(function(e){

		if($(".recordExist").html()!="")
		{
			e.preventDefault();
			return false;
		}
	});
});
</script>




<link type="text/css" rel="stylesheet" href="<?=CSS_ADMIN?>bootstrap-datetimepicker.min.css" />
<script src="<?=JS_ADMIN?>jquery-1.8.3.js"></script>
<script src="<?=JS_ADMIN?>bootstrap.min.js"></script>
<script src="<?=JS_ADMIN?>bootstrap-datetimepicker.min.js"></script>
<script src="<?=JS_ADMIN?>bootstrap-datetimepicker.pt-BR.js"></script>
<script type="text/javascript">
      $('#data_season_start_date').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss'
      });
	  
	   $('#data_season_end_date').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss'
      });
 </script>


