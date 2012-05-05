<?php
class Home extends My_Controller {
	function Home() {
		parent::My_Controller();
		$this->firephp->log('Loaded Home Controller');
		$this->load->library('facebook_connect');
	}
	
	function index() {
		$data = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id
				);
		$data['extra_head'] = '';

		if ($data['user_id']) {
			$data['gallery'] = array();
			try {
				$data['gallery'] = $this->facebook_connect->client->photos_getAlbums($this->facebook_connect->user_id, null);
			} catch (FacebookRestClientException $e) {
				$this->firephp->log($e, "EXCEPTION");
			}
			$this->template->load('main_template', 'home_known', $data);
		} else {
			$this->template->load('main_template', 'home_stranger', $data);
		}
	}
}