<?php
#defined('BASEPATH') OR exit('No direct script access allowed');

require_once "Facebook/autoload.php";

class My_facebook {
	
	var $facebook		= null;
	var $helper			= null;
	var $access 		= null;
	var $accessToken 	= null;
	
	public function __construct () {
		$this->ci =& get_instance();
		$this->facebook = new Facebook\Facebook([
			'app_id' 		=> $this->ci->config->item('app_id', 'facebook'),
			'app_secret' 	=> $this->ci->config->item('app_secret', 'facebook'),
			'default_graph_version' => 'v2.7', 
		]);
		$this->helper = $this->facebook->getRedirectLoginHelper();
	}
	
	public function getLoginUrl () {
		$url = $this->helper->getLoginUrl($this->ci->config->item('redirect_url', 'facebook'), $this->ci->config->item('permissions', 'facebook'));
		return $url;
	}
	
	public function getMe () {
		$a = $this->access === null;
		$b = isset($_SESSION['accessToken']) && $_SESSION['accessToken'] !== null;
		try {
			if ($a && $b) {
				$this->helper 		= $this->facebook->getRedirectLoginHelper();
				$this->accessToken 	= $this->helper->getAccessToken();
				$_SESSION['accessToken'] = $this->accessToken;
			} else {
				$this->accessToken = $_SESSION['accessToken'];
			}
			 
			if ($this->accessToken !== null) {
				$response = $this->facebook->get("/me?fields=id,name,email,about,bio,birthday,education,gender,first_name,middle_name,last_name,picture", "{$this->accessToken}");
				return $response->getGraphUser();
			}	
		} catch (Exception $e) {
			#echo "<br>".$e->getMessage();
		}
		
		return null;
	}	
}

?>