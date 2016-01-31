
<?php
class RaceType
{
	function __construct() 
	{
		
	}
	
	function getAllRaceType()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srRaceTitle 	= $_POST['sr_race_title']; if($srRaceTitle != ''){ $arrWhere[] = "race_type.`race_title` like '%".$srRaceTitle."%'"; }
		$SQL = "SELECT id,race_title,race_desc,race_type_max_picks,race_type_date FROM race_type";
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		if($Where != '')	
			$SQL .=  $Where;
		return($DB->fetchAll($SQL));
	}
	
	
	function getRaceType($id)
	{
		global $DB;
		$SQL = "SELECT race_type.id,race_type.race_title,	
				race_type.race_desc,race_type.race_type_athletic_code,	
				race_type.race_type_max_picks,race_type.race_type_date,
				race_type.race_type_update,
				race_type_points.rtp_race_type_id,
				race_type_points.rtp_race_type_points,
				race_type_points.rtp_race_type_max_picks FROM race_type LEFT JOIN race_type_points ON race_type.id=race_type_points.rtp_race_type_id WHERE race_type.id='".$id."'";	
		return($DB->fetchOne($SQL));
		
	}
	
	
	function setRaceType()
	{
		global $objComm, $DB;
		
	    $PkID = $_REQUEST['pk_id'];

		$this->arrField = $objComm->setTableField();
		print_r($_REQUEST["rtp"]["rtps"]);
		echo "<br />";
		//for($i=0 ; $i <= )
		//$_REQUEST["rtp[rtps][#index#][rtpname]"];

		print_r($_REQUEST); die();
		if($PkID > 0)
		{
			$where = "`id` = '".$PkID."'";
			$this->arrField["race_type_update"]=date("Y-m-d H:i:s");
			if($response=$DB->updateRecord('race_type', $this->arrField, $where , ''))
			{
				$_SESSION['racetype_success'] = 'RaceType Updated Successfully';
			}
			else
			{
				$_SESSION['racetype_error'] = 'ERROR: Unable to process';
			}
		}
		else
		{
			$this->arrField["race_type_date"]=date("Y-m-d H:i:s");
			if($response=$DB->addNewRecord('race_type', $this->arrField, ''))
			{
				$_SESSION['racetype_success'] = 'RaceType Added Successfully';
			}
			else
			{
				$_SESSION['racetype_error'] = 'ERROR: Unable to process';
			}
		}
	}
}
?>