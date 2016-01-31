<?php

class Invoice
{
	function __construct() 
	{
		
	}
	
	function getAllinvoice()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$sr_pstatus_status 	= $_POST['sr_pstatus_status'];

		if($sr_pstatus_status != '')	$arrWhere[] = "product_status.pstatus_status='".$sr_pstatus_status."'";
		//JOIN  product_status ON product_status.pstatus_pi_id=product_invoice.pi_id
		$SQL="SELECT 
		product_invoice.pi_id,
		product_invoice.pi_invoice_number,
		product_invoice.pi_purchaser_name,
		product_invoice.pi_invoice_file,
		SUM(product_order.porder_product_qty) AS porder_product_qty,
		SUM(product_order.porder_product_paid_amount) AS porder_product_paid_amount,
		product_status.pstatus_invoice_date,
		product_status.pstatus_status
		FROM product_invoice 
		JOIN product_order ON product_invoice.pi_id=product_order.porder_pi_id 
		JOIN product_status ON product_status.pstatus_pi_id=product_invoice.pi_id 
		WHERE product_invoice.pi_status='Active'";
		
		if(count($arrWhere) > 0){ $Where = " AND ".$arrWhere[0]; } 
		if($Where != ''){ $SQL .=  $Where; } 
		$SQL .= "GROUP BY product_invoice.pi_id";
		
		return $DB->fetchAll($SQL);
	}
	
	
	function getInovoice($pi_id)
	{
		global $DB;
		$SQL="SELECT * FROM product_invoice LEFT JOIN product_order ON product_invoice.pi_id=product_order.porder_pi_id JOIN product_status ON product_status.pstatus_pi_id=product_invoice.pi_id WHERE product_invoice.pi_id='".$pi_id."'";
		return $DB->fetchAll($SQL);
	}
	
	
	function updateInvoice()
	{
		global $objComm, $DB;
		
	    $PkID = $_REQUEST['pk_id'];

		
		$pstatus_status=$_REQUEST["pstatus_status"];
		$currentData=date("Y-m-d H:i:s");
		switch($pstatus_status)	
		{
			case "INVOICE":
				$insertData=array("pstatus_status"=>"INVOICE","pstatus_invoice_date"=>$currentData);
			break;
			
			case "DISPATCH":
				$insertData=array("pstatus_status"=>"DISPATCH","pstatus_dispatch_date"=>$currentData);
			break;
			
			case "RECEIVE":
				$insertData=array("pstatus_status"=>"RECEIVE","pstatus_receive_date"=>$currentData);
			break;
		}
		$response=$DB->updateRecord("product_status", $insertData, "product_status.pstatus_pi_id='".$_REQUEST["pi_id"]."'", "");
	
			if($response)
			{				
				$_SESSION['invoice_success'] = "invoice Update Successfully";
			}
			else
			{
				$_SESSION['invoice_error'] = "Error: Unable to Process";
			}
	}
	
	
}

?>