<?php

class Comment
{
	function __construct() 
	{
		
	}
	
	function getAllComment()
	{
		global $DB, $objComm;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$sr_post_title 	= $_POST['sr_post_title'];
		
		if($sr_post_title != '') $arrWhere[] = "post.`post_title` like '%".$sr_post_title."%'";
		
		$SQL = "SELECT 
		post.id AS post_id, 
		post.post_title,
		post_comment.*, facebook.fb_name
		FROM post_comment LEFT JOIN post ON post.id=post_comment.comment_post_id
		LEFT JOIN facebook ON post_comment.comment_commenter_id=facebook.fb_id
		";
		
		
		if(count($arrWhere) > 0){ $Where = " WHERE ".implode(" AND ", $arrWhere); } 
		if($Where != ''){ $SQL .=  $Where; } 
		
		$SQL .= " ORDER BY post_comment.comment_post_id, post_comment.comment_date DESC";
		
		return $DB->fetchAll($SQL);
	}
	
	
	function getComment($id)
	{
		global $DB;
		$SQL = "SELECT 
		post.id AS post_id, 
		post.post_title,
		post_comment.*, facebook.fb_name,
		COUNT(post_comment.id) AS TOTAL_COMMENTS
		FROM post_comment LEFT JOIN post ON post.id=post_comment.comment_post_id
		LEFT JOIN facebook ON post_comment.comment_commenter_id=facebook.fb_id
		WHERE post_comment.id='".$id."' GROUP BY post.id";
		return $DB->fetchOne($SQL,"");
	}
	
	
	function setComment()
	{
		global $objComm, $DB;	
	    $PkID = $_REQUEST['pk_id'];
		$dbArray = $objComm->setTableField();
		
		if($PkID > 0)
		{
			$dbArray["comment_update"]=date("Y-m-d H:i:s");
			$where = "`id` = '".$PkID."'";
			
			if($DB->updateRecord('post_comment', $dbArray, $where , ''))
			{				
				$_SESSION['comment_success'] = "Comment Update Successfully";
			}
			else
			{
				$_SESSION['comment_error'] = "Error: Unable to Process";
			}
		}
		else
		{
			$_SESSION['comment_error'] = "Error: Unable to Process";
		}
	}
}

?>