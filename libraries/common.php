<?php

class common
{
	function __construct() 
	{
	}
		
	
	
	
	function fileUploadError()
	{
		$arrUploadError = array(1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
								2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
								3 => "The uploaded file was only partially uploaded",
								4 => "No file was uploaded",
								6 => "Missing a temporary folder"); 

		return $arrUploadError;
	}
	
	
		
	function getAthletesStatus()
	{
		$arrStatus = array(
							'Active' 	=> 'label-success', 
							'Deactive' 	=> 'label-warning',
				  		  );
		
		return $arrStatus;
	}
	
	function getAthletesType()
	{
		global $DB;
		$data=$DB->fetchAll("SELECT * FROM athletic_type");
		$newData=array();
		foreach($data as $datum)
		{
			$newData[$datum->athletic_type_title]=$datum->athletic_type_title;
		}
		return $newData;
	}
	
	
	
	
	function getDefaultAccessModels()
	{
		$arrModel = array("dashboard","login");
		
		return $arrModel;
		
		
	}
	
	
	function GenderList()
	{
		$arrGender = array('M' => 'Male', 'F' => 'Female');
		
		return $arrGender;
	}
	
	function setTableField()
	{
		$arrInputData	=	$_REQUEST;	

		foreach($arrInputData as $key => $value)
		{
			if(substr($key,0,5) == 'data_')
			{
				$key =	substr($key,5);
				$arrField[$key] = $value;
			}	
		}
		
		return $arrField;
	}
	
	
	function redirect($URL)
	{
		$SitePath = SITE_PATH_ADMIN; 

		if (!headers_sent()) 
		{
			header("Location: ".$SitePath."/".$URL);
			exit();
		}
		else 
		{
	        echo '<script type="text/javascript">';
	        echo 'window.location.href="'.$SitePath."/".$URL.'";';
	        echo '</script>';
			die();
		 }
	}
	
	function redirect1($URL)
	{
		$SitePath = SITE_PATH ; 

		if (!headers_sent()) 
		{
			header("Location: ".$SitePath."/".$URL);
			exit();
		}
		else 
		{
	        echo '<script type="text/javascript">';
	        echo 'window.location.href="'.$SitePath."/".$URL.'";';
	        echo '</script>';
			die();
		 }
	}
	
	function getSessionMessage($name)
	{
		$arrMsg = array(	'error' 	=> $name."_error",
							'success' 	=> $name."_success",
							'info' 		=> $name."_info",
							'block' 	=> $name."_block ");
							
		foreach($arrMsg as $key => $value)
		{
			if($_SESSION[$value] != '')
			{
				$messageType = $key;
				break;	
			}
		}

		$msg = $this->getSession($value);
		return $this->getMessage($messageType, $name, $msg);
	}
	
	
	function setSession($session_name,$value)
	{
		$_SESSION[$session_name] = $value;
	}
	

	function getSession($session_name)
	{
		$value = $_SESSION[$session_name];
		
		return $value;
	}
	
	function getMessage($errtype='info', $name, $msg)
	{
		global $lang;
		
		$message = '';
		$arrMsg = array(	'error' 	=> 'alert-error',
							'success' 	=> 'alert-success',
							'info' 		=> 'alert-info',
							'block'		=> 'alert-block');
		
		if($msg != '')
		{
			if($lang[$msg] == '')
				$lang[$msg] = $msg;
				
			$message = '<div class="alert '.$arrMsg[$errtype].'">'.$lang[$msg].'</div>';
		}

		$_SESSION[$name."_".$errtype] = '';
		unset($_SESSION[$name."_".$errtype]);
		
		return $message;
	}
	
	function getYearFromCombo($arrData, $Prefix = 'date_', $suffix = '')
	{
		$Year = $arrData[$Prefix.'year'.$suffix];
		$Month = $arrData[$Prefix.'month'.$suffix];
		$Date = $arrData[$Prefix.'date'.$suffix];
		
		return $Year."-".$Month."-".$Date;
	}
	
	
	function getAllUserRole()
	{
		global $DB;
		
		$SQL = "SELECT * FROM user_role";	
		$row = $DB->fetchAll($SQL);
		
		return $row;
	}
	
