<?php
class Season
{
	function __construct() 
	{
		
	}
	
	function getAllSeason()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 	= $_POST['sr_season_title'];
		$srStatus 	= $_POST['sr_season_status'];
		
		if($srName != '')		$arrWhere[] = "season.`season_title` like '%".$srName."%'";
		if($srStatus != '')		$arrWhere[] = "season.`season_status` like '%".$srStatus."%'";
		
		$SQL = "SELECT id, season_title, season_desc, season_date, season_start_date,season_end_date, season_status FROM season";
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		if($Where != '')	
			$SQL .=  $Where;
		return $DB->fetchAll($SQL);
	}
	
	
	function getSeason($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM season WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function setSeason()
	{
		global $objComm, $DB, $lang;
		
	    $PkID = $_REQUEST['pk_id'];

		$this->arrField = $objComm->setTableField();
			
		if($PkID > 0)
		{
			$_SESSION['season_success'] = 'Season Updated Successfully';
		
			$where = "`id` = '".$PkID."'";
			$this->arrField["season_update"]=date("Y-m-d H:i:s");
			return $DB->updateRecord('season', $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['season_success'] = 'Athletes Added Successfully';
			$this->arrField["season_date"]=date("Y-m-d H:i:s");
			$athletesid =  $DB->addNewRecord('season', $this->arrField, '');
		}
	}
	
	
	function delSeason($id)
	{
		global $DB, $lang;
		
		$_SESSION['season_success'] = 'Season Deleted Successfully';
		
		$SQL = "DELETE FROM season WHERE id='".$id."' LIMIT 1";
		$DB->query($SQL);	
	}
}
?>