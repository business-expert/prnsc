<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg 		= $objComm->getSessionMessage('usersrole');
$arrStatus 	= $objComm->getAllStatus();

?>

<div>
   <ul class="breadcrumb">
        <li><a href="#">Events</a> <span class="divider">/</span></li>
        <li><a href="#">Event-Race Mapping</a><span class="divider"></span></li>        
        <li><a href="#"></a></li>
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Heading</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content" style="text-align:center">
    
  <img src="http://www.nibs.ac.cn/en/image/work_in_progress.jpg" />
   
    </div>
  </div>
</div>
