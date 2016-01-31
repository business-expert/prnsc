<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('events');

?>

<div>
    <ul class="breadcrumb">
        <li><a href="index.php?model=events">Events</a> <span class="divider">/</span><a href="#">All Events</a></li>
       
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Events</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3>Search</h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right">Name : <input type="search" name="sr_name" id="sr_name" value="<?=$_REQUEST['sr_name']?>"  /></td>
                <td align="right"></td>
                <td align="right">
                	<button style="margin:-13px 0px 0 0;" class="btn btn-small btn-success">Search</button>
	                <button style="margin:-13px 0px 0 0;" class="btn btn-small btn-info" onclick="ResetSearch();">Reset</button>
                </td>                
            </tr>
        </table>
        </form>
        <div class="page-header" style="padding-bottom:0px;margin:-10px 0;"></div>
      
      <div class="control-group" style="text-align:right;margin:20px 0 0 0;">
        <div class="controls"> 
           <a class="btn btn-success" href="index.php?model=events&action=add"><i class="icon-plus icon-white"></i> Add An Event </a> 
        </div>
      </div>
      <br />
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
        
          <tr>
			<th>Event #</th>
            <th>Event Title</th>
            <th>Season</th>
            <th>Event Duration</th>
			<th>Active</th>
            <th nowrap>Action</th>            
          </tr>
        </thead>
        <tbody>
        
        <?php 
			
			foreach($Records as $datum)
			{
				$view   = "index.php?model=events&action=view&id=".$datum->id;
				$edit   = "index.php?model=events&action=edit&id=".$datum->id;
				$delete = "index.php?model=events&action=delete&id=".$datum->id;
				
				$timeStamp=$objComm->dateDucationFormat1($datum->event_start_date_time,$datum->event_end_date_time);
			?>
				<tr id="<?=$datum->id?>">
				<td class="center"><?=$datum->id?></td>
				<td class="center"><?=$datum->name?></td>
				<td class="center"><?=$datum->season?></td>
				
				<td class="center"><?=implode(" ",$timeStamp["startTimeStamp"]);?> TO <?=implode(" ",$timeStamp["endTimeStamp"]);?></td>
				<td class="center"><?=$datum->active?></td>
				<td class="center" nowrap>
				
				<a class="btn btn-success" href="<?=$view?>" alt="View Athletes" title="View Athletes"> <i class="icon-zoom-in icon-white"></i></a> 
				<a class="btn btn-info" href="<?=$edit?>" alt="Edit Athletes" title="Edit Athletes"> <i class="icon-edit icon-white"></i></a> 
				<a class="btn btn-danger delete_datum" id="deleted_<?=$datum->id?>" data="event;id;<?=$datum->id?>" href="#" alt="Delete Athletes" title="Delete Athletes"> <i class="icon-trash icon-white"></i></a></td>
				</td>
				</tr>
		<?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/span--> 
  
</div>

<div id="manage_event_time_box" class="modal hide fade in" style="display: none; ">  
    <div class="modal-header">  
        <h3>Manage event time</h3>  
     </div>  
     <div class="modal-body">  
       <form class="bootbox-form">
          <table width="100%" border="0">
          <tr>
            <td>Event Title</td>
            <td>--</td>
          </tr>
          <tr>
            <td>Start Date/Time</td>
            <td> <div id="start_time" class="input-append">
            <input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
            <span class="add-on">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
          </div></td>
          </tr>
          <tr>
            <td>End Date/Time</td>
            <td> <div id="end_time" class="input-append">
            <input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
            <span class="add-on">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
          </div></td>
          </tr>
        </table>
    </div>  
    <div class="modal-footer">  
    <a href="#" class="btn" data-dismiss="modal">Close</a>  
    </div>  
</div>  


<script src="<?=CSS_ADMIN?>bootstrap-datetimepicker.min.css"></script>
<script src="<?=JS_ADMIN?>bootstrap-datetimepicker.min.js"></script>


<script type="text/javascript">
  $(function() {
    $('#start_time').datetimepicker({
      pickDate: false
    });
	
	 $('#end_time').datetimepicker({
       pickDate: false
    });
	
  });

function eventTime()
{
	$("#manage_event_time_box").modal();    
}
</script>
<script>

//"sDom":'<"bottom"<"clear">>rt<"bottom"iflp<"clear">>'
//"sDom": "<'top'<'row-fluid'<'span6'><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",	

$( document ).ready(function() {
	$('.datatable1').dataTable({
		"sDom": "<'row-fluid'<'span6'><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {"sLengthMenu": "_MENU_ records per page"},
	    "bFilter": false,
	} );
});


function ResetSearch()
{
	$("#frm_search input,select").val('');
	$("#frm_search").submit();
}

	
</script>	
<script type="text/javascript" src="<?=JS_ADMIN?>common_func.js"></script>
<script type="text/javascript">
$(function() {
	$(".delete_datum").deleteData({
	mod : 'ajaxDeleteEvent',
	dataOnDeleted : function(response){
		var JSONObject = $.parseJSON(response);
	}
	});
});
</script>	