<?php


class events
{
	function __construct() 
	{
		
	}
	
	function getAllEvents()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 	= $_POST['sr_name'];
		$srStatus 	= $_POST['sr_status'];
		
		if($srName != '')		$arrWhere[] = "event.`name` like '%".$srName."%'";
		if($srStatus != '')		$arrWhere[] = "event.`active` like '%".$srStatus."%'";
		
		$SQL = "SELECT event.id,event.season,event.name,event.event_start_date_time,event.event_end_date_time,event.active FROM event";	
		
		if(count($arrWhere) > 0){ $Where = " WHERE ".implode(" AND ", $arrWhere); } 
		if($Where != ''){ $SQL .=  $Where; } $RS = $DB->query($SQL); $data=array();
		while($datum=mysql_fetch_object($RS))
		{
			$datum_season=$DB->fetchOne("SELECT season_title FROM season WHERE season.id='".$datum->season."'");
			$datum->season=$datum_season->season_title; $data[]=$datum;		
		}
		return $data;
	}
	
	
	function getEvents($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM event WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function setEvents()
	{
		global $objComm, $DB, $lang;
		
	    $PkID = $_REQUEST['pk_id'];

		$this->arrField = $objComm->setTableField();
		
		if($PkID > 0)
		{
			$where = "`id` = '".$PkID."'";
			if(!empty($_FILES["data_event_image"]["name"]))
			{
				$objComm->deleteFile(array("SQL"=>"SELECT event_image FROM event WHERE id='".$PkID."'","fieldName"=>"event_image"));
				$uploadInfo=$objComm->uploadfile(FILE_UPLOAD_PATH, $_FILES["data_event_image"]);
				$this->arrField["event_image"]=$uploadInfo["filename"];
				
			}
			
			if($DB->updateRecord('event', $this->arrField, $where , ''))
			{
				$_SESSION['events_success'] = "Event Update Successfully";
			}
			else
			{
				$_SESSION['events_error'] = "Error: Unable to Process";
			}
		}
		else
		{
			if(!empty($_FILES["data_event_image"]["name"]))
			{
				$uploadInfo=$objComm->uploadfile(FILE_UPLOAD_PATH, $_FILES["data_event_image"]);
				$this->arrField["event_image"]=$uploadInfo["filename"];
			}
			
			if($response=$DB->addNewRecord('event', $this->arrField, ''))
			{
				return $response;
				$_SESSION['events_success'] = "Event Added Successfully";
				
			}
			else
			{
				$_SESSION['events_error'] = "Error: Unable to Process";
			}
		}
		
	}
	
	
	function delEvents($id)
	{
		global $DB, $lang;
		
		$_SESSION['events_success'] = "Event Deleted Successfully";
		
		$SQL = "DELETE FROM event WHERE id='".$id."' LIMIT 1";
		$DB->query($SQL);	
	}
}

?>