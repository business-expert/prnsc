<?php 

$arrData = array();
$strData = '';

foreach($LetestAthlets as $key => $row)
{
	$arrData[] = '<li> 
					<a href="#"> 
						<img src="'.$row->photo_url.'" alt="'.$row->name.'" class="dashboard-avatar"></a> 
						<strong>Name:</strong> <a href="#"> '.$row->name.'</a><br>
			            <strong>Athlet Type:</strong> '.$row->type.'<br>
            			<strong>Status:</strong> <span class="label label-success">'.$row->status.'</span> 
				  </li>';	
	
}

if(count($arrData) > 0)
{
	$strData = implode('',$arrData);
}


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
