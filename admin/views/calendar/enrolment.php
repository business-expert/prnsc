<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 
?>

<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Events']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=calendar&action=enrolment"><?=$lang['Enrolment']?></a></li>
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['Enrolment']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <!-- <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3><?php //$lang['Advanced Search']?></h3></div> -->
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<!-- search form -->
    </form>
	
      <div class="page-header" style="padding-bottom:0px;margin:-10px 0;">
	  
	  </div>
      <div class="control-group" style="text-align:right;margin:20px 0 0 0;">
        <!--<div class="controls"> 
           <a class="btn btn-success" href="index.php?model=members&action=add"><i class="icon-plus icon-white"></i> <?php //$lang['Add New Member']?> </a> 
        </div>
		-->
      </div>
      
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
          <tr>
            <th><?=$lang['Event']?> <?=$lang['ID']?></th>
            <th><?=$lang['Event']?> <?=$lang['Name']?></th>
            <th><?=$lang['Event']?> <?=$lang['Description']?></th>
            <th><?=$lang['Start']?> <?=$lang['Date']?></th>
            <th><?=$lang['End']?> <?=$lang['Date']?></th>
            <th><?=$lang['Enrolment']?></th>
            <th><?=$lang['Total']?> <?=$lang['Enrolment']?></th>            
            <th nowrap><?=$lang['Action']?></th>            
          </tr>
        </thead>	
        <tbody>
        <?php foreach($Records as $data) { ?>
		<tr>
			<td class="center"><?=$data->event_id?></td>
			<td class="center"><?=$data->event_title?></td>
			<td class="center"><?=$data->event_desc?></td>
			<td class="center"><?=$data->event_start_date?></td>
			<td class="center"><?=$data->event_end_date?></td>
			<td class="center"><?=$data->enrolment?></td>
			<td class="center"><?=$data->event_enrollment?></td>
			<td class="center"><a href="" class="btn btn-success enrolled_event_details" id="<?=$data->event_id?>" data="<?=$data->user_id?>"><i class="icon-zoom-in icon-white"></i></a></td>
		</tr>
		<?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/span--> 
  
</div>



<!-- START event Details Pop up-->
<div id="myModal" class="modal fade hide in">
    <div class="modal-header">
        <h3><?=$lang['Event']?> <?=$lang['Enrolment']?> <?=$lang['Details']?></h3>
    </div>
    <div class="modal-body">
		<p><?=$lang['Event']?> <?=$lang['Name']?>: <h4 id="event_title"></h4></p>
		<p><?=$lang['Event']?> <?=$lang['Description']?>: <h4 id="event_desc"></h4></p>
		<p><?=$lang['Event']?> <?=$lang['Date']?>: <h4 id="event_date"><span></span></h4></p>
		
		<div class="modal-header"></div>
		<h3><?=$lang['Enrolled']?> <?=$lang['Members']?> <?=$lang['Details']?></h3>
		
		<div id="enrolled_member_datails_container"></div>	
     </div>
    <div class="modal-footer">
        <a data-dismiss="modal" class="btn" onclick="javascript:hideModel();">
			<button class="close" type="button" id="reedom" >×</button>
		</a>
        
    </div>
</div>
<!-- END event Details Pop up-->







<script>
$(document).ready(function(){

	$(".enrolled_event_details").click(function(e){
		e.preventDefault();
		event_id=$(this).attr("id");
		user_id=$(this).attr("data");
		//alert(event_id+" "+user_id);			
		$.ajax({
			type	: "GET",
			url		: "ajax.php",
			data    : "ajaxcall=true&mod=enrolledEventDetail&event_id="+event_id,
			success	: function(result)   {
							var contents="";
							var first=true;
							$.each($.parseJSON(result), function(key,obj){
								$("#member_name").val(obj.member_name);
								$("#event_enroll_dates").val(obj.event_enroll_dates);
								contents += "<div class='modal-header'></div>";
								contents += "<p><?=$lang['Member']?> <?=$lang['Name']?>: <h4>"+obj.member_name+"</h4></p>";
								contents += "<p><?=$lang['Enrolled']?> <?=$lang['Date']?>: <h4>"+obj.event_enroll_dates+"</h4></p>";
								
								if(first==true)
								{
									$("#event_title").html(obj.event_title);	
									$("#event_desc").html(obj.event_desc);	
									$("#event_date").html(obj.event_start_date+" TO "+obj.event_end_date);
									first=false;
								}
							});
							
							$("#enrolled_member_datails_container").html(contents);
							$('#myModal').addClass('fade').removeClass('hide');
							
					  }
	   });	
	});

	
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
function hideModel()
{
	$('#myModal').addClass('hide').removeClass('face');
}
</script>		