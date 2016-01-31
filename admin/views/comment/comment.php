<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('comment');

?>

<div>
    <ul class="breadcrumb">
        <li><a href="index.php?model=comment">comment</a> <span class="divider">/</span><a href="#">All Comment</a></li>
       
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>All comment</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3>Search</h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right">News Title : <input type="search" name="sr_post_title" id="sr_post_title" value="<?=$_REQUEST['sr_post_title']?>"  /></td>
                <td align="right"></td>
                <td align="right">
                	<button style="margin:-13px 0px 0 0;" class="btn btn-small btn-success">Search</button>
	                <button style="margin:-13px 0px 0 0;" class="btn btn-small btn-info" onclick="ResetSearch();">Reset</button>
                </td>                
            </tr>
        </table>
        </form>
        <div class="page-header" style="padding-bottom:0px;margin:-10px 0;"></div>
      
      <br />
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
        
          <tr>
			<th>Comment #</th>
            <th>News Title</th>
            <th>Comment</th>
			<th>Commented By</th>
			<th>Add ON</th>
			<th>Status</th>
            <th nowrap>Action</th>            
          </tr>
        </thead>
        <tbody>
		<?php $counter=1; foreach($data as $datum){
		$view="index.php?model=comment&action=view&id=".$datum->id;
		$edit="index.php?model=comment&action=edit&id=".$datum->id;
		?>
				<tr id="<?=$datum->id?>">
				<form action="index.php?model=comment" method="post">
				<input type="hidden" name="pk_id" value="<?=$datum->id?>" />
				<input type="hidden" name="action" value="Update" />
			
				<td class="center"><?=$counter++?></td>	
				<td class="center"><?=$datum->post_title?></td>
				<td class="center"><?=substr($datum->comment_desc,0,50)?></td>
				<td class="center"><?=$datum->fb_name?></td>
				<td class="center"><?=$datum->comment_date?></td>
				<td class="center">
					<?=$objHTML->generateCustomCombo(array("Active"=>"Active","Deactive"=>"Deactive"),"data_comment_status",$datum->comment_status,"required",$label="Select Status")?>					
				</td>
				<td class="center" nowrap>
				<a class="btn btn-success" href="<?=$view?>" alt="View Comment" title="View Comment"> <i class="icon-zoom-in icon-white"></i></a> 				
					<button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Update" alt="Select Status from Dropdown and then Click on Update button" title="Select Status from Dropdown and then Click on Update button">Update</button>
				<a class="btn btn-danger delete_datum" id="deleted_<?=$datum->id?>" data="post_comment;id;<?=$datum->id?>" href="#" alt="Delete Comment" title="Delete Comment"> <i class="icon-trash icon-white"></i></a>
				</td>
			</form>	
				</tr>
		<?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/span--> 
  
</div>


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
	dataOnDeleted : function(response){
		try
		{
			var JSONObject = $.parseJSON(response);
		}
		catch(e)
		{
			alert("Error: Unable to Process");
		}
		
	}
	});
});
</script>	