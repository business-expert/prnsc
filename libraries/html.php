<?php


class html extends common
{
	function __construct() 
	{
		
	}
	
	function statusBasicCombo($id,$selVal, $extra='')
	{
		$arrStatus = $this->getAllStatus();

		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> -- Select -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$key."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
		
	}
	
	function activeBasicCombo($id,$selVal, $extra='')
	{
		$arrStatus = array("Yes"=>"Yes","No"=>"No");

		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> -- Select -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$key."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
		
	}
	
	
	function getAllStatus()
	{
		return array("Active"=>"Active","Deactive"=>"Deactive");	
	}
	
	function statusBasicCombo1($id,$selVal, $extra)
	{
		global $lang; 
		
		$arrStatus = $this->getBasicStatus();

		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	
	function seasonBasicCombo($id,$selVal, $extra)
	{
		$arrStatus = $this->allSeason();

		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> -- SELECT SEASON -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$value."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function allSeason()
	{
		global $DB;
		$RS=$DB->query("SELECT id, season_title FROM season WHERE season_status='Active'","");
		$allSeason=array();
		while($datam=mysql_fetch_object($RS))
		{
			$allSeason[$datam->id]=$datam->season_title;
		}
		return $allSeason;
	}
	
	
	function eventTypeCombo($id,$selVal, $extra,$label="Please Select")
	{
		global $DB;
		$RS=$DB->query("SELECT id, name FROM event WHERE active='Yes'","");
		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> -- ".strtoupper($label)." -- </option>";
		while($datam=mysql_fetch_object($RS))
		{
			$allData[$datam->id]=$datam->name;
			$selected = (strtoupper($selVal) == strtoupper($datam->id)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$datam->id."' ".$selected.">".$datam->name."</option>";
		}
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	
	function productTypeCombo($name,$selVal, $extra,$label="Please Select")
	{
		global $DB;
		$data=$DB->fetchAll("SELECT id, product_type FROM product_type WHERE product_type_status='Active'","");
		$select = "<select id='".$name."' name='".$name."' $extra>";	
		$arrOption[] = "<option value=''> -- ".strtoupper($label)." -- </option>";
		foreach($data as $datum)
		{
			$selected = (strtoupper($selVal) == strtoupper($datum->id)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$datum->id."' ".$selected.">".$datum->product_type."</option>";
		}
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function raceTypeCombo($id,$selVal, $extra, $label="Please Select")
	{
		global $DB;
		$RS=$DB->query("SELECT id, race_title FROM race_type","");
		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> -- ".strtoupper($label)." -- </option>";
		while($datam=mysql_fetch_object($RS))
		{
			$allData[$datam->id]=$datam->name;
			$selected = (strtoupper($selVal) == strtoupper($datam->id)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$datam->id."' ".$selected.">".$datam->race_title."</option>";
		}
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	
	function generateCustomCombo($data,$name,$selVal,$extra,$label="Please Select")
	{
		$select = "<select id='".$name."' name='".$name."' $extra>";	
		$arrOption[] = "<option value=''> -- ".$label." -- </option>";
		foreach($data as $key=>$val)
		{
			$allData[$datam->id]=$datam->name;
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$val."</option>";
		}
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	
	
	#OK
	/*function raceTypeCombo($id,$selVal, $extra, $label="Please Select")
	{
		global $DB;
		$RS=$DB->query("SELECT id, race_title FROM race_type","");
		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> -- ".strtoupper($label)." -- </option>";
		while($datam=mysql_fetch_object($RS))
		{
			$allData[$datam->id]=$datam->name;
			$selected = (strtoupper($selVal) == strtoupper($datam->id)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$datam->id."' ".$selected.">".$datam->race_title."</option>";
		}
		return $select.implode(" ", $arrOption)."</select>";
	}*/
	
	##################Function to generate race Combo####################
	function raceCombo($name,$selVal, $extra="",$label="Please Select")
	{
		global $DB;	
		$data=$DB->fetchAll("SELECT id,race_title FROM race","");
		$select = "<select id='".$name."' name='".$name."' $extra>";	
		$arrOption[] = "<option value=''> -- ".strtoupper($label)." -- </option>";
		if(count($data)>0)
		{	
			foreach($data as $datum)
			{
				$selected = (strtoupper($selVal) == strtoupper($datum->id)) ? "selected='selected'" : "" ;		
				$arrOption[] = "<option value='".$datum->id."' ".$selected.">".$datum->race_title."</option>";
			}
			
		}
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function athleticsMultiSelect($name,$selectedArray,$extra,$label="Please Select")
	{
		global $DB;	
		$data=$DB->fetchAll("SELECT id,name FROM athlete","");
		
		$select = "<select id='".$name."' name='".$name."[]' multiple='multiple'  $extra>";	
		if(count($data)>0)
		{	
			foreach($data as $datum)
			{
				$selected = (in_array($datum->id,$selectedArray)) ? "selected='selected'" : "" ;	
				$arrOption[] = "<option value='".$datum->id."' ".$selected.">".$datum->name."</option>";
			}
			
		}
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	
	function usedUnusedBasicCombo($id,$selVal, $extra='')
	{
		global $lang; 
		
		$arrUsed = array("Used" => "USED", "Unused" => "UNUSED");

		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrUsed as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$value."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
		
	}
	
	
	
	
	function categoryBasicCombo($id,$selVal)
	{
		global $lang; 
		
		$arrStatus = $this->getAllCategory();

		$select = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
		
	}
	
	function searchAgeCombo($id,$selVal)
	{
		$arrComparison = array("<=", ">=");

		$select = "<select  style='width:50px;' id='".$id."' name='".$id."'>";	

		foreach($arrComparison as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($value)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$value."' ".$selected.">".$value."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	
	function basicDateCombo($arrName, $arrID, $arrVal, $extra='')
	{
		global $lang;
		
		if($arrID == '')
			$arrID = $arrName;
			
		if(!is_array($arrVal))
			$arrVal = explode("-",$arrVal);
			
		$selYear = "<select  style='width:70px;' id='".$arrID[0]."' name='".$arrName[0]."' $extra>";
		
		for($i = date('Y'); $i > 1940; $i--)
		{
			$selected = ($arrVal[0] == $i) ? "selected='selected'" : "" ;		
			$arrYearOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Year = $selYear.implode(" ", $arrYearOption)."</select>";
		
		#-------------------------------------------------------------------------------------------#
		
		$arrMonth = array( 1 => "January", 2 => "February", 3 => "March", 4 => "April",  5 => "May", 
						   6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November",12 =>  "December");

		$selMonth = "<select  style='width:100px;' id='".$arrID[1]."' name='".$arrName[1]."' $extra>";
		
		foreach($arrMonth as $key => $value)
		{
			$selected = ((int)$arrVal[1] == $key) ? "selected='selected'" : "" ;		
			$arrMonthOption[] = "<option value='".$key."' ".$selected.">".$lang[$value]."</option>";	
		}	
		
		
		$Month = $selMonth.implode(" ", $arrMonthOption)."</select>";
		
		#-------------------------------------------------------------------------------------------#
		
		$selDate = "<select  style='width:50px;' id='".$arrID[2]."' name='".$arrName[2]."' $extra>";
		
		for($i = 1; $i <= 31; $i++)
		{
			$selected = ($arrVal[2] == $i) ? "selected='selected'" : "" ;		
			$arrDateOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Date = $selDate.implode(" ", $arrDateOption)."</select>";
		
		return $Year."&nbsp;&nbsp;".$Month."&nbsp;&nbsp;".$Date;
	}
	
	
	
	function basicTimeCombo($arrName, $arrID, $arrVal, $extra='')
	{
		global $lang;
		
		if($arrID == '')
			$arrID = $arrName;
			
		if(!is_array($arrVal))
			$arrVal = explode("-",$arrVal);
			
		$selHour = "<select  style='width:70px;' id='".$arrID[0]."' name='".$arrName[0]."' $extra>";
		
		for($i = 0; $i < 24; $i++)
		{
			$selected = ($arrVal[0] == $i) ? "selected='selected'" : "" ;		
			$arrHourOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Hour = $selHour.implode(" ", $arrHourOption)."</select>";
		
		#-------------------------------------------------------------------------------------------#
		
		$selMinute = "<select  style='width:50px;' id='".$arrID[1]."' name='".$arrName[1]."' $extra>";
		
		for($i = 0; $i <= 59; $i++)
		{
			$selected = ($arrVal[1] == $i) ? "selected='selected'" : "" ;		
			$arrMinuteOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Minute = $selMinute.implode(" ", $arrMinuteOption)."</select>";
		
		return $Hour."&nbsp;&nbsp;".$Minute;
	}
	
	function getUserRoleCombo($id,$selval)
	{
		global $lang;
		
		$arrRow = $this->getAllUserRole();
		
		$select      = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> ".$lang['SELECT']." </option>";

		foreach($arrRow as $row)
		{
			$selected = ($selval == $row->id) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$row->id."' ".$selected.">".ucfirst($row->user_type)."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function roleStatusBasicCombo($id,$selVal)
	{
		global $lang;
		
		$arrStatus = $this->getRoleStatus();

		$select = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> --  ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".strtolower($key)."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
		
	}
	
	
	function newsStatusCombo($id, $selVal, $extra='')
	{
		global $lang;
		
		$arrStatus = $this->getNewsStatus();

		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> --  ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".strtolower($key)."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	
	function marrigeCombo($id,$selVal)
	{
		global $lang;
		
		$arrStatus = $this->getMarrageStatus();

		$select = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function educationCombo($id,$selVal)
	{
		global $lang;
		
		$arrStatus = $this->getEducationLevel();

		$select = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function creditCardExpiryCombo($selMonth, $selYear, $extra='')
	{
		global $lang;
			
		$selMonth = "<select style='width:60px;' id='exp_month' name='exp_month' $extra>";
		
		for($i = 1; $i <= 12; $i++)
		{
			$selected = ($selMonth == $i) ? "selected='selected'" : "" ;		
			$arrMonthOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Month = $selMonth.implode(" ", $arrMonthOption)."</select>";
		
		#-----------------------------------------------------------------------#
		
		$selYear = "<select style='width:80px;' id='exp_year' name='exp_year' $extra>";
		
		for($i = date("Y"); $i <= date("Y") + 10; $i++)
		{
			$selected = ($selYear == $i) ? "selected='selected'" : "" ;		
			$arrYearOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Year = $selYear.implode(" ", $arrYearOption)."</select>";
		
		return $Month."&nbsp;&nbsp;".$Year;
	}
	
	function creditCardTypeCombo($selTyle, $extra='')
	{
		global $lang;
		
		$arrCardType = array('Visa','MasterCard','Discover','American Express');			
		
		$selCard = "<select style='width:120px;' id='card_type' name='card_type' $extra>";
		
		foreach($arrCardType as $key => $card)
		{
			$selected = (strtolower($selTyle) == strtolower($card)) ? "selected='selected'" : "" ;		
			$arrCardOption[] = "<option value='".$card."' ".$selected.">".$card."</option>";	
		}	
		
		$Card = $selCard.implode(" ", $arrCardOption)."</select>";
		
		return $Card;
	}
	
	function getRegionSelectBox($id, $selval, $extra='')
	{
		global $lang, $objComm;
		
		$arrRegion = $objComm->getAllRegion();
		
		$selRegion = "<select id='".$id."' name='".$id."' $extra>";
		
		foreach($arrRegion as $key => $region)
		{
			$selected = (strtolower($selval) == strtolower($key)) ? "selected='selected'" : "" ;		
			$arrRegionOption[] = "<option value='".$key."' ".$selected.">".$region."</option>";	
		}	
		
		$Region = $selRegion.implode(" ", $arrRegionOption)."</select>";
		
		return $Region;			
	}
	
	function getDistrictSelectBox($id, $selval, $extra='')
	{
		global $lang, $objComm;
		
		$arrDistrict = $objComm->getAllDistrict();
		
		$selDistrict = "<select id='".$id."' name='".$id."' $extra>";
		
		foreach($arrDistrict as $key => $District)
		{
			$selected = (strtolower($selval) == strtolower($key)) ? "selected='selected'" : "" ;		
			$arrDistrictOption[] = "<option value='".$key."' ".$selected.">".$District."</option>";	
		}	
		
		$District = $selDistrict.implode(" ", $arrDistrictOption)."</select>";
		
		return $District;			
	}
	
	function radioBox($name, $id, $value, $text, $selValue, $extra)
	{
		$checked = (strtoupper($value) == strtoupper($selValue)) ? "checked='checked'" : "";
		
		$radio = '
		<label class="radio">
			<div class="radio" id="uniform-'.$name.'">
				<span class="">
					<input type="radio" '.$checked.' value="'.$value.'" id="'.$id.'" name="'.$name.'" style="opacity: 0;" '.$extra.'>
				</span>
			</div>'.$text.'</label>';
	  
	  return $radio;
	}
	
	
	function allMembersComboBox($id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$arrData = $objComm->getAllMembers();

		$strCombo = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $row)
		{
			$selected = ($selval == $row->id) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$row->id."' ".$selected.">".$row->fname."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	
	function allMembersComboBox1($id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$arrData = $objComm->getAllMembers1();

		$strCombo = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $row)
		{
			$selected = ($selval == $row->id) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$row->id."' ".$selected.">".$row->fname." ".$row->lname." (".$row->status.")</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	
	function AdminStausNewsBox($id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$arrData = $objComm->getNewsAdminStatus();
		
		$strCombo    = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $row)
		{
			$selected = ($selval == $key) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$key."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	function getPaymentBox($id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$arrData = $objComm->getPaymentStatus();
		
		$strCombo    = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $row)
		{
			$selected = ($selval == $key) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$key."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	
	function makeAddEditForm($arrField)
	{
		global $lang;
		
		foreach($arrField as $key => $data)
		{
			$lblName 	= $data['label_name'];
			$lblStyle	= $data['label_style'];
			$filedType 	= $data['field_type'];
			$fieldVal 	= $data['field_value'];
			$fieldId 	= $data['field_id'];
			$fieldName 	= $data['field_name'];
			$fieldClass = $data['field_class'];
			$fieldExtraCss = $data['field_extra_css'];
			$filedReuired = $data['filed_required'];
			$HTML 		= $data['html'];
			
			$strForm  = '<div class="control-group">
							  <label class="control-label" style="'.$lblStyle.'" for="'.$fieldId.'">'.$lang[$lblName].'</label>
								<div class="controls">';
						
			
			switch(strtoupper($filedType))
			{
				case 'TEXT':
				case 'EMAIL':
				case 'NUMBER':				
								$HTML = '<input type="'.$filedType.'" '.$filedReuired.' value="'.$fieldVal.'" id="'.$fieldId.'" name="'.$fieldName.'" class="'.$fieldClass.'" style="'.$fieldExtraCss.'">';
								break;
				case 'TEXTAREA':
								$HTML = '<textarea '.$filedReuired.' id="'.$fieldId.'" name="'.$fieldName.'" class="'.$fieldClass.'" style="'.$fieldExtraCss.'">'.$fieldVal.'</textarea>';
								break;
								
				case 'FILES':
								$HTML = '<input type="file" '.$filedReuired.' id="'.$fieldId.'" name="'.$fieldName.'" class="'.$fieldClass.'" style="'.$fieldExtraCss.'"><div>{FILES_VALUE_'.strtoupper($fieldId).'}</div>';
								break;				
								
				default:
								break;				
			}
			
			$strForm .= $HTML."</div></div>";
			
			$arrForm[] = $strForm;
		}
		
		return implode("",$arrForm);
	}
	

	function makeViewForm($arrField)
	{
		global $lang;
		

		foreach($arrField as $key => $data)
		{
			$lblName 	= $data['label_name'];
			$lblStyle	= $data['label_style'];
			$filedType 	= $data['field_type'];
			$fieldVal 	= $data['field_value'];
			$fieldId 	= $data['field_id'];
			$fieldName 	= $data['field_name'];
			$fieldClass = $data['field_class'];
			$fieldExtraCss = $data['field_extra_css'];
			$filedReuired = $data['filed_required'];
			$HTML 		= $data['html'];
			
			$strForm  = '<div class="control-group">
							  <label class="control-label" style="'.$lblStyle.'" for="'.$fieldId.'">'.$lang[$lblName].'</label>
								<div class="controls">';
			
			switch(strtoupper($filedType))
			{
				case 'TEXT':
				case 'EMAIL':
				case 'NUMBER':	
				case 'AUTOCOMPLETE':							
								$HTML = '<span class="input-xlarge uneditable-input">'.$fieldVal.'</span>';
								break;
								
				case 'TEXTAREA':
								$HTML = '<textarea id="'.$fieldId.'" name="'.$fieldName.'" class="'.$fieldClass.'" style="'.$fieldExtraCss.'" readonly>'.$fieldVal.'</textarea>';
								break;
				
				case 'FILES':
								$HTML = '<IMG class="'.$fieldClass.'" style="'.$fieldExtraCss.'" src="{IMAGE_PATH_'.strtoupper($fieldId).'}" >';
								break;
												
				default:
								break;				
			}
			
			$strForm .= $HTML."</div></div>";
			
			$arrForm[] = $strForm;
		}
		
		return implode("",$arrForm);
	}
	
	
	function getCouponBox($id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$arrData = $objComm->getAllCoupon();

		$strCombo    = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $row)
		{
			$selected = ($selval == $row->id) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$row->id."' ".$selected.">".$row->coupon_code."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	function paymentMethodCombo($id,$selVal, $extra)
	{
		global $lang; 
		
		$arrStatus = array('Manual' => 'Manual', 'Online' => 'Online');

		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function getMembershipTypeBox($id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$arrData = $objComm->membershipItemName();
		
		$strCombo    = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $row)
		{
			$selected = ($selval == $key) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$key."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	function getMembershipIDBox($id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$arrData = $objComm->getAllMembers();
		
		$strCombo    = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $row)
		{
			$selected = ($selval == $row->id) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$row->id."' ".$selected.">".$row->membership_id."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	function baiscDropDownBox($arrData, $id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$strCombo    = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $value)
		{
			$selected = (strtoupper($selval) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$value."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	
	function makeHTMLField($record, $data='')
	{
		global $lang;
		$arrHtml = array();
		$dataValue = (array) $data;
		
		foreach($record as $key => $row)
		{
			$FieldType = explode("(",$row->Type);
			$Lable     = ucwords(str_replace("_"," ",$row->Field));
			$FieldID = 'data_'.$row->Field;
			
			switch(strtoupper($FieldType[0]))
			{
				case 'INT':

							$htmlField = array(	'label_name' 	=>  $Lable,
												'field_type' 	=> 'NUMBER',
												'field_id' 		=> $FieldID,
												'field_name' 	=> $FieldID,
												'field_value'	=> $dataValue[$row->Field],
												'field_class' 	=> 'input-xsmall focused'
	   										   );
							break;	

				case 'VARCHAR':
				
							$htmlField = array(	'label_name' 	=>  $Lable,
												'field_type' 	=> 'TEXT',
												'field_id' 		=> $FieldID,
												'field_name' 	=> $FieldID,
												'field_value'	=> $dataValue[$row->Field],
												'field_class' 	=> 'input-xsmall focused'
											   );
							break;
							
				case 'TEXT':

							$htmlField = array(	'label_name' 	=>  $Lable,
												'field_type' 	=> 'TEXTAREA',
												'field_id' 		=> $FieldID,
												'field_name' 	=> $FieldID,
												'field_value'	=> $dataValue[$row->Field],
												'field_class' 	=> ''
											   );

							break;
							
				case 'TIMESTAMP':
				case 'DATETIME':
				case 'DATE':
							
							$htmlField = array(	'label_name' 	=>  $Lable,
												'field_type' 	=> 'TEXTAREA',
												'field_id' 		=> $row->Field,
												'field_name' 	=> $row->Field,
												'field_value'	=> $dataValue[$row->Field],
												'field_class' 	=> 'class="input-small datepicker"'
											   );
							break;

				case 'ENUM':
							$htmlField = '';
							break;

				default:
							$htmlField = '';
							break;

			}

			$arrHtml[$row->Field] = $htmlField;
		}
		
		return $arrHtml;
	}
	
	#$type=POINTS|NAME|PICKS
	function pointsBasicCombo($type, $combName, $selval, $extra='')
	{
		global $objComm;	
		switch ($type)
		{
			case "PICKS":
				$combData=array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14);	
			break;
			case "NAME":
				$combData=array(
					"single"=>"single","dual"=>"dual","triple"=>"triple",
					"quad"=>"quad","quintuple"=>"quintuple","intelligent"=>"intelligent",
					"brilliant"=>"brilliant","expert"=>"expert","prodigy"=>"prodigy",
					"genius"=>"genius","single"=>"single","single"=>"single",
				);
			break;
		}
		
		
		$strCombo    = "<select id='".$combName."' name='".$combName."' $extra>";
		$arrOption[] = "<option value=''> -- Please Select -- </option>";
		
		foreach($combData as $key => $value)
		{
			$selected = (strtoupper($selval) == strtoupper($value)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$value."' ".$selected.">".strtoupper($value)."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
		
	}
	
	function postCategoryBasicCombo($name,$selVal,$extra="")
	{
		global $DB;
		$data=$DB->fetchAll("SELECT id, cat_title FROM post_category WHERE cat_status='ACTIVE'");
		$strCombo    = "<select class='post_category_id' id='".$name."' name='".$name."' $extra>";
		$arrOption[] = "<option value=''> -- Select Category-- </option>";
		foreach($data as $datum)
		{
			$selected = (strtoupper($selval) == strtoupper($datum->id)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$datum->id."' ".$selected.">".strtoupper($datum->cat_title)."</option>";	
		}	
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		return $Combo;	
	}		
}	
?>