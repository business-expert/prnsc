
<?php
class AthleticType
{
	function __construct() 
	{
		
	}
	
	function getAllAthleticType()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srRaceTitle 	= $_POST['sr_athletic_type_title']; if($srRaceTitle != ''){ $arrWhere[] = "athletic_type.`athletic_type_title` like '%".$srRaceTitle."%'"; }
		$SQL = "SELECT id,athletic_type_title,athletic_type_desc,athletic_type_date FROM athletic_type";
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		if($Where != '')	
			$SQL .=  $Where;
		return($DB->fetchAll($SQL));
	}
	
	
	function getAthleticType($id)
	{
		global $DB;
		$SQL = "SELECT * FROM athletic_type WHERE id='".$id."'";	
		return($DB->fetchOne($SQL));
		
	}
	
	
	function setAthleticType()
	{
		global $objComm, $DB;
		
	    $PkID = $_REQUEST['pk_id'];

		$this->arrField = $objComm->setTableField();
			
		if($PkID > 0)
		{
			$where = "`id` = '".$PkID."'";
			$this->arrField["athletic_type_update"]=date("Y-m-d H:i:s");
			if($response=$DB->updateRecord('athletic_type', $this->arrField, $where , ''))
			{
				$_SESSION['athletictype_success'] = 'Athletic Type Updated Successfully';
			}
			else
			{
				$_SESSION['athletictype_error'] = 'ERROR: Unable to process';
			}
		}
		else
		{
			$this->arrField["athletic_type_date"]=date("Y-m-d H:i:s");
			if($response=$DB->addNewRecord('athletic_type', $this->arrField, ''))
			{
				$_SESSION['athletictype_success'] = 'Athletic Type Added Successfully';
			}
			else
			{
				$_SESSION['athletictype_error'] = 'ERROR: Unable to process';
			}
		}
	}
}
?>