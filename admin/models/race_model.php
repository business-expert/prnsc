<?php
class Race
{
	function __construct() 
	{
		
	}
	
	function getAllRace()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srRaceType 	= $_POST['sr_race_type'];
		
		$datum_race_type=$DB->fetchOne("SELECT id FROM race_type WHERE race_title LIKE '%".$srRaceType."%'","");
		if($srRaceType != '')
		{
			$arrWhere[] = "race.`race_type` ='".$datum_race_type->id."'";
		}
		
		$SQL = "SELECT id,event_id,race_type,race_active,race_date FROM race";
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		if($Where != '')	
			$SQL .=  $Where;
		$RS=$DB->query($SQL);
		$data=array();
		while($datum=mysql_fetch_object($RS))
		{
			$datum_event=$DB->fetchOne("SELECT name FROM event WHERE event.id='".$datum->event_id."'","");
			$datum->name=$datum_event->name;
			$datum_race_type=$DB->fetchOne("SELECT race_title FROM race_type WHERE race_type.id='".$datum->race_type."'","");
			$datum->race_title=$datum_race_type->race_title;
			$data[]=$datum;
		}
		return $data;
	}
	
	
	function getRace($id,$act="edit")
	{
		global $DB;
		$SQL = "SELECT * FROM race WHERE id='".$id."'";	
		$datum = $DB->fetchOne($SQL);
		if($act=="view")
		{
			$datum_event=$DB->fetchOne("SELECT name FROM event WHERE event.id='".$datum->event_id."'","");
			$datum->name=$datum_event->name;
			$datum_race_type=$DB->fetchOne("SELECT race_title FROM race_type WHERE race_type.id='".$datum->race_type."'","");
			$datum->race_title=$datum_race_type->race_title;
		}
		return $datum;
	}
	
	
	function setRace()
	{
		global $objComm, $DB;
		
	    $PkID = $_REQUEST['pk_id'];
		$this->arrField = $objComm->setTableField();
		$data=$DB->fetchOne("SELECT race_title FROM race_type WHERE id='".$_REQUEST["data_race_type"]."'","");
		$this->arrField["race_title"]=$data->race_title;			
		if($PkID > 0)
		{
			$where = "`id` = '".$PkID."'";
			$this->arrField["race_update"]=date("Y-m-d H:i:s");
			if($response=$DB->updateRecord('race', $this->arrField, $where , ''))
			{
				$_SESSION['race_success'] = 'Race Updated Successfully';
			}
			else
			{
				$_SESSION['race_error'] = 'ERROR: Unable to process';
			}
		}
		else
		{
			$this->arrField["race_date"]=date("Y-m-d H:i:s");
			if($response=$DB->addNewRecord('race', $this->arrField, ''))
			{
				$_SESSION['race_success'] = 'Race Added Successfully';
			}
			else
			{
				$_SESSION['race_error'] = 'ERROR: Unable to process';
			}
		}
	}
}
?>