<?php


class athletes
{
	function __construct() 
	{
		
	}
	
	function getAllAthletes()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 	= $_POST['sr_name'];
		$srStatus 	= $_POST['sr_status'];
		
		if($srName != '')		$arrWhere[] = "A.`name` like '%".$srName."%'";
		if($srStatus != '')		$arrWhere[] = "A.`status`='".$srStatus."'";
		$SQL = "SELECT A.id,name,
						   facebook_url,
						   photo_url,
						   bio,
						   type,
						   status,
						   (SUM(penalty.penalty_jumps) + 
						   SUM(penalty.penalty_dqs) + 
						   SUM(penalty.penalty_falls)) AS TOTAL_POINTS
						   FROM athlete A LEFT JOIN penalty ON 
						   penalty.penalty_athlete_id=A.id 
						  ";	
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
		if($Where != '')	
			$SQL .=  $Where;
		
		$SQL .= " GROUP BY A.id";

		$Records = $DB->fetchAll($SQL);
		
		return $Records;
	}
	
	
	function getAthletes($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM athlete WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function setAthletes()
	{
		global $objComm, $DB;
		
	    $PkID = $_REQUEST['pk_id'];

		$this->arrField = $objComm->setTableField();
			
		if($PkID > 0)
		{
			$_SESSION['athletes_success'] = 'Athletes Updated Successfully';
		
			$where = "`id` = '".$PkID."'";
		
			return $DB->updateRecord('athlete', $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['athletes_success'] = 'Athletes Added Successfully';
		
			$athletesid =  $DB->addNewRecord('athlete', $this->arrField, '');
			
			
		}
	}
	
	
	function delAthletes($id)
	{
		global $DB, $lang;
		
		$_SESSION['athletes_success'] = 'Athletes Deleted Successfully';
		
		$SQL = "DELETE FROM athlete WHERE id='".$id."' LIMIT 1";
		$DB->query($SQL);	
	}
	
	function getPenalty($athlete_id)
	{
		global $objComm, $DB;
		$SQL="SELECT race.id AS race_id,race.race_title,penalty.id AS penalty_id,		
		(CASE WHEN penalty.penalty_jumps IS NULL THEN 0 ELSE penalty.penalty_jumps END) AS penalty_jumps,
		(CASE WHEN penalty.penalty_dqs IS NULL THEN 0 ELSE penalty.penalty_dqs END) AS penalty_dqs,
		(CASE WHEN penalty.penalty_falls IS NULL THEN 0 ELSE penalty.penalty_falls END) AS penalty_falls,
		(CASE WHEN penalty.penalty_athlete_id IS NULL THEN 0 ELSE penalty.penalty_athlete_id END) AS penalty_athlete_id,
		(CASE WHEN penalty.penalty_race_id IS NULL THEN 0 ELSE penalty.penalty_race_id END) AS penalty_race_id,
		(CASE WHEN penalty.penalty_falls IS NULL THEN 0 ELSE penalty.penalty_falls END) AS penalty_falls
		FROM race LEFT JOIN penalty ON penalty.penalty_race_id=race.id AND penalty_athlete_id='".$athlete_id."'";
		$dataPenalty=$DB->fetchAll($SQL,"");
		$athleticData=$DB->fetchOne("SELECT name,type FROM athlete WHERE athlete.id='".$athlete_id."'","");
		return array("dataPenalty"=>$dataPenalty,"athleticData"=>$athleticData);
	}
	
	function setPenalty($athlete_id)
	{
		global $objComm, $DB;
		$data_race_id=$_REQUEST["data_race_id"];
		$data_penalty_jumps=$_REQUEST["data_penalty_jumps"];
		$data_penalty_dqs=$_REQUEST["data_penalty_dqs"];
		$data_penalty_falls=$_REQUEST["data_penalty_falls"];
		$currentDate=date("Y-m-d H:i:s");
		$action=($objComm->isRecordExist("SELECT id FROM penalty WHERE penalty.penalty_athlete_id='".$athlete_id."'")) ? "UPDATE" : "INSERT";
		
		foreach($data_race_id as $key=>$value)
		{
			$insertData=array(
			"penalty_athlete_id"=>$athlete_id,
			"penalty_race_id"=>$value,
			"penalty_jumps"=>$data_penalty_jumps[$key],
			"penalty_dqs"=>$data_penalty_dqs[$key],
			"penalty_falls"=>$data_penalty_falls[$key]
			);
			if($action=="UPDATE")
			{
				$insertData["penalty_update"]=$currentDate;							
				$response=$DB->updateRecord("penalty", $insertData, "penalty.penalty_athlete_id='".$athlete_id."' AND penalty.penalty_race_id='".$value."'" , "");
			}
			else
			{
				$insertData["penalty_date"]=$currentDate;
				$response=$DB->addNewRecord("penalty", $insertData , "");
			}
		}
		if($response){ $_SESSION['penalty_success'] = 'Penalty Added Successfully'; } 
		else { $_SESSION['penalty_error'] = 'Unable To Process'; }
		
	}
}
?>