<?php

class product
{
	function __construct() 
	{
		
	}
	
	function getAllproduct()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 	= $_POST['sr_name'];
		$srStatus 	= $_POST['sr_status'];
		
		if($srName != '')		$arrWhere[] = "product.`product_name` like '%".$srName."%'";
		if($srStatus != '')		$arrWhere[] = "product.`product_status` like '%".$srStatus."%'";
		
		$SQL = $SQL="SELECT 
		product_type.product_type,
		product_type.id	AS ptID,	
		product.id,
		product.product_type_id,
		product.product_name,
		product.product_image,
		product.product_price,
		product.product_variations,
		product.product_size,
		product.product_color,
		SUBSTRING(product.product_desc,1,50) AS product_desc,
		DATE(product.product_date) AS product_date,
		product.product_status,
		product.product_total_products,
		product.product_remain_total_products
		FROM product_type  
		JOIN product ON product_type.id=product.product_type_id
		WHERE product_status='Active'";
		
		if(count($arrWhere) > 0){ $Where = " AND ".implode(" AND ", $arrWhere); } 
		if($Where != ''){ $SQL .=  $Where; }

		$SQL .= " ORDER BY product_type.id ASC";
		$data = $DB->fetchAll($SQL);
		return $data;
	}
	
	
	function getProduct($id)
	{
		global $DB;
		
		$SQL = $SQL="SELECT 
		product_type.product_type,
		product_type.id	AS ptID,	
		product.id,
		product.product_type_id,
		product.product_name,
		product.product_image,
		product.product_price,
		product.product_variations,
		product.product_size,
		product.product_color,
		SUBSTRING(product.product_desc,1,50) AS product_desc,
		DATE(product.product_date) AS product_date,
		product.product_status,
		product.product_total_products,
		product.product_remain_total_products
		FROM product_type  
		JOIN product ON product_type.id=product.product_type_id
		WHERE product_status='Active' AND  product.id='".$id."' ORDER BY product_type.id ASC";

		
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function setProduct()
	{
		global $objComm, $DB, $lang;
		
	    $PkID = $_REQUEST['pk_id'];

		$this->arrField = $objComm->setTableField();
		$this->arrField["product_remain_total_products"]=$this->arrField["product_total_products"];
		
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
			
			
			if($DB->addNewRecord('product', $this->arrField, ''))
			{
				$_SESSION['product_success'] = "product Added Successfully";
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
		if($DB->query("DELETE FROM product WHERE id='".$id."' LIMIT 1")) { $_SESSION['product_success'] = "product Deleted Successfully"; }
		else { $_SESSION['product_success'] = "Error: Unable to Process"; }
	}
}

?>