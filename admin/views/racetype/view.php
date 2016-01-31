<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); $msg = $objComm->getSessionMessage('race');?>

<div>
 <ul class="breadcrumb">
       <li><a href="index.php?model=racetype">Race Type</a> <span class="divider">/</span></li>
        <li><a href="#">View Race Type</a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>View Race Type</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
          <fieldset>
            
          <div class="control-group">
              <label class="control-label" for="data_season_title">Race Type Title</label>
              <div class="controls">
				<span class="input-xlarge uneditable-input">
               <?=$datum->race_title?>
				</span>
              </div>
            </div>
           
		   
		    <div class="control-group">
              <label class="control-label" for="data_season_title">Race Athletic Type </label>
              <div class="controls">
				
                <?=$objHTML->generateCustomCombo($objComm->getAthletesType(),"data_race_type_athletic_code",$datum->race_type_athletic_code,"disabled","Select")?>
          
              </div>
            </div>
			
          
            <div class="control-group">
              <label class="control-label" for="data_education_level">Race Type Description</label>
               <div class="controls">
				<span class="input-xlarge uneditable-input">
                <?=$datum->race_desc?>
				</span>
              </div>
            </div>
			
			
		
			 <div class="control-group">
              <label class="control-label" for="data_education_level">Race Type Description</label>
               <div class="controls">
				<span class="input-xlarge uneditable-input">
                <?=$datum->race_desc?>
				</span>
              </div>
            </div>
		
			
			
			<div class="control-group">
              <label class="control-label" for="data_race_type_max_picks">Maximum Picks</label>
               <div class="controls">
				
                <span class="input-xlarge uneditable-input">
					<?=$datum->race_type_max_picks?>
				</span>
          
              </div>
            </div>
			
				<!-- Code to decide points -->
			
            <div class="form-actions"> <a href="index.php?model=racetype">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=racetype&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=racetype"><button type="button" class="btn">Cancel</button>
              </a> </div>
			  
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>