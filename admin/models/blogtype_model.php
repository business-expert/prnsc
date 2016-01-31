
<?php
class BlogType
{
	function __construct() 
	{
		
	}
	
	function getAllBlogType()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srCatTitle 	= $_POST['sr_cat_title']; if($srCatTitle != ''){ $arrWhere[] = "post_category.`cat_title` like '%".$srCatTitle."%'"; }
		
		$SQL = "SELECT id, cat_title, cat_desc, cat_date,cat_status FROM post_category";
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		if($Where != '')	
			$SQL .=  $Where;
		return($DB->fetchAll($SQL));
	}
	
	
	function getBlogType($id)
	{
		global $DB;
		$SQL = "SELECT id, cat_title, cat_desc, cat_date,cat_status FROM post_category WHERE id='".$id."'";	
		return($DB->fetchOne($SQL));
		
	}
	
	
	function setBlogType()
	{
		global $objComm, $DB;
		
	    $PkID = $_REQUEST['pk_id'];

		$this->arrField = $objComm->setTableField();
			
		if($PkID > 0)
		{
			$where = "`id` = '".$PkID."'";
			$this->arrField["cat_update"]=date("Y-m-d H:i:s");
			if($response=$DB->updateRecord('post_category', $this->arrField, $where , ''))
			{
				$_SESSION['blogtype_success'] = 'News Type Updated Successfully';
			}
			else
			{
				$_SESSION['blogtype_error'] = 'ERROR: Unable to process';
			}
		}
		else
		{
			$this->arrField["cat_date"]=date("Y-m-d H:i:s");
			if($response=$DB->addNewRecord('post_category', $this->arrField, ''))
			{
				$_SESSION['blogtype_success'] = 'News Type Added Successfully';
			}
			else
			{
				$_SESSION['blogtype_error'] = 'ERROR: Unable to process';
			}
		}
	}
}
?>