<?php


class members
{
	function __construct() 
	{
		
	}
	
	function getAllMembers()
	{
		global $DB, $objComm;
		
		$arrRegion = $objComm->getAllRegion();
		$arrDistrict = $objComm->getAllDistrict();
		
		$arrRegion = array_flip($arrRegion);
		$arrDistrict = array_flip($arrDistrict);		
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 	= $_POST['sr_name'];
		$srAddress 	= $_POST['sr_address'];
		$srPhone 	= $_POST['sr_phone_no'];
		$srEmail 	= $_POST['sr_email'];
		$srAge 		= $_POST['sr_age'];
		$srStatus 	= $_POST['sr_status'];
		$srMembership 	= $_POST['sr_membership_type'];
		$srMembershipID	= $_POST['sr_membership_id'];
		
		if($srName != '')		$arrWhere[] = " (A.`fname` like '%".$srName."%' OR A.`lname` like '%".$srName."%')";
		if($srAddress != '')	$arrWhere[] = " (A.`address` like '%".$srAddress."%' OR 
												 A.`region` = '".$arrRegion[$srAddress]."' OR 
												 A.`district` = '".$arrDistrict[$srAddress]."')";
		if($srPhone != '')		$arrWhere[] = "A.`contact_no` like '%".$srPhone."%'";
		if($srEmail != '')		$arrWhere[] = "A.`email_address` like '%".$srEmail."%'";
		if($srAge != '')		$arrWhere[] = "TIMESTAMPDIFF(YEAR,A.`birth_date`,NOW()) ".$_REQUEST['sr_age_compare']." ".$srAge."";
		if($srStatus != '')		$arrWhere[] = "A.`status` like '%".$srStatus."%'";
		if($srMembership != '')	$arrWhere[] = "B.`membership_type` like '%".$srMembership."%'";
		if($srMembershipID != '') $arrWhere[] = "A.`membership_id`='".$srMembershipID."'";
		
		$SQL = "SELECT A.*,B.invoice_no,B.payment_status,B.membership_type, B.id as invoice_id,
				  TIMESTAMPDIFF(YEAR,A.`birth_date`,NOW()) as age 
				  FROM members as A
					LEFT JOIN invoice as B ON B.member_id = A.id";	
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
		if($Where != '')	
			$SQL .=  $Where;
		
		$SQL .=  " ORDER BY A.`created_datetime` DESC";
		//echo $SQL;
		$Records = $DB->fetchAll($SQL);
		
		return $Records;
	}
	
	
	function checkUniqueEmail($id, $email)
	{
		global $DB;
		
		$arrWhere[] = "`email_address` = '".$email."'";
		
		if($id > 0)		$arrWhere[] = "`id` != '".$id."'";
		
		$SQL = "SELECT * FROM members";
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
		if($Where != '')	
			$SQL .=  $Where;
			
		$row = $DB->fetchOne($SQL);
		
		return $row->id;
		
	}
	
	function getMembers($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM members WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function setMembers()
	{
		global $objComm, $DB, $lang;
		
		$PkID = $_REQUEST['pk_id'];
		
		$birthday = $objComm->getYearFromCombo($_REQUEST, 'date_');
		$Income = $_REQUEST['txt_income_from']."-".$_REQUEST['txt_income_to'];

		$this->arrField = $objComm->setTableField();
		$this->arrField['birth_date'] = $birthday;
		$this->arrField['income'] = $Income;
		
		$this->setExtraApplicationField();

		$response = $this->checkUniqueEmail($PkID,$this->arrField['email_address']);
			
		if($response > 0)
		{
			$_SESSION['members_error'] = $lang['email_exists'];
			return ;	
		}
				
		if($PkID > 0)
		{
			$this->setMemberChild($PkID);

			$_SESSION['members_success'] = $lang["member_update"];
		
			$where = "`id` = '".$PkID."'";
			
			$oldEmail = $_REQUEST['hid_email'];
			$newEmail = $this->arrField['email_address'];
			
			if($oldEmail != $newEmail)
				$this->sendEmailChangeMail($oldEmail);
		
			return $DB->updateRecord('members', $this->arrField, $where , '');
		}
		else
		{
			$this->checkUniqueEmail('',$this->arrField['email_address']);
			
			$_SESSION['members_success'] = $lang["member_added"];		
		
			$memeberid =  $DB->addNewRecord('members', $this->arrField, '');
			
			$this->createActivationURL($memeberid);
			
			$this->setMemberChild($memeberid);
		}
	}
	
	
	public function createActivationURL($PkID)
	{
		global $objComm, $DB;
		
		$RandomString = $objComm->generateRandomString(20);
		
		$arrData['activation'] = $RandomString;
		
		$where = "`id` = '".$PkID."'";
		$DB->updateRecord('members', $arrData, $where , '');

		#------------ EMAIL FOR VERIFICATION ------------#
		$this->sendmail($this->arrField['email_address'], $RandomString);
			
	}

	public function sendmail($to , $RandomString)
	{
		//$to 	 = 'rakesh.r.singh@hotmail.com';
		$subject = 'AI Club - verify your account';
		
		$arrData['{FIRST_NAME}'] = $this->arrField['fname'];
		$arrData['{URL}'] 		 = SITE_PATH."/verification.php?code=".$RandomString;		
		
		$objEmail = new email();
		
		$EmailBody = $objEmail->emailTemplate('member_register',$arrData);	
		
		$objEmail->sendmail($to,$subject,$EmailBody);		
	}
			
	public function sendEmailChangeMail($newEmail)
	{
		$to 	 = $newEmail;
		$subject = 'AI Club - Email Changed';
		
		$arrData['{FIRST_NAME}'] = $this->arrField['fname'];
		$arrData['{EMAIL}'] = $newEmail;
		
		$objEmail = new email();
		
		$EmailBody = $objEmail->emailTemplate('member_email_changed',$arrData);	
		
		$objEmail->sendmail($to,$subject,$EmailBody);	
		
		$this->sendEmailChangeMailAdmin($newEmail);
	}
	
	
	public function sendEmailChangeMailAdmin($newEmail)
	{
		$to 	 = ADMIN_EMAIL;
		$subject = 'AI Club - Email Changed';
		
		$arrData['{EMAIL}'] = $newEmail;
		
		$objEmail = new email();
		
		$EmailBody = $objEmail->emailTemplate('member_email_changed_admin',$arrData);	
		
		$objEmail->sendmail($to,$subject,$EmailBody);		
	}
		
	
	function updateMembershipID($PkID)
	{
		global $DB;
		
		$arrUpdateField['membership_id'] = $PkID.rand(1000,9999);
		$where = "`id` = '".$PkID."'";
		$DB->updateRecord('members', $arrUpdateField, $where , '');
	}
	
	
	function setMemberChild($PkID)
	{
		global $objComm,$DB;
		
		foreach($_REQUEST as $key => $value)
		{
			if(is_array($value))
			{
				if(substr($key,0,6) == 'child_')
				{
					$arrPost[substr($key,6)] = $value;
				}
			}
		}
		
		$this->delMembersChildren($PkID);
		
		foreach($arrPost['name'] as $key => $value)
		{
			$name   = $arrPost['name'][$key];
			$gender = $arrPost['gender'][$key];
			$date   = $arrPost['date_year'][$key]."-".$arrPost['date_month'][$key]."-".$arrPost['date_date'][$key];
			
			if($name != '')
			{
				$arrInsert['member_id'] = $PkID;
				$arrInsert['name'] = $name;
				$arrInsert['gender'] = $gender;
				$arrInsert['birth_date'] = date("Y-m-d",strtotime($date));
			}
			
			if(count($arrInsert) > 0)
			{
				$DB->addNewRecord('members_children', $arrInsert, '');
				
				$arrInsert = array();
			}
		}
	}
	
	
	function delMembersChildren($memeberid)
	{
		global $DB;
		
		$SQL = "DELETE FROM members_children WHERE member_id='".$memeberid."'";
		$DB->query($SQL);	
	}
	
	
	public function setExtraApplicationField($action = '')
	{
		$action = ($action == "") ? $_REQUEST['action'] : $action;
		
		if(strtoupper($action) == 'SAVE')
		{
			$this->arrField['created_by']		= $_SESSION['admin']['ai_user'];
			$this->arrField['created_datetime']	= date("Y-m-d 00:00:00");
		}
	
		if(strtoupper($action) == 'UPDATE')
		{
			$this->arrField['updated_by']		= $_SESSION['admin']['ai_user'];
			$this->arrField['updated_datetime']	= date("Y-m-d 00:00:00");
		}	
	}
	
	
	function delMembers($id)
	{
		global $DB, $lang;
		
		$_SESSION['members_success'] = $lang['member_deleted'];
		
		$SQL = "DELETE FROM members WHERE id='".$id."' LIMIT 1";
		$DB->query($SQL);	
		
		$this->delMembersChildren($id);
	}
	

	function getMemberChildDetails($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM members_children WHERE member_id='".$id."'";	
		$row = $DB->fetchAll($SQL);
		
		return $row;
	}
}
?>