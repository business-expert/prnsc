<?php

	include_once(FBPANEL_PATH."facebook.php");	
	
	class FBPanel
	{
		private $appId="408541082604920"; 
		private $secret="1938c15583d0a8b67801703c02276c8e";
		private $redirect_uri=FACEBOOK_REDIRECT_URI;
		private $facebook;
		private $profileName;
		private $userID;
		private $userProfile;
		private $accessToke;
		private $friendList = array();
		private $user;
		private $params=array();
		//"scope"=>email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown,read_friendlists,
		function __construct()
		{
			$this->facebook = new Facebook(array('appId'=>$this->appId,'secret'=>$this->secret));
			//$this->facebook->setAccessToken("1398328207071081|t6yanTx__sNDT3qW9A9uoVHVxM4");
			$this->params=array("client_id"=>"408541082604920","display"=>"popup","scope"=>email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown,read_friendlists,"redirect_uri"=>$this->redirect_uri);
			$this->user=$this->facebook->getUser();

			if($this->user)
			{
				try{

					$this->userProfile = $this->facebook->api('/me');
					$this->friendList = $this->facebook->api('me/friends');
					$_SESSION['User']=$this->userProfile;
				}
				catch(FacebookApiException $e)
				{
					error_log($e);
					$user = NULL;
				}		
			}

		
		}
		
		function getUserID()
		{
			$this->userID =  $this->facebook->getUser($this->appId);
			return $this->userID;
		}
		
		function getProfileName($userName)
		{
			$this->profileName = $this->facebook->api('/'.$userName);
			return $this->profileName["name"];
		}
		function getProfileImage($userName)
		{
			$url="http://graph.facebook.com/".$userName."/picture";
			$headers = get_headers($url,1);
			return $headers['Location'];
		}
		function getProfileUserId($userName)
		{
			$url="http://graph.facebook.com/".$userName."/id";
			$headers = get_headers($url,1);
			return $headers['Location'];
		}
		function getProfileContents($userName,$contents)
		{
			global $objComm;
			
			$fetchContent=array();
			foreach($contents as $what)
			{
				switch($what)
				{
					case "picture":
					$imageLocation=$this->getProfileImage($userName);
					$isLocationExist=$objComm->isLocationExist($imageLocation);
					$fetchContent[$what]= ($isLocationExist) ? $imageLocation : DEFAULT_ATHLETES_PROFILE_AVTAR;
					break;
					
					case "name":
						$fetchContent[$what]=$this->getProfileName($userName);
					break;
					
					case "userid":
						$fetchContent[$what]=$this->getProfileUserId($userName);
					break;
				}
			}
			return $fetchContent;
		}
		
		
		/****************** Panel function **************/
		function panelGetUser()
		{
			$this->user = $this->facebook->getUser();
			return $this->user;
		}
		function panelGetName()
		{
			return $this->userProfile["name"];
		}
		function panelGetEmail()
		{
			return $this->userProfile["email"];
		}
		
		function panelGetUserProfileInfo()
		{
			$this->userProfile["picture"]=$this->getProfileImage($this->user);
			$this->userProfile["location"]=$this->userProfile["location"]["name"];
			$this->userProfile["description"]=$this->userProfile["work"][0]["description"];
			$this->userProfile["friendlists"]=$this->panelGetFriendList();
			return $this->userProfile;
		}
		
		function panelGetLoginURL($params)
		{	
			 return $this->facebook->getLoginUrl($this->params);
		}
		
		function panelGetLoginStatusUrl($params=array())
		{
			return $this->facebook->getLoginStatusUrl();
		}
		
		function panelGetLogoutURL()
		{
			return $this->facebook->getLogoutUrl();
		}
		
		function panelGetFriendList()
		{
			return $this->friendList["data"];
		}
		
		function panelLogoutUser()
		{
			$logoutUrl="https://www.facebook.com/logout.php?next=".$this->redirect_uri."&access_token=".$this->facebook->getAccessToken();
			session_destroy();
			?>
			<script>
				top.location.href="<?=$logoutUrl?>";
			</script>
			<?php		


			
		}
		
		function PanelSecurity($params="")
		{
			$user=$this->facebook->getUser();
			if($user==0 || $user==false || empty($user) || !isset($user))
			{
				$current=$this->panelGetLoginURL($this->params);
				?>
				<script>
					top.location.href="<?php echo $current; ?>";
				</script>
				<?php		
			}
		}
		
	}
	
?>