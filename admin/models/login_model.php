<?php


class login
{
	function __construct() 
	{
		
	}
	
	function checkLogin()
	{
		global $objComm;
		
		$this->ValidateData();
		
		if($this->row->id > 0)
		{
			$this->setLoggedSession();
			$objComm->redirect('index.php?model=dashboard');
		}
	}
	
	
	function ValidateData()
	{
		global $DB, $lang;
		
		$SQL = "SELECT * FROM users WHERE userid='".$_POST['username']."' AND password = '".md5($_POST['password'])."'";	
		$row = $DB->fetchOne($SQL);

		if($row->id > 0)
		{
			if(strtoupper($row->status) == 'ACTIVE')
				$this->row = $row;
			else
				$_SESSION['login_error'] = "Incorrect username or password ".ucfirst($row->status);
		}
		else
		{
			$_SESSION['login_error'] = 'Incorrect username or password';
		}
	}
	
	function setLoggedSession()
	{
		$_SESSION['admin'][SITE_SESSION.'_user'] = $this->row->userid;
		$_SESSION['admin'][SITE_SESSION.'_role'] = $UserRole;
	}
	
	function logout()
	{
		global $objComm;
		
		foreach($_SESSION['admin'] as $key => $value)
		{
			$_SESSION['admin'][$key] = '';
			unset($_SESSION['admin'][$key]);
		}
		
		$_SESSION['login_success']	= 'you are logged out successfully';

		$objComm->redirect('index.php?model=login');

		exit();		
	}
	
}

?>