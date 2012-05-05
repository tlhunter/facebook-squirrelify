<?php
class Album extends My_Controller {
	function Album() {
		parent::Controller();
		$this->firephp->log('Loaded Album Controller');
		$this->load->library('facebook_connect');
	}
	
	function _remap($method) {
		$aid = $method;
		$this->load->library('facebook_connect');
		
		$data = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id
				);

		$data['gallery'] = $this->facebook_connect->client->photos_get(NULL, $aid, NULL);
		$data['extra_head'] = '';

		$this->template->load('main_template', 'album', $data);
	}
}