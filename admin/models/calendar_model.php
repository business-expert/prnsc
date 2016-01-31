<?php


class calendar
{
	function __construct() 
	{
			
	}
	function getAllEvents()
	{
		global $DB;
		$SQL = "SELECT * FROM events";	
		$Records = $DB->fetchAll($SQL);	
		return $Records;
	}
	function getEnrolledEventsDetail()
	{
		global $DB; 
		$resource=$DB->query("SELECT COUNT(*) AS total_enrolment,user_id,event_id,event_enroll_dates FROM event_enrolled GROUP BY event_id","");
		$eventIDArray=array();
		$userIDArray=array();
		if(mysql_num_rows($resource)>0)
		{
			$data=array();
			while($record = mysql_fetch_object($resource))
			{
				$event_id=$record->event_id;	
				$enrolment=$record->total_enrolment;	
				$SQL="SELECT event_title,SUBSTR(event_desc,1,50) AS event_desc,SUBSTR(event_start_date,1,LOCATE('T',event_start_date)-1) AS event_start_date,SUBSTR(event_end_date,1,LOCATE('T',event_end_date)-1) AS event_end_date,event_enrollment FROM members JOIN events ON members.id=events.member_id AND events.event_id='".$event_id."'";
				$record_event=$DB->fetchOne($SQL,"");
				$record_event->enrolment=$enrolment;
				$record_event->user_id=$record->user_id;
				$record_event->event_id=$event_id;
				$data[] = $record_event;//SUBSTRING(str, pos, len)
			}

		}
		else
		{
			$data=array();
		}
		return $data;
		

	}
}
?>	