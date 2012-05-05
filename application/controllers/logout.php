<?php
class Logout extends My_Controller {

	function Logout() {
		parent::Controller();
		$this->config->load('facebook');
		$this->firephp->log('Loaded Logout Controller');
	}
	
	function index() {
		$this->firephp->log($_COOKIE);
		$api_key = $this->config->item('facebook_api_key');
		$this->firephp->log($api_key, "api_key");
		$cookies = array("base_domain_{$api_key}", "{$api_key}", "{$api_key}_user", "{$api_key}_ss", "{$api_key}_session_key", "{$api_key}_expires", "fbsetting_{$api_key}");
		foreach($cookies AS $cookie) {
			$this->firephp->log($cookie, "DELETING COOKIE");
			setcookie($cookie, "", time() - 3600, "", ".squirrelify.renownedmedia.com");
		}
		$this->firephp->log($_COOKIE);
		redirect("/");
	}

}