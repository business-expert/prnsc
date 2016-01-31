<?php
include_once(dirname(__FILE__).'/../bootstrap.php');

if($_REQUEST['ajaxcall'] == true)
{
	$mod = $_REQUEST['mod'];	
	if($mod != ''){
		if(function_exists($mod)){
			echo $mod(); die();
		}
	}
}	
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
function checkUniqRecord($tb="",$col_name="",$col_value="",$request="NORMAL")
{
	global $DB, $objComm;
	if($tb=="" || $col_name=="" || $col_value=="")
	{
		$tb=$_REQUEST["tb"];
		$col_name = $_REQUEST['col_name'];
		$col_value = $_REQUEST['col_value'];
		$request="AJAX";
	}
	
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
	if($request=="AJAX")
	echo json_encode(array("status"=>$response));
	else
	return $response;
}
##AJAX PLUGINS RECORD DELETION#######################

function getProductDetail()
{
	global $DB, $objComm;
	$SQL = $SQL="SELECT 
		product_type.product_type,
		product_type.id	AS ptID,	
		product.id AS pID,
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
		WHERE product_status='Active' AND  product.id='".$_REQUEST["id"]."' AND product.product_remain_total_products > 0 ORDER BY product_type.id ASC";

		$DATAproduct=$DB->fetchOne($SQL,"");
		$DATAproduct->status="OK";$DATAproduct->msg="WELL DONE";
	echo json_encode($DATAproduct);
}


function setRacePicks()
{
	global $DB,$objComm,$FBPanel;
	##Ensure Race is live.
	if($DB->fetchOne("SELECT race.id FROM race WHERE race.race_flag='1' AND race.id='".$_REQUEST["race_id"]."'"))
	{
		$status="RACE_COMPELED";
	}
	else if($DB->fetchOne("SELECT race.id FROM race WHERE NOW() NOT BETWEEN race_start_datetime AND race_end_datetime AND race.id='".$_REQUEST["race_id"]."' AND race.race_flag='0'"))
	{
		$status="RACE_NOT_LIVE";
	}
	else
	{
		$data=$_REQUEST["picksdata"];$response=false;$datumArray=array();$IDS=array();
		$update=false;$insert=false;$delete=false;
		foreach($data as $datum)
		{
			$datum["race_picks_date"]=date("Y-m-d H:i:s");
			if(isset($datum["id"]))
			{
				$IDS[]=$id=$datum["id"];unset($datum["id"]);
				$update=$DB->updateRecord("race_picks",$datum,"id='".$id."'","");
			}
			else
			{
				$IDS[]=$insert=$DB->addNewRecord("race_picks",$datum,"");
			}
		}
		if(count($datum)<=0)
		{
			$SQL="DELETE FROM race_picks WHERE race_picks.race_id='".$_REQUEST["race_id"]."' AND race_picks.fan_id='".$FBPanel->panelGetUser()."'";
		}
		else
		{
			$racePicksIDS=$objComm->dataImplode($IDS,",",0);
			$SQL="DELETE FROM race_picks WHERE race_picks.id NOT IN($racePicksIDS) AND race_picks.race_id='".$datum["race_id"]."' AND race_picks.fan_id='".$datum["fan_id"]."'";
		}
		$delete=$DB->query($SQL,"");
		$status=($delete) ? "OK" : "NOT";
	}
	echo json_encode(array("status"=>$status));
	//echo json_encode(array("status"=>"OK","SQL"=>$SQL,"msg"=>$response,"delete"=>$delete,"update"=>$update,"insert"=>$insert));
}

function clearPicks()
{
	global $DB,$objComm,$FBPanel;
	$SQL="DELETE FROM race_picks WHERE race_picks.race_id='".$_REQUEST["race_id"]."' AND race_picks.fan_id='".$FBPanel->panelGetUser()."'";
	$response=$DB->query($SQL,"");
	$status=($response) ? "OK" : "ERROR";
	echo json_encode(array("status"=>$status,"SQL"=>$SQL));
}



