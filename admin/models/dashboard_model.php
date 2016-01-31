<?php


class dashboard
{
	function __construct() 
	{
		
	}
	
	function getTotalMembers()
	{
		global $DB;

		$SQL = "SELECT count(*) as total FROM members";
		
		$Records = $DB->fetchOne($SQL);
		
		return $Records->total;
	}
	
	function getTotalAlliances()
	{
		global $DB;

		$SQL = "SELECT count(*) as total FROM alliance";
		
		$Records = $DB->fetchOne($SQL);
		
		return $Records->total;
	}
	
	function getLetestAddedAthletes()
	{
		global $DB;

		$SQL = "SELECT *  FROM athlete ORDER BY id DESC LIMIT 4 ";
		
		$Records = $DB->fetchAll($SQL);
		
		return $Records;
	}
	
	function getLetestAddedEvent()
	{
		global $DB;

		$SQL = "SELECT * FROM event WHERE event_end_date_time > '".date("Y-m-d H:i:s")."' ORDER BY event_end_date_time DESC LIMIT 4 ";
		
		$Records = $DB->fetchAll($SQL);
		
		return $Records;
	}
	
	
	function getMostVisitedFanList()
	{
		global $DB;

		$SQL = "SELECT * FROM facebook ORDER BY fb_visit_count DESC LIMIT 4 ";
		
		$Records = $DB->fetchAll($SQL);
		
		return $Records;
	}
	
		
}
?>