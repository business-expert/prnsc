<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('admin');
?>

<div>
    <ul class="breadcrumb">
        <li><a href="index.php?model=admin">Admin</a> <span class="divider">/</span></li>
        <li><a href="#">All Admin</a></li>
   </ul>
</div>
<?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> All Admin </h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
		
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3>Search</h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=admin">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right">admin Name : <input type="search" name="sr_admin_name" id="sr_admin_name" value=""  /></td>
                
                             
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
           <a class="btn btn-success" href="index.php?model=admin&action=add"><i class="icon-plus icon-white"></i> Add New admin </a> 
        </div>
      </div>
      <br />
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
          <tr>
            <th>Admin # </th>
            <th>Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Status</th>             
            <th nowrap>Action</th>            
          </tr>
        </thead>
        <tbody>
        
        <?php 
			
			foreach($data as $datum)
			{
				$view   = "index.php?model=admin&action=view&id=".$datum->id;
				$edit   = "index.php?model=admin&action=edit&id=".$datum->id;
			?>
				<tr id="<?=$datum->id?>">
				<td class="center"><?=$datum->id?></td>
				<td class="center"><?=$datum->admin_name?></td>
				<td class="center"><?=$datum->admin_email?></td>
				<td class="center"><?=date("Y-m-d",strtotime($datum->admin_date))?></td>
				<td class="center"><span class="label"><?=$datum->admin_status?></span></td>
				<td class="center" nowrap>
				<a class="btn btn-success" href="<?=$view?>" alt="View admin" title="View admin"> <i class="icon-zoom-in icon-white"></i></a> 
				<a class="btn btn-info" href="<?=$edit?>" alt="Edit admin" title="Edit admin"> <i class="icon-edit icon-white"></i></a> 
				<a class="btn btn-danger delete_datum" id="deleted_<?=$datum->id?>" data="admin;id;<?=$datum->id?>" href="#" alt="Delete admin" title="Delete admin"> <i class="icon-trash icon-white"></i></a></td>
				</tr>
		<?php } ?>
        </tbody>
      </table> 
    </div>
  </div>
  <!--/span--> 
  
</div>

<script>

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


		