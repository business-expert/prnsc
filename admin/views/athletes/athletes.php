<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('athletes');
$msg1 = $objComm->getSessionMessage('email');
$arrAthletesStatus = $objComm->getAthletesStatus();

?>

<div>
    <ul class="breadcrumb">
        <li><a href="index.php?model=athletes">Athletes</a> <span class="divider">/</span></li>
        <li><a href="#">All Athletes</a></li>
   </ul>
</div>
  <?=$msg?><?=$msg1?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Athletes</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3>Search</h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2" >
            <tr>
                <td align="right">Athletes Name : <input type="search" name="sr_name" id="sr_name" value="<?=$_REQUEST['sr_name']?>"  /></td>
                <td align="right"></td>
                <td align="right">Status : <?=$objHTML->statusBasicCombo('sr_status',$_REQUEST['sr_status'])?></td>                
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
           <a class="btn btn-success" href="index.php?model=athletes&action=add"><i class="icon-plus icon-white"></i> Add New Athletes </a> 
        </div>
      </div>
      <br />
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
          <tr>
            <th>Athletes #</th>
            <th>Name</th>
            <th>Facebook Profile Url</th>
            <th>Facebook Photo</th>
			<th>Penality</th>
            <th>Status</th>             
            <th nowrap>Action</th>            
          </tr>
        </thead>
        <tbody>
        
        <?php 
			$counter=1;
			foreach($Records as $datum)
			{
				$view   = "index.php?model=athletes&action=view&id=".$datum->id;
				$edit   = "index.php?model=athletes&action=edit&id=".$datum->id;
				$delete = "index.php?model=athletes&action=delete&id=".$datum->id;
				$image  =  (exif_imagetype($datum->photo_url) == IMAGETYPE_JPEG) ?  $datum->photo_url : DEFAULT_ATHLETES_PROFILE_AVTAR;

			?>
				<tr id="<?=$datum->id?>">
				<td class="center"><?=$counter++?></td>
				<td class="center"><?=$datum->name?></td>
				<td class="center"><a href='<?=$datum->facebook_url?>' target="_blank" title="Click go to facebook profile"><?=$datum->facebook_url?></a></td>
				<td class="center">
				<a href="#" class="" data-rel="popover" data-content="<img src='<?=$image?>'>" title="Photo">VIEW PHOTO</a></td>
				<td class="center">
				<a data-rel="popover" data-content="Total Penalty: <?=(int)$datum->TOTAL_POINTS?>" href='index.php?model=athletes&action=penalty_edit&athlete_id=<?=$datum->id?>' target='_blnk'>PENALITIES</a>
				</td>
				<td class="center"><span class="label <?=$arrAthletesStatus[$datum->status]?>"><?=$datum->status?></td>
				<td class="center" nowrap>
				<a class="btn btn-success" href="<?=$view?>" alt="View Athletes" title="View Athletes"> <i class="icon-zoom-in icon-white"></i></a>
                <a class="btn btn-info" href="<?=$edit?>" alt="Edit Athletes" title="Edit Athletes"> <i class="icon-edit icon-white"></i></a>
                <a class="btn btn-danger delete_datum" id="deleted_<?=$datum->id?>" data="athlete;id;<?=$datum->id?>" href="#" alt="Delete Athletes" title="Delete Athletes"> <i class="icon-trash icon-white"></i></a></td>
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
			
		}
		
	}
	});
});
</script>


		