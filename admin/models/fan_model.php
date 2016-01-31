<?php

class Fan
{
	function __construct() 
	{
		
	}
	
	function getAllFan()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 	= $_POST['sr_fb_email'];
		$srStatus 	= $_POST['sr_status'];
		
		if($srName != '')		$arrWhere[] = "facebook.`fb_email` like '%".$srName."%'";
		if($srStatus != '')		$arrWhere[] = "facebook.`fb_status` like '%".$srStatus."%'";
		
		$SQL="SELECT facebook.id,facebook.fb_id,facebook.fb_name,facebook.fb_username,facebook.fb_email,facebook.fb_phone,facebook.fb_location,facebook.fb_visit_count,DATE(facebook.fb_date) AS fb_date,facebook.fb_status,(CASE WHEN SUM(race_picks_points.rpp_points)>0 THEN SUM(race_picks_points.rpp_points) ELSE 0 END) AS TOTAL_POINTS FROM facebook LEFT JOIN race_picks_points ON facebook.fb_id=race_picks_points.rpp_fan_id";
		if(count($arrWhere) > 0){ $Where = " WHERE ".implode(" AND ", $arrWhere); } 
		if($Where != ''){ $SQL .=  $Where; } 
		$SQL .= " GROUP BY facebook.fb_id";
		$data = $DB->fetchAll($SQL);
		return $data;
	}
	
	
	function getFan($id)
	{
		global $DB;
		$SQL="SELECT facebook.id,facebook.fb_picture,facebook.fb_id,facebook.fb_name,facebook.fb_username,facebook.fb_email,facebook.fb_phone,facebook.fb_location,facebook.fb_visit_count,DATE(facebook.fb_date) AS fb_date,facebook.fb_status,(CASE WHEN SUM(race_picks_points.rpp_points)>0 THEN SUM(race_picks_points.rpp_points) ELSE 0 END) AS TOTAL_POINTS FROM facebook LEFT JOIN race_picks_points ON facebook.fb_id=race_picks_points.rpp_fan_id WHERE facebook.id='".$id."' GROUP BY facebook.fb_id";
		return($DB->fetchOne($SQL));
	}
	
	
	function setProduct()
	{
		global $objComm, $DB, $lang;
		
	    $PkID = $_REQUEST['pk_id'];

		$this->arrField = $objComm->setTableField();
		
		$product_inventory_total_products=$this->arrField["product_inventory_total_products"];
		unset($this->arrField["product_inventory_total_products"]);
		if($PkID > 0)
		{
			$this->arrField["product_update"]=date("Y-m-d H:i:s");
			$where = "`id` = '".$PkID."'";
			if(!empty($_FILES["data_product_image"]["name"]))
			{
				$objComm->deleteFile(array("SQL"=>"SELECT product_image FROM product WHERE id='".$PkID."'","fieldName"=>"product_image"));
				$uploadInfo=$objComm->uploadfile(FILE_UPLOAD_PATH, $_FILES["data_product_image"]);
				$this->arrField["product_image"]=$uploadInfo["filename"];
				
			}
			
			if($DB->updateRecord('product', $this->arrField, $where , ''))
			{
				$DB->updateRecord("product_inventory",array("product_inventory_total_products"=>$product_inventory_total_products,"product_inventory_product_id"=>$PkID,"product_inventory_remain_total_products"=>$product_inventory_total_products), $where , '');
				$_SESSION['product_success'] = "product Update Successfully";
			}
			else
			{
				$_SESSION['product_error'] = "Error: Unable to Process";
			}
		}
		else
		{
			$this->arrField["product_date"]=date("Y-m-d H:i:s");
			if(!empty($_FILES["data_product_image"]["name"]))
			{
				$uploadInfo=$objComm->uploadfile(FILE_UPLOAD_PATH, $_FILES["data_product_image"]);
				$this->arrField["product_image"]=$uploadInfo["filename"];
			}
			
			
			if($response=$DB->addNewRecord('product', $this->arrField, ''))
			{
				$DB->addNewRecord("product_inventory",array("product_inventory_total_products"=>$product_inventory_total_products,"product_inventory_product_id"=>$response,"product_inventory_remain_total_products"=>$product_inventory_total_products),'');
				$_SESSION['product_success'] = "product Added Successfully";
				return $response;
				
			}
			else
			{
				$_SESSION['product_error'] = "Error: Unable to Process";
			}
		}
		
	}
	
	
	function delproduct($id)
	{
		global $DB, $lang;
		
		$_SESSION['product_success'] = "product Deleted Successfully";
		
		$SQL = "DELETE FROM product WHERE id='".$id."' LIMIT 1";
		$DB->query($SQL);	
	}
}

?>