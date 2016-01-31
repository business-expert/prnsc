<?php
	include_once(dirname(__FILE__).'/bootstrap.php');

	if(isset($_REQUEST["txn_id"])) 
	{ 
		if($_REQUEST["payment_status"]=="Completed")
		{
		
				$pi_id=$_SESSION["porder_pi_id"];				
				
				$updateData=array(
						"pi_transaction_id"=>$_REQUEST["txn_id"],
						"pi_invoice_file"=>$pi_invoice_file,
						"pi_status"=>"Active",
				);	
				$update=$DB->updateRecord("product_invoice",$updateData,"pi_id='".$pi_id."'","");
			
				$insertData=array(
				"pstatus_pi_id"=>$pi_id,
				"pstatus_status"=>"INVOICE",
				"pstatus_invoice_date"=>date("Y-m-d H:i:s")				
				);			
				$DB->addNewRecord("product_status",$insertData,"");
				
				$SQL="SELECT * FROM product_invoice LEFT JOIN product_order ON product_invoice.pi_id=product_order.porder_pi_id WHERE product_invoice.pi_id='".$pi_id."'";
				$data=$DB->fetchAll($SQL,"");
				$pi_invoice_file=$objComm->makeInvoicePDF($data);

				$updateData=array(
							"pi_invoice_file"=>$pi_invoice_file
				);	
				$update=$DB->updateRecord("product_invoice",$updateData,"pi_id='".$pi_id."'","");			
				
				
				$_SESSION["payment_status"]="success";
				header("Location: ".SITE_PATH);
				
			}
			else
			{
				header("Location: ".SITE_PATH);
				$_SESSION["payment_status"]="failed";
			}
		}
		else
		{
			header("Location: ".SITE_PATH);
			$_SESSION["payment_status"]="failed";
		}

?>