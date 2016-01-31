<?php
include_once(dirname(__FILE__).'/bootstrap.php');


if($_REQUEST['ajaxcall'] == true)
{
	$mod = $_REQUEST['mod'];	
	if($mod != ''){
		if(function_exists($mod)){
			echo $mod(); die();
		}
	}
}	

### START Fetch out profile data using facebook URL #####
function getProfileContents()
{
	global $FBPanel,$objComm;
	$SQL="SELECT facebook_url FROM athlete  WHERE (facebook_url='http://www.facebook.com/".$_REQUEST["fbUserName"]."' OR facebook_url='https://www.facebook.com/".$_REQUEST["fbUserName"]."')";
	if($_REQUEST["action"]=="update") { $SQL .= " AND id != '".$_REQUEST["cur_id"]."'"; }
	
	if($objComm->isRecordExist($SQL))
	{
		$response["status"]="EXIST";
	}
	else
	{
		$response=$FBPanel->getProfileContents($_REQUEST["fbUserName"],array("picture","name"));
		#fetch out user ID
		$data=explode("_",$response["picture"]);
		$response["userid"]=$data[count($data)-3];
		if(isset($response)){ $response["status"]="OK"; } else{ $response["status"]="NO";}
	}
	$response["SQL"]=$SQL;
	echo json_encode($response);

}	
### END Fetch out profile data using facebook URL #####


##AJAX PLUGINS RECORD DELETION#######################
function ajaxDeleteSeason()
{
		global $DB, $objComm, $lang;
		$datum=explode(";",$_REQUEST["datum"]);
		$objComm->trashData($datum[0],$datum[1],$datum[2]);
		$RSevent=$DB->query("SELECT name FROM event WHERE id='".$datum[2]."'","");
		if(mysql_num_rows($RSevent) <= 0)
		{
			$response=$DB->query("DELETE FROM ".$datum[0]." WHERE ".$datum[1]."='".$datum[2]."'","");
			if($response){ $status="OK";$msg="Athletic race map Deleted Succesfully";}else{ $status="NOT";$msg="Unable to Process";}	
		}
		else
		{
			$DATUMevent=mysql_fetch_object($RSevent);
			$status="CONFIRM";$msg="This Season is assigned '{$DATUMevent->name}' event, first Remove or Update this season from the event and then Delete";
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
}
##AJAX PLUGINS RECORD DELETION#######################



##AJAX PLUGINS RECORD DELETION#######################
function ajaxDeleteEvent()
{
		global $DB, $objComm, $lang;
		$datum=explode(";",$_REQUEST["datum"]);
		$objComm->trashData($datum[0],$datum[1],$datum[2]);
		$RSrace=$DB->query("SELECT race_title FROM race WHERE event_id='".$datum[2]."'","");
		if(mysql_num_rows($RSrace) <= 0)
		{
			$response=$DB->query("DELETE FROM ".$datum[0]." WHERE ".$datum[1]."='".$datum[2]."'","");
			if($response){ $status="OK";$msg="Athletic race map Deleted Succesfully";}else{ $status="NOT";$msg="Unable to Process";}	
		}
		else
		{
			$DATUMrace=mysql_fetch_object($RSrace);
			$status="CONFIRM";$msg="This Event is assigned '{$DATUMrace->race_title}' race, first Remove or Update this Event from the Race and then Delete";
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
}
##AJAX PLUGINS RECORD DELETION#######################


##AJAX PLUGINS RECORD DELETION#######################
function ajaxPluginDelete()
{
		global $DB, $objComm, $lang;
		$datum=explode(";",$_REQUEST["datum"]);
		$objComm->trashData($datum[0],$datum[1],$datum[2]);
		$SQL="DELETE FROM ".$datum[0]." WHERE ".$datum[1]."='".$datum[2]."'";
		$response=$DB->query($SQL, '');
		if($response){ $status="OK";$msg=$lang["Voucher"]." ".$lang["Deleted"]." ".$lang["Succesfully"];}else{ $status="NOT";$msg=$lang["Unable to Process"];}	
		echo json_encode(array("status"=>$status,"msg"=>$msg));
}
##AJAX PLUGINS RECORD DELETION#######################


##AJAX PLUGINS RECORD DELETION#######################
function checkUniqRecord()
{
	global $DB, $objComm;
	$tb=$_REQUEST["tb"];
	$col_name = $_REQUEST['col_name'];
	$col_value = $_REQUEST['col_value'];

	if($_REQUEST["act"]=="UPDATE") 
	{
		$cur_id=$_REQUEST["cur_col"];$cur_value=$_REQUEST["cur_value"];
		$SQL="SELECT ".$col_name." FROM ".$tb." WHERE ".$col_name."='".$col_value."' AND ".$cur_id."!='".$cur_value."'";
		$record=$DB->totRecord($SQL, '');
		$response=($record>0) ? "NO" : "OK";
	}
	else
	{
		$SQL="SELECT ".$col_name." FROM ".$tb." WHERE ".$col_name."='".$col_value."'";
		$record=$DB->totRecord($SQL, '');
		$response=($record>0) ? "NO" : "OK";
	}
	echo json_encode(array("status"=>$response));

}
##AJAX PLUGINS RECORD DELETION#######################




function setRacePlacement()
{
	global $DB,$objComm,$FBPanel;
	$action=$_REQUEST["action"];
	$data=$_REQUEST["picksdata"];
	$response=false;
	

		foreach($data as $datum)
		{
			$datum["race_placement_date"]=date("Y-m-d H:i:s");$id=$datum["id"];$race_id=$datum["race_id"];$oldAction=$action;
			if($action=="UPDATE")
			{
				$response=$DB->query("DELETE FROM race_placement WHERE race_placement.race_id='".$datum["race_id"]."'");
				$action="ADD";
			}
			if($action=="ADD")
			{
				$response=$DB->addNewRecord("race_placement",$datum,"");
			}
			if($action=="DELETE")
			{
				$response=$DB->query("DELETE FROM race_placement WHERE race_placement.race_id='".$datum["race_id"]."'");
				$response=$DB->query("UPDATE race SET race_flag='0' WHERE race.id='".$race_id."'");
				break;
			}
			if($action=="PUBLISH")
			{
				$response=$DB->query("INSERT INTO race_placement_history(race_id,athelete_id,position,race_placement_date) SELECT race_id,athelete_id,position,race_placement_date FROM race_placement WHERE race_id='".$race_id."'");
				$response=$DB->query("UPDATE race SET race_flag='1' WHERE race.id='".$race_id."'");
				//id	rtp_race_type_id	rtp_single	rtp_dual	rtp_triple	rtp_quad	rtp_quintuple	rtp_intelligent	rtp_brrliant	rtp_expert	rtp_prodigy	rtp_genius
			}
		}	
	if($action=="PUBLISH")		
	{
		$points=$objComm->userPickPoints($race_id); # assign gained points to the fans.	
	}
	$status=($response) ? "OK" : "NOT";
	echo json_encode(array("status"=>"OK","msg"=>$response,"gainPointsArray"=>$gainPointsArray));
}
?>