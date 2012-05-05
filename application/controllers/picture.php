<?php
class Picture extends My_Controller {
	function Picture() {
		parent::Controller();
		$this->firephp->log('Loaded Picture Controller');
		$this->load->library('facebook_connect');
	}
	
	function _remap($method) {
		$pid = $method;
		$this->load->library('facebook_connect');
		
		$data = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id
				);

		$data['pid'] = $pid;

		if ($this->facebook_connect->client->users_hasAppPermission('photo_upload')) {
			$data['allow_upload'] = true;
		} else {
			$data['allow_upload'] = false;
		}
		
		$picture_data = $this->facebook_connect->client->photos_get(NULL,NULL,$pid);
		$purl = $picture_data[0]['src_big'];
		$image_size = getimagesize($purl);
		$data['base_width'] = $image_size[0];
		$data['base_height'] = $image_size[1];
		$data['image_url'] = $purl;
		
		$data['extra_head'] = $this->load->view("picture_head", $data, TRUE);
		$this->template->load('main_template', 'picture', $data);
	}
}