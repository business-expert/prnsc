<?php
class Home
{
	function __construct() 
	{
		
		
	}
	######## START NEWS SECTION #############################	
	function getAllOwnNews()
	{
		global $objComm, $DB, $FBPanel;	
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);	
		$currentUser=$FBPanel->panelGetUser();
		$SQL="SELECT post.id, post.post_title, post.post_add_by,
		COUNT(post_comment.comment_post_id) AS TOTAL_COMMENTS,
		post.post_date, post.post_status FROM post LEFT JOIN post_comment ON post.id=post_comment.comment_post_id WHERE post_add_by='".$currentUser."' GROUP BY post.id";
	
		return $DB->fetchAll($SQL);
	}
	
	
	function getNews($id)
	{
		global $objComm, $DB, $FBPanel;
		
		$SQL = $SQL="SELECT * FROM post WHERE post.id='".$id."'";
		return $DB->fetchOne($SQL);
	}
	
	
	function setNews()
	{
		global $objComm, $DB, $FBPanel;
		
	    $PkID = $_REQUEST['pk_id'];

		$dbArray = $objComm->setTableField();
		$dbArray["post_desc"]=$objComm->removeLeadingTrailingNewLinesSpaces($dbArray["post_desc"]);
		if($PkID > 0)
		{
			$dbArray["post_update"]=date("Y-m-d H:i:s");
			$where = "`id` = '".$PkID."'";
			
			if($DB->updateRecord('post', $dbArray, $where , ''))
			{				
				$_SESSION['news_success'] = "News Updated Successfully";
			}
			else
			{
				$_SESSION['news_error'] = "Error: Unable to Process";
			}
		}
		else
		{
			
			$dbArray["post_date"]=date("Y-m-d H:i:s");
			$dbArray["post_add_by"]=$FBPanel->panelGetUser();
			if($DB->addNewRecord('post', $dbArray, ''))
			{
				$_SESSION['news_success'] = "News Added Successfully";
			}
			else
			{
				$_SESSION['news_error'] = "Error: Unable to Process";
			}
		}
		
	}
	
	
	function delNews($id)
	{
		global $DB, $lang;
		if($DB->query("DELETE FROM Blog WHERE id='".$id."' LIMIT 1")) { $_SESSION['Blog_success'] = "Blog Deleted Successfully"; }
		else { $_SESSION['Blog_success'] = "Error: Unable to Process"; }
	}
	######## END NEWS SECTION ###############################	
	function getAllProducts()
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
		WHERE product_status='Active' AND product.product_remain_total_products > 0 ORDER BY product_type.id ASC";
		return ($DB->fetchALL($SQL,""));
	}
	function getRace()
	{		
		global $DB, $objComm;
		$SQL="SELECT 
		race.id,
		race.race_title,
		race.event_id,
		race.race_type,
		race.race_active,
		race.race_date,
		race.race_flag,
		race_type.race_type_athletic_code,
		race_type.race_type_max_picks,
		race_type_points.rtp_race_type_points
		FROM race JOIN race_type ON race.race_type=race_type.id
		JOIN race_type_points ON race_type_points.rtp_race_type_id=race_type.id
		WHERE race.race_active='Active'";
		$DATArt=$DB->fetchAll($SQL,"");
		return $DATArt;
	}
	
	function getLiveResult()
	{
		global $DB, $objComm;
		return $data=$DB->fetchAll("SELECT race.race_title,race.id,race.event_id,race.race_start_datetime,race.race_end_datetime,race.race_flag FROM race","");

	}
	
	function getLiveStandingResult()
	{
		global $DB, $objComm;
		$SQL="SELECT 
		race.id,
		race.race_title,
		race.event_id,
		race.race_type,
		race.race_active,
		race.race_date,
		race.race_start_datetime,
		race.race_end_datetime,
		race.race_flag,
		race_type.race_type_athletic_code
		FROM race JOIN race_type ON race.race_type=race_type.id
		WHERE race.race_active='Active'";
		$DATArt=$DB->fetchAll($SQL,"");
		return $DATArt;
   }
   
   function getAllNews()
   {
		global $DB, $objComm;
		$SQL="SELECT post.id, post.post_title, post.post_add_by, post.post_desc, 
		COUNT(post_comment.comment_post_id) AS TOTAL_COMMENTS,
		post.post_date, post.post_status FROM post LEFT JOIN post_comment ON post.id=post_comment.comment_post_id WHERE UPPER(post.post_status)='ACTIVE' GROUP BY post.id";
		return $DB->fetchAll($SQL);
  }
  
  function getAthleticProfile()
  {
		global $DB, $objComm, $FBPanel;
		$SQL="SELECT contact, name, bio, athletic_email, photo_url FROM athlete WHERE athlete.facebook_id='".$FBPanel->panelGetUser()."'";
		return $DB->fetchOne($SQL);
  }
  
	function setAthleticProfile()
	{
		global $DB, $objComm, $FBPanel;
		$updateData=array(
		"contact"=>$_REQUEST["data_contact"],	
		"name"=>$_REQUEST["data_name"],
		"bio"=>$objComm->removeLeadingTrailingNewLinesSpaces($_REQUEST["data_bio"]),
		"athletic_email"=>$_REQUEST["data_athletic_email"],
		"athletic_update"=>date("Y-m-d H:i:s")
		);
		$response=$DB->updateRecord("athlete",$updateData,"athlete.facebook_id='".$FBPanel->panelGetUser()."'","");
		if($response)
		{
			$_SESSION['profileUpdate_success'] = "Profile Updated Successfully";
		}
		else
		{
			$_SESSION['profileUpdate_error'] = "Error: Unable to Process";
		}
	}
}
?>