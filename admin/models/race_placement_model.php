
<?php
class RacePlacement
{
	function __construct() 
	{
		
	}
	
	function getRace()
	{		
		global $DB, $objComm;			
		$SQL="SELECT 
		race.id,
		race.race_title,
		race.race_flag,
		race_type.race_type_athletic_code
		FROM race JOIN race_type ON race.race_type=race_type.id
		WHERE race.race_active='Active'";				
		return ($DB->fetchAll($SQL,""));
	}

}
?>