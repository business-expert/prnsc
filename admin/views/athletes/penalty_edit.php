<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('penalty');
?>
<style type="text/css">
	.link_incr_decr { font-size:20px;text-decoration:none; }
	.link_incr_decr:hover {text-decoration:none;}
	.input_incr_dect { width:50px;margin-top:-15px; }
	.wrapper_incr_decr { float:left;padding:10px; }
	.controller_incr_decr { float:left;padding:5px; }		
</style>
		
<div>
  <ul class="breadcrumb">
    <li><a href="index.php?model=athletes">Penalty</a> <span class="divider">/</span></li>
    <li><a href="#">Edit Penalty</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Penalty  [ Athletic: <?=$athleticData->name?> ]  [Category: <?=$athleticData->type?> ]</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
          <input type="hidden" name="action" id="action" value="penalty_update" />
          <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
		  <input type="hidden" name="athlete_id" id="athlete_id" value="<?=$_REQUEST['athlete_id']?>" />
        
		
		<fieldset>
		<div class="control-group">
			   <div style="float:left;padding:15px;font-size:20px;font-weight:bolder;" class="controls">
                Race
              </div>
              <div style="float:left;padding:15px;font-size:20px;font-weight:bolder;" class="controls">
                Penalty
              </div>
			  <div class="clear:both;"></div>
        </div>
		<div style="" class="page-header"></div>
		  <?php foreach($data as $datum) { ?>
		  
            <div class="control-group">
			<div style="float:left;padding:15px;" class="controls">
                <?=$datum->race_title?>
				<input type="hidden" value="<?=$datum->race_id?>" name="data_race_id[]" />
             </div>
             <div class="controls controller_incr_decr">
			 <div class="wrapper_incr_decr">
                <a href="#" class="link_incr_decr penalty_increment" rel="+" data="penalty_jumps_<?=$datum->race_id?>"> <span class="icon-plus"></span> </a>
				<input class="input_incr_dect" type="text" value="<?=$datum->penalty_jumps?>" id="penalty_jumps_<?=$datum->race_id?>" name="data_penalty_jumps[]" class="input-xsmall focused">
				<a href="#" class="link_incr_decr penalty_decrement" rel="-" data="penalty_jumps_<?=$datum->race_id?>"> <span class="icon-minus"></span> </a>
			  </div>
			  
			  
			  <div class="wrapper_incr_decr">
                <a href="#" class="link_incr_decr penalty_increment" rel="+" data="penalty_dqs_<?=$datum->race_id?>"> <span class="icon-plus"></span> </a>
                <input class="input_incr_dect" type="text" value="<?=$datum->penalty_dqs?>" id="penalty_dqs_<?=$datum->race_id?>" name="data_penalty_dqs[]" class="input-xsmall focused">
				<a href="#" class="link_incr_decr penalty_decrement" rel="-" data="penalty_dqs_<?=$datum->race_id?>"> <span class="icon-minus"></span> </a>
			  </div>
			  
			  <div class="wrapper_incr_decr">
                <a href="#" class="link_incr_decr penalty_increment" rel="+" data="penalty_falls_<?=$datum->race_id?>"> <span class="icon-plus"></span> </a>
                <input class="input_incr_dect" type="text" value="<?=$datum->penalty_falls?>" id="penalty_falls_<?=$datum->race_id?>" name="data_penalty_falls[]" class="input-xsmall focused">
				<a href="#" class="link_incr_decr penalty_decrement" rel="-" data="penalty_falls_<?=$datum->race_id?>"> <span class="icon-minus"></span> </a>
			  </div>
			  
			  
			  
			  
			  
			  
			  
			   
			  
             </div>
			 <div class="clear:both;"></div>
            </div>
			<div style="" class="page-header"></div>
           <?php } ?>
          
            
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
$(document).ready(function(){
$(".penalty_increment,.penalty_decrement").click(function(e){
	e.preventDefault();
	current=$(this).attr("data");
	if($(this).attr("rel")=="+")
	{
		$("#"+current).val(parseInt($("#"+current).val())+1);
	}
	else if($(this).attr("rel")=="-")
	{
		$("#"+current).val(parseInt($("#"+current).val())-1);
	}
	else
	{
		alert("wrong");
	}

});
});
</script>

