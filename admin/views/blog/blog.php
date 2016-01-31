<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('blog');

?>

<div>
    <ul class="breadcrumb">
        <li><a href="index.php?model=blog">News</a> <span class="divider">/</span><a href="#">All News</a></li>
       
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>All News</h2>
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
      
      <div class="control-group" style="text-align:right;margin:20px 0 0 0;">
        <div class="controls"> 
           <a class="btn btn-success" href="index.php?model=blog&action=add"><i class="icon-plus icon-white"></i> Add New News</a> 
        </div>
      </div>
      <br />
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
        
          <tr>
			<th>News #</th>
            <th>News Title</th>
			<th>Added By</th>
            <th>News Comments</th>
			<th>Add ON</th>
			<th>Active</th>
            <th nowrap>Action</th>            
          </tr>
        </thead>
        <tbody>
        
		<?php $counter=1; foreach($data as $datum){$view="index.php?model=blog&action=view&id=".$datum->id;$edit="index.php?model=blog&action=edit&id=".$datum->id;?>
				<tr id="<?=$datum->id?>">
				<td class="center"><?=$counter++?></td>	
				<td class="center"><?=$datum->post_title?></td>
				<td class="center"><?=($datum->name) ? $datum->name : $datum->post_add_by?></td>
				<td class="center"><?=$datum->TOTAL_COMMENTS?></td>
				<td class="center"><?=$datum->post_date?></td>
				<td class="center">
					<span class="label">
						<?=$datum->post_status?>
					</span>
				</td>
				<td class="center" nowrap>
				
				<a class="btn btn-success" href="<?=$view?>" alt="View News" title="View News"> <i class="icon-zoom-in icon-white"></i></a> 
				<a class="btn btn-info" href="<?=$edit?>" alt="Edit News" title="Edit News"> <i class="icon-edit icon-white"></i></a> 
				<a class="btn btn-danger delete_datum" id="deleted_<?=$datum->id?>" data="post;id;<?=$datum->id?>" href="#" alt="Delete News" title="Delete News"> <i class="icon-trash icon-white"></i></a>
				</td>
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
		var JSONObject = $.parseJSON(response);
	}
	});
});
</script>	