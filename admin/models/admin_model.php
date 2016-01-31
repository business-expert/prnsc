<?php
class Admin
{
	function __construct() 
	{
		
	}
	
	function getAllAdmin()
	{
		global $DB, $objComm;
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 	= $_POST['sr_admin_name'];
		$srStatus 	= $_POST['sr_admin_status'];
		
		if($srName != '')		$arrWhere[] = "admin.`admin_name` like '%".$srName."%'";
		if($srStatus != '')		$arrWhere[] = "admin.`admin_status` like '%".$srStatus."%'";
		
		$SQL = "SELECT id,admin_name,admin_email,admin_date,admin_status FROM admin";	
		
		if(count($arrWhere) > 0){ $Where = " WHERE ".implode(" AND ", $arrWhere); }
		
		if($Where != ''){ $SQL .=  $Where; }
		
		$data = $DB->fetchAll($SQL);
		
		return $data;
	}
	
	
	function getAdmin($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM admin WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function setAdmin()
	{
		global $objComm, $DB;
		
	    $PkID = $_REQUEST['pk_id'];

		$this->arrField = $objComm->setTableField(); 
			
		if($PkID > 0)
		{
			$where = "`id` = '".$PkID."'";
			$this->arrField["admin_update"]=date("Y-m-d H:i:s");
			if($response=$DB->updateRecord('admin', $this->arrField, $where , ''))
			{
				$_SESSION['admin_success'] = 'Admin Updated Successfully';
			}
			else
			{
				$_SESSION['admin_error'] = 'Error: Unable to process';
			}
		}
		else
		{	
			$this->arrField["admin_date"]=date("Y-m-d H:i:s");
			if($response=$DB->addNewRecord('admin', $this->arrField, ''))
			{
				$_SESSION['admin_success'] = 'Admin Added Successfully';
			}
			else
			{
				$_SESSION['admin_error'] = 'Error: Unable to process';
			}
		}
	}
	
	
	function delAdmin($id)
	{
		global $DB;

		if($response=$DB->query("DELETE FROM admin WHERE id='".$id."' LIMIT 1", ""))
		{
			$_SESSION['admin_success'] = 'Admin Deleted Successfully';
		}
		else
		{
			$_SESSION['admin_error'] = 'Error: Unable to process';
		}		
	}
}
?>