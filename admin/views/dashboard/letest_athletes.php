<?php 

$arrData = array();
 
foreach($LetestAthlets as $key => $row)
{
	$image  =  (exif_imagetype($row->photo_url) == IMAGETYPE_JPEG) ?  $row->photo_url : DEFAULT_ATHLETES_PROFILE_AVTAR;
	
	$arrData[] = '<li> 
					<a href="#"> 
						<img src="'.$image.'" alt="'.$row->name.'" class="dashboard-avatar"></a> 
						<strong>Name:</strong> <a href="#"> '.$row->name.'</a><br>
			            <strong>Athlet Type:</strong> '.$row->type.'<br>
            			<strong>Status:</strong> <span class="label label-success">'.$row->status.'</span> 
				  </li>';	
}

if(count($arrData) > 0)
	$strData = implode('',$arrData);

?>
 
    <div data-original-title="" class="box-header well">
      <h2><i class="icon-user"></i> New Athletes</h2>
      <div class="box-icon"> <a class="btn btn-minimize btn-round" href="#"><i class="icon-chevron-up"></i></a> <a class="btn btn-close btn-round" href="#"><i class="icon-remove"></i></a> </div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <ul class="dashboard-list"><?=$strData?></ul>
      </div>
    </div>
