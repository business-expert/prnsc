<?php


class invoice
{
	function __construct() 
	{
		
	}
	
	function saveTempInvoice($memberid)
	{
		global $DB;
		
		$objMember = new member();
		
		$InvRow = $this->getInvoice();
		
		if($InvRow->id == '')
		{
			$row 	= $objMember->getMembers($memberid);
					
			$arrData['invoice_no'] = time();
			$arrData['transaction_no'] = '';
			$arrData['member_id'] = $row->id;
			$arrData['member_name'] = $row->fname." ".$row->lname;
			$arrData['member_email'] = $row->email_address;
			$arrData['member_phone_no'] = $row->contact_no;
			$arrData['member_address'] = $row->address." ".$row->region." ".$row->district;
			$arrData['membership_type'] = $row->membership_type;
			$arrData['total_amount'] = $row->amount_paid;
			$arrData['coupon_code'] = '';
			$arrData['coupon_id'] = '0';
			$arrData['discount_amt'] = 0.00;
			$arrData['final_total_amt'] = $row->amount_paid;
			$arrData['payment_date'] = date('Y-m-d H:i:s');
			$arrData['payment_status'] = 'Pending';
			
			$InvoiceID =  $DB->addNewRecord('invoice', $arrData, '');
			
			$_SESSION['register']['invoice_id'] = $InvoiceID;
		}
	}
	
	function getInvoice()
	{
		global $DB;
		
		$SQL = "SELECT * FROM invoice 
					WHERE id='".$_SESSION['register']['invoice_id']."' AND member_id = '".$_SESSION['register']['member_id']."'
						AND payment_status='Pending'";
					
		$row = $DB->fetchOne($SQL);	
		
		return $row;
	}
	
	
	function updateTempInvoice()
	{
		global $DB, $objComm, $lang;

		include_once(MODELS.'/member_model.php');
		include_once(MODELS_ADMIN.'/coupon_model.php');
		
		$objMember = new member();
		$InvRow = $this->getInvoice();
		
		$memberid = $_SESSION['register']['member_id'];
		
		$objCoupon = new coupon();
		$rowCoupon = $objCoupon->getSessionCoupon();
		
		if($InvRow->id > 0 && $rowCoupon->id > 0)
		{
			$row 	= $objMember->getMembers($memberid);
					
			if($rowCoupon->discount_price > 0)
				$discount = $rowCoupon->discount_price;
			else
				$discount = (($row->amount_paid * $rowCoupon->discount_perc) / 100);
						
			$finalAmount = $row->amount_paid - $discount;
			
			$arrData['coupon_code'] = $rowCoupon->coupon_code;
			$arrData['coupon_id'] = $rowCoupon->id;
			$arrData['discount_amt'] = $discount;
			$arrData['final_total_amt'] = $finalAmount;
			$arrData['payment_status'] = 'Pending';
			
			$where = "`id` = '".$InvRow->id."'";
			$DB->updateRecord('invoice', $arrData, $where , '');

			return json_encode(array('discount' => '$'.number_format($discount,2), 'final' => '$'.number_format($finalAmount,2)));
		}
		else
		{
			$_SESSION['member_error'] = "coupon_code_error";		
			$objComm->redirect1("index.php?model=member&action=payment");	
		}
	}
	
	function getDiscount($rowCoupon ,$memberid)
	{
		global $DB;

		include_once(MODELS.'/member_model.php');
		
		$objMember = new member();
		
		$InvRow = $this->getInvoice();

		if($InvRow->id > 0)
		{
			$row 	= $objMember->getMembers($memberid);
				
			if($rowCoupon->discount_price > 0)
				$discount = $rowCoupon->discount_price;
			else
				$discount = (($row->amount_paid * $rowCoupon->discount_perc) / 100);
			
			//$discount = (($row->amount_paid * $rowCoupon->discount) / 100);
			$finalAmount = $row->amount_paid - $discount;
			
			$_SESSION['register']['coupon_code'] = $rowCoupon->coupon_code;
			
			return json_encode(array( 'discount' => '$'.number_format($discount,2), 
									  'final' 	 => '$'.number_format($finalAmount,2),
									  'error'	 =>	'', 
									  'success'  => ' Coupon Discount HKD $'.number_format($discount,2))
							   );
		}
	}
	
	
	function updatePaymentStatus($arrData)
	{
		global $DB, $objComm, $lang;
		
		$InvRow = $this->getInvoice();
		
		//$arrData['payment_status'] = $paymentStatus;
			
		$where = "`id` = '".$InvRow->id."'";
		$DB->updateRecord('invoice', $arrData, $where , '');
	}
	
}

?>