	function getUserRole($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM user_role where id='$id'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	function getModuleProperty($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM module_access_property WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		$arrRow = array($row->access_1, $row->access_2, $row->access_3, $row->access_4, $row->access_5,$row->access_6);
		
		return $arrRow;
	}
	
	function getModulePropertyDetails($modulename)
	{
		global $DB;
		
		$modulename = ucfirst(strtolower($modulename));
		
		$SQL = "SELECT * FROM module_access_property WHERE module_name='".$modulename."'";
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	function checkAccessModule($model, $action)
	{
		$arrDefaultModel = $this->getDefaultAccessModels();
		
		$action = ($action == '') ? 'list' : strtolower($action) ;
		
		$_SESSION['ai_access'] = 'N';	

		if($_SESSION['admin']['ai_role']->id > 0)
		{
			$arrModule = $_SESSION['admin']['ai_access'][strtolower($model)];
			
			if(!in_array($model,$arrDefaultModel))
			{
				if(in_array($action, $arrModule))
					$_SESSION['ai_access'] = 'Y';	
				else
					$_SESSION['ai_access'] = 'N';	
			}
			else
				$_SESSION['ai_access'] = 'Y';	
		}
		
		if($model == '')
			$_SESSION['ai_access'] = 'Y';	
		
		# for admin user
		if($_SESSION['admin']['ai_role']->id == 1)
			$_SESSION['ai_access'] = 'Y';	

	}
	
	function redirectFromUnauthorizePage()
	{

		if($_SESSION['ai_access'] == 'N' && $_SESSION['admin']['ai_role']->id > 0)
		{
			 include_once(VIEWS. "/error/denied.php");
		}
	}
	
	function generateRandomString($length = 10) 
	{
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
		
	    for ($i = 0; $i < $length; $i++) 
		{
        	$randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
    	
		return $randomString;
	}	
	
	
	
	function checkSiteSession()
	{
		if($_SESSION['site']['ai_user'] == '')
		{
			$this->redirect1("index.php");	
		}
	}
	
	
	
	function validateDate($date)
	{
		$newDate = date("Y-n-j", strtotime($date));
				
		if($newDate != $date)
			return false;
		else
			return true;
	}
	
	function CompareDate($startDate, $endDate, $compareType)
	{
		$result = false;
		
		if($this->validateDate($startDate) && $this->validateDate($endDate))
		{
			$startDate = strtotime($startDate);
			$endDate   = strtotime($endDate);

			switch($compareType)
			{
				case '=':
				case '==':
							$result = ($startDate == $endDate) ? true : false;
							break;	
				
				case '<':
							$result = ($startDate < $endDate) ? true : false;
							break;	
				
				case '>':
							$result = ($startDate > $endDate) ? true : false;
							break;	
				
				case '<=':
							$result = ($startDate <= $endDate) ? true : false;
							break;	

				case '>=':
							$result = ($startDate = $endDate) ? true : false;
							break;	
			}
		}
		
		return $result;
	}
	

	
	function makeInvoicePDF($data)
	{
		$fileName="invoice_".time(); //PRODUCT_LIST
		$HTMLFileName="paymentInvoice.html";
		$PDFFileName=$fileName.".pdf";
		
		$contents = '';
		$totalAmount=0;
		foreach($data as $datum)
		{
			$totalAmount += (float)$datum->porder_product_paid_amount;
			//$datum["pi_invoice_number"];
			$contents .= '<tr>
			<td align="center" style="width: 40%;"> 
				Item Name: '.$datum->porder_product_name.'<br />
				Item Price: '.$datum->porder_product_price.'<br />
				Item QTY: '.$datum->porder_product_qty.'<br />
			</td>
			<td align="center" style="width: 30%;"> 
					&nbsp;
			</td>
			<td align="center" style="width: 30%;"> 
				'.$datum->porder_product_paid_amount.'
			</td>
		   </tr>';		   
		   
			$contents .= '<tr>
				<td colspan="3" style="width: 100%;">
				<div style="height: 1px; background-color: #000;"></div>
				</td>
			</tr>';
			
			
		}
		$contents .= '<tr>
			<td align="center" style="width: 40%;"></td>
			<td align="right" style="width: 30%;">TOTAL</td>
			<td align="center" style="width: 30%;">$'.$totalAmount.'</td>
		</tr>';
		
		$pdfContents=file_get_contents(DOCUMENT_ROOT_ADMIN.'/helpers/pdf/'.$HTMLFileName);
		$pdfContents=str_replace("{CUSTOMER_NAME}",$datum->pi_purchaser_name,$pdfContents);
		$pdfContents=str_replace("{TRANSACTION_NUMBER}",$datum->pi_transaction_id,$pdfContents);
		$pdfContents=str_replace("{INVOICE_DATE}",$datum->pi_date,$pdfContents);
		$pdfContents=str_replace("{INVOICE_NUMBER}",$datum->pi_invoice_number,$pdfContents);
		$pdfContents=str_replace("{PRODUCT_LIST}",$contents,$pdfContents);
		$pdfContents=str_replace("{IMAGES}",IMAGES,$pdfContents);
		
		require_once(DOCUMENT_ROOT.'/libraries/html2pdf.class.php');
		try
		{
			$html2pdf = new HTML2PDF('P', 'A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->writeHTML($pdfContents, isset($_GET['vuehtml']));
			$html2pdf->Output(INVOICE_PATH."".$PDFFileName,'F');
			return $PDFFileName;
		}
		catch(HTML2PDF_exception $e) {
			echo $e;
			exit;
		}	

	}
	
	function downloadFile($DocumentName, $DocumentPath)
	{
		$DocumentPath = $DocumentPath;
		$DocumentName = str_replace(" ","_",$DocumentName);
		
		$FileMimeType = array( "pdf" => "application/pdf",
							   "txt" => "text/plain",
							   "html" => "text/html",
							   "htm" => "text/html",
							   "exe" => "application/octet-stream",
							   "zip" => "application/zip",
							   "doc" => "application/msword",
							   "xls" => "application/vnd.ms-excel",
							   "csv" => "text/csv",
							   "ppt" => "application/vnd.ms-powerpoint",
							   "gif" => "image/gif",
							   "png" => "image/png",
							   "jpeg"=> "image/jpg",
							   "jpg" =>  "image/jpg",
							   "php" => "text/plain"
							  );
		
	    $FileExt = strtolower(substr(strrchr($DocumentPath,"."),1));
		
	    $MimeType = (array_key_exists($FileExt, $FileMimeType)) ? $FileMimeType[$FileExt] : "application/force-download";
		
		//turn off output buffering to decrease cpu usage
		@ob_end_clean();
		
		// required for IE Only
		if(ini_get('zlib.output_compression'))
		ini_set('zlib.output_compression', 'Off');
			
		if (file_exists($DocumentPath)) 
		{
			header('Content-Description: File Transfer');
			header('Content-Type: '.$MimeType);
			header('Content-Disposition: attachment; filename='.$DocumentName);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($DocumentPath));
			ob_clean();
			flush();
			readfile($DocumentPath);
			exit;
		}	
	}
	
	
	
	function getHTMLField($TableName, $data='')
	{
		global $DB,$objHTML;
		
		$Query = 'DESCRIBE '.$TableName;
		$Row   = $DB->fetchAll($Query);
		
		$field = $objHTML->makeHTMLField($Row, $data);
		
		return $field;
	}
	
	function uploadfile($destination, $files)
	{
		global $objLog;
		
		$msg = '';
		
		$arrUploadError = $this->fileUploadError();
		$arrRestrictType = explode(",",RESTRICT_UPLOAD_FILE);
		
		$filename    = time().substr($files['name'],-4);
		$filesize    = $files['size'];
	
		#$objLog->writeLog(__LINE__, __FILE__, 'Upload File Details: FileName :'.$filename.' Destination:'.$destination, 'Upload Common');
		
		chmod($destination, 0777);
		
		exec("chmod 0777 -R ".$destination."/");
		
		if($filename != '' && $filesize > 0)
		{
			if(!in_array($files['type'],$arrRestrictType))
			{
				if(file_exists($destination/$filename))
				{
					$filename = substr(time(),0,2).$filename;
					#$objLog->writeLog(__LINE__, __FILE__, 'Upload File Details: File Exists New FileName :'.$filename.' Destination:'.$destination, 'Upload Common');
				}
				
				if(is_writable($destination))
				{
					if(move_uploaded_file($files['tmp_name'], $destination."/".$filename))
					{
						#$objLog->writeLog(__LINE__, __FILE__, 'Upload File Details: File Uploded at:'.$destination1."/".$filename, 'Upload Common');
						$msg = '';
						exec("chmod 0777 ".$destination."/".$filename);
					}
					else
					{
						$msg = 'File Upload Failed';	
					}
				}
				else
				{
					$msg = 'Upload Folder is not writable';	
				}
			}
			else
			{
				$msg = 'File extention is restrict to upload file';
			}
		}
		else
		{
			$msg = $arrUploadError[$files['error']];
		}
		
		#$objLog->writeLog(__LINE__, __FILE__, 'Upload File Details: File Permission Changed ', 'Upload Common');
		
		chmod($destination."/".$filename, 0777);
		exec("chmod 0777 ".$destination."/".$filename." -R");
		
		return array("filename" => $filename, "filepath" => $destination."/".$filename, "error" => $msg);
	}

	public function currentUserType()
	{
		return $_SESSION['site']['ai_user_type'];
	}

	
	
	
	function generateRandomSeries($preAppend) 
	{
		return ($preAppend."".strtotime(date("Y-m-d H:i:s"))."".rand(1,10000));
    	
	}	
	
	
	
	function dataImplode($data,$seperator="#",$default="")
	{
		if(count($data)>0){ return implode($seperator,$data); } else{ return $default; }
	}
	
	function dataExplode($seperator="#",$data,$default="")
	{
		if(count($data)>0){ return explode($seperator,$data); } else{ return $default; }
	}
	
	function isRecordExist($SQL)
	{
		global $DB;
		return ($DB->totRecord($SQL, '')>0) ? true : false;
	}
	
	function setDyamicSettingSession()
	{
		global $DB;
		$data=$DB->fetchAll("SELECT * FROM dynamic_setting","");
		foreach($data as $datum)
		{
			$_SESSION["DS"][$datum->ds_code]=$datum->ds_data; 	
		}
	}
	function trashData($tb,$col,$val,$trash_type="DELETED")
	{
		global $DB;
		$SQL="SELECT * FROM ".$tb." WHERE ".$col."='".$val."'";
		$RS=$DB->query($SQL,"");
		$trashData=array();
		while($datum=mysql_fetch_array($RS,MYSQL_ASSOC))
		{
			$trashData[] = mysql_real_escape_string($datum);
		}
		$trash_date=date("Y-m-d H:i:s");
		$trash_data=json_encode($trashData);
		$SQL="INSERT INTO trash_data(`trash_id`,`trash_table`,`trash_data`,`trash_type`,`trash_date`) VALUES('$val','$tb','$trash_data','$trash_type','$trash_date')";
		$DB->query($SQL,"");
	}
	
	########### Function to delete file ####################
	function deleteFile($fileName,$prePath=FILE_UPLOAD_PATH)
	{
		global $DB;
		if(is_array($fileName))
		{
			$datum=$DB->fetchOne($fileName["SQL"],"");
			$fileName=$datum->$fileName["fieldName"];
		}
		if(file_exists($fileName)){ unlink($fileName);}
	}

	function saveFBProfile()
	{
		global $FBPanel,$DB;
		$userProfile=$FBPanel->panelGetUserProfileInfo();
		//var_export($userProfile);
		$isDuplicate=$this->isRecordExist("SELECT fb_id FROM facebook WHERE facebook.fb_id='".$userProfile['id']."'");
		if($isDuplicate) 
		{ 
			$DB->query("UPDATE facebook SET fb_visit_count=fb_visit_count+1 WHERE facebook.fb_id='".$userProfile['id']."'","");
		}
		else
		{
			$insertArray["fb_id"]=$userProfile["id"];
			$insertArray["fb_username"]=$userProfile["username"];
			$insertArray["fb_name"]=$userProfile["name"];	
			$insertArray["fb_email"]=$userProfile["email"];
			$insertArray["fb_picture"]=$userProfile["picture"];
			$insertArray["fb_location"]=$userProfile["location"];
			$insertArray["fb_bio"]=$userProfile["description"];
			$insertArray["fb_friendlists"]=json_encode($userProfile["friendlists"]);
			$insertArray["fb_date"]=date("Y-m-d H:i:s");
			$DB->addNewRecord("facebook",$insertArray,"");
		}
	}
	
##START function to set points user on the based of picks position #####
	function userPickPoints($race_id)
	{
		global $DB;	
		$DB->query("TRUNCATE TABLE temppicksplacement");	
		$SQL="INSERT INTO temppicksplacement (SELECT race_picks.* FROM race_placement JOIN race_picks ON 
		race_picks.race_id=race_placement.race_id
		AND race_picks.athelete_id=race_placement.athelete_id
		AND race_picks.position=race_placement.position AND race_placement.race_id='".$race_id."' ORDER BY race_picks.fan_id, race_placement.position)";
		$RS=mysql_query($SQL);
		
		$allFans=array(); #All Fans
		$currentData=array(); #Current Data array
		$data=$DB->fetchAll("SELECT * FROM temppicksplacement");	
		
		$dataRTP=$DB->fetchOne("SELECT rtp_race_type_points FROM race_type_points JOIN race ON race.race_type=race_type_points.rtp_race_type_id WHERE race.id='".$race_id."'","");
		$defaultPointsArray=explode(';',$dataRTP->rtp_race_type_points);
		$maxPosition=count($defaultPointsArray);
		
		foreach($data as $datum)
		{
			array_push($allFans,$datum->fan_id);
			$currentData[]=$datum;
		}
		
		$uniqueFans=array_unique($allFans); #unique FANS	
		#One FAN at one time
		$combPicks=array();
		$singlePicks=array();
		$pick=0;
		
		foreach($uniqueFans as $fan)
		{
			$combPicks[$fan]=array(0=>array(),1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array(),);
			$singlePicks[$fan]=array();
			$data=$DB->fetchAll("SELECT * FROM temppicksplacement WHERE fan_id='".$fan."'");
			foreach($data as $key=>$datum)
			{
				$prePos=$data[$key-1]->position;
				$curPos=$data[$key]->position;
				$nextPos=$data[$key+1]->position;
				
				//echo $curPos."<br />";
				if((($curPos+1)==$nextPos) && !$prePos || ($prePos == ($curPos-1)) && $prePos)
				{
					array_push($combPicks[$fan][$pick],$curPos);
					//print_r($combPicks[$fan][$pick]); echo "<br />";
				}
				else
				{
					$pick=$pick+1;
					$combPicks[$fan][$pick]=array();	
					array_push($singlePicks[$fan],$curPos);	
					//print_r($singlePicks[$fan]);					
				}
			}
			
		}		
			foreach($uniqueFans as $fan)
			{
				$gainPoints=0;
				
				foreach($combPicks[$fan] as $key=>$datum)
				{
					if(count($datum))
					{
						$gainPointsArray=explode("#",$defaultPointsArray[count($datum)-1]);	 
						$gainPoints = $gainPoints + $gainPointsArray[1];
					}
				}
				if(count($singlePicks[$fan]))
				{	
					$gainPointsArray=explode("#",$defaultPointsArray[0]);	 
					for($i=1; $i<= count($singlePicks[$fan]); $i++)
					{	
						$gainPoints = $gainPoints + $gainPointsArray[1];
					}
					
				}				
				$rpp_date=date("Y-m-d H:i:s");
				$insertRacePicksPoints=array
				(
					"rpp_fan_id"=>$fan,
					"rpp_race_id"=>$race_id,
					"rpp_points"=>$gainPoints,
					"rpp_date"=>$rpp_date
				);
			$response=$DB->addNewRecord("race_picks_points",$insertRacePicksPoints,"");
			$gainPointsArray[$fan]=$gainPoints;
			}
			return $gainPointsArray;
}
##END function to set points user on the based of picks position #####

###START function to check Whether an URL location is exists or not ##
function isLocationExist($URL)
{
	$HEADERS = @get_headers($URL);
	if(strpos($HEADERS[0],'200')===false) { return false; } else { return true; }
	/*
	function url_exists($url) 
	{
    if (!$fp = curl_init($url)) return false;
    return true;
	}
	*/
}
###END function to check Whether an URL location is exists or not ##

#### START function to make a date duration in string format ########
function dateDucationFormat1($startDate,$endDate)
{
	$startTimeStamp=array();
	$startDateTimeStamp=strtotime($startDate);
	$startTimeStamp["SMonth"]=date("F",$startDateTimeStamp);
	$startTimeStamp["STHDay"]=date("jS",$startDateTimeStamp);
	$startTimeStamp["SDay"]= "(".date("D",$startDateTimeStamp).")";
	$startTimeStamp["Syear"]=date("Y",$startDateTimeStamp);
	
	$endTimeStamp=array();
	$endDateTimeStamp=strtotime($endDate);		
	$endTimeStamp["EMonth"]=date("F",$endDateTimeStamp);
	$endTimeStamp["ETHDay"]=date("jS",$endDateTimeStamp);
	$endTimeStamp["EDay"]= "(".date("D",$endDateTimeStamp).")";
	$endTimeStamp["Eyear"]=date("Y",$endDateTimeStamp);
	
	return array("startTimeStamp"=>$startTimeStamp,"endTimeStamp"=>$endTimeStamp);
}
#### START function to make a date duration in string format ########

function generateOrderInvoice()
{
	#porder_id	porder_product_id	porder_purchaser_id	porder_name	porder_qty		
	#porder_price	porder_discount	porder_tax	porder_paid_amount	porder_date

	global $FBPanel,$DB;
	if($data)
	{
		$userProfile=$FBPanel->panelGetUserProfileInfo();
		$insertArray["fb_id"]=$userProfile["id"];
		$insertArray["fb_username"]=$userProfile["username"];
		$insertArray["fb_name"]=$userProfile["name"];	
		$insertArray["fb_email"]=$userProfile["email"];
		$insertArray["fb_picture"]=$userProfile["picture"];
		$insertArray["fb_location"]=$userProfile["location"];
		$insertArray["fb_bio"]=$userProfile["description"];
		$insertArray["fb_friendlists"]=json_encode($userProfile["friendlists"]);
		$insertArray["fb_date"]=date("Y-m-d H:i:s");
		$DB->addNewRecord("facebook",$insertArray,"");
	}
}


### START function to remove leading and trailing new lines as well as spaces #####
function removeLeadingTrailingNewLinesSpaces($data)
{
	return trim(preg_replace('/^[\r\n]+|\.|[\r\n]+$/', '', $data));
}
### END function to remove leading and trailing new lines as well as spaces #####

}

?>