#### START function to set product data those are ordered #######
function setOrderedProduct()
{
	global $DB, $objComm, $FBPanel;
	$data=$_REQUEST["orderedProduct"];
	$_SESSION["fb_id"]=$fb_id=$FBPanel->panelGetUser();
	$datumFacebook=$DB->fetchOne("SELECT * FROM facebook WHERE facebook.fb_id='".$fb_id."'","");		
	$insertData["pi_transaction_id"]=0;
	$insertData["pi_purchaser_id"]=$fb_id;
	$insertData["pi_invoice_number"]="INC".time();
	$insertData["pi_purchaser_name"]=$datumFacebook->fb_name;
	$insertData["pi_purchaser_email"]=$datumFacebook->fb_email;
	$insertData["pi_purchaser_contact"]=$datumFacebook->fb_phone;
	$insertData["pi_purchaser_address"]=$datumFacebook->fb_location;
	
	
	$insertData["pi_date"]=date("Y-m-d H:i:s");
	$_SESSION["porder_pi_id"]=$porder_pi_id=$DB->addNewRecord("product_invoice",$insertData,""); 
	
	foreach($data as $datum)
	{		
		$insertNData["porder_pi_id"]=$porder_pi_id;
		$insertNData["porder_product_id"]=$datum["porder_product_id"];		
		$insertNData["porder_product_name"]=$datum["porder_product_name"];
		$insertNData["porder_product_qty"]=$datum["porder_product_qty"];
		$insertNData["porder_product_price"]=$datum["porder_product_price"];
		$insertNData["porder_product_discount"]=$datum["porder_product_discount"];
		$insertNData["porder_product_tax"]=$datum["porder_product_tax"];
		$insertNData["porder_product_paid_amount"]=$datum["porder_product_paid_amount"];
		$response=$DB->addNewRecord("product_order",$insertNData,"");
	}	
	
	$status=($response) ? "OK" : "ERROR";
	echo json_encode(array("status"=>$status));
}
#### END function to set product data those are ordered #######


function postComment()
{
	global $DB, $objComm, $FBPanel;
	$insertData=array(
	"comment_post_id"=>$_REQUEST["comment_post_id"],	
	"comment_commenter_id"=>$FBPanel->panelGetUser(),
	"comment_name"=>$_REQUEST["comment_name"],
	"comment_email"=>$_REQUEST["comment_email"],
	"comment_contact"=>$_REQUEST["comment_contact"],
	"comment_desc"=>$objComm->removeLeadingTrailingNewLinesSpaces($_REQUEST["comment_desc"]),
	"comment_date"=>date("Y-m-d H:i:s")
	);
	$response=$DB->addNewRecord("post_comment",$insertData,"");
	$status=($response) ? "OK" : "ERROR";
	echo json_encode(array("status"=>$status));
}


function getNewsDetail()
{
	global $DB, $objComm, $FBPanel;
	$id=$_REQUEST["id"];
	$SQL="SELECT post.id, post.post_title, post.post_desc, post.post_add_by,
	COUNT(post_comment.comment_post_id) AS TOTAL_COMMENTS,
	post.post_date, post.post_status FROM post LEFT JOIN post_comment ON post.id=post_comment.comment_post_id WHERE post_add_by='".$FBPanel->panelGetUser()."' AND post.id='".$id."' GROUP BY post.id";
	$response=$DB->fetchOne($SQL);
	$response->status=($response) ? "OK" : "ERROR";
	echo json_encode($response);
}


function getNewsDetailForUpdate()
{
	global $DB, $objComm, $FBPanel;
	$id=$_REQUEST["id"];
	$SQL="SELECT post_category.id AS post_cat_id, post.id, post.post_title, post.post_desc, post.post_add_by
	FROM post_category JOIN post ON post_category.id=post.post_cat_id WHERE post_add_by='".$FBPanel->panelGetUser()."' AND post.id='".$id."' GROUP BY post.id";
	$response=$DB->fetchOne($SQL); 
	$response->status=($response) ? "OK" : "ERROR";
	echo json_encode($response);
}

function panelLogoutUser()
{
	global $DB, $objComm, $FBPanel;
	$FBPanel->panelLogoutUser();
}


?>