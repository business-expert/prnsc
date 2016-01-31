<?php 

$arrData = array();
$strData = '';

foreach($arrFanVisisted as $key => $row)
{
	$image  =  (exif_imagetype($row->fb_picture) == IMAGETYPE_JPEG) ?  $row->fb_picture : DEFAULT_ATHLETES_PROFILE_AVTAR;
		
	$arrData[] = '<li> 
					<a href="#"> 
						<img src="'.$image.'" alt="'.$row->fb_name.'" class="dashboard-avatar"></a> 
						<strong>Name:</strong> <a href="#"> '.$row->fb_name.'</a><br>
			            <strong>No. Of Visited :</strong> '.$row->fb_visit_count.'<br>
            			<strong>Status:</strong> <span class="label label-success">'.$row->fb_status.'</span> 
				  </li>';	
	
}

if(count($arrData) > 0)
{
	$strData = implode('',$arrData);
}


?>
 
    <div data-original-title="" class="box-header well">
      <h2><i class="icon-user"></i> Most Visited Fan</h2>
      <div class="box-icon"> <a class="btn btn-minimize btn-round" href="#"><i class="icon-chevron-up"></i></a> <a class="btn btn-close btn-round" href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <ul class="dashboard-list"><?=$strData?></ul>
      </div>
    </div>
