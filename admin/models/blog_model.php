<?php

class Blog
{
	function __construct() 
	{
		
	}
	
	function getAllBlog()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$sr_post_title 	= $_POST['sr_post_title'];
		
		if($sr_post_title != '')		$arrWhere[] = "post.`post_title` like '%".$sr_post_title."%'";
		
		
		$SQL="SELECT post.id, post.post_title, post.post_add_by,
		COUNT(post_comment.comment_post_id) AS TOTAL_COMMENTS,facebook.fb_name,
		post.post_date, post.post_status FROM post LEFT JOIN post_comment ON post.id=post_comment.comment_post_id LEFT JOIN facebook ON post.post_add_by=facebook.fb_id";
		
		
		if(count($arrWhere) > 0){ $Where = " WHERE ".implode(" AND ", $arrWhere); } 
		if($Where != ''){ $SQL .=  $Where; } 
		$SQL .= " GROUP BY post.id";
		return $DB->fetchAll($SQL);
	}
	
	
	function getBlog($id)
	{
		global $DB;
		
		$SQL = $SQL="SELECT * FROM post WHERE post.id='".$id."'";
		return $DB->fetchOne($SQL);
	}
	
	
	function setBlog()
	{
		global $objComm, $DB;
		
	    $PkID = $_REQUEST['pk_id'];

		$dbArray = $objComm->setTableField();
		$dbArray["post_desc"]=$objComm->removeLeadingTrailingNewLinesSpaces($dbArray["post_desc"]);
		
		if($PkID > 0)
		{
			$dbArray["post_update"]=date("Y-m-d H:i:s");
			$where = "`id` = '".$PkID."'";
			
			if($DB->updateRecord('post', $dbArray, $where , ''))
			{				
				$_SESSION['blog_success'] = "News Updated Successfully";
			}
			else
			{
				$_SESSION['blog_error'] = "Error: Unable to Process";
			}
		}
		else
		{
			
			$dbArray["post_date"]=date("Y-m-d H:i:s");
			$dbArray["post_add_by"]="Admin";
			if($DB->addNewRecord('post', $dbArray, ''))
			{
				$_SESSION['blog_success'] = "News Added Successfully";
			}
			else
			{
				$_SESSION['blog_error'] = "Error: Unable to Process";
			}
		}
		
	}
}

?>