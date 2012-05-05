<?php
class MY_Controller extends Controller {
	function MY_Controller() {
		parent::Controller();
		$GLOBALS['facebook_config']['debug'] = NULL;
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$this->load->config('fireignition');
		if ($this->config->item('fireignition_enabled')) {
			if (floor(phpversion()) < 5) {
				log_message('error', 'PHP 5 is required to run fireignition');
			} else {
				$this->load->library('firephp');
			}
		} else {
			$this->load->library('firephp_fake');
			$this->firephp =& $this->firephp_fake;
		}
	}
}