<?php
class Picturesave extends My_Controller {
	function Picturesave() {
		parent::Controller();
		$this->firephp->log('Loaded Picturesave Controller');
		$this->load->library('facebook_connect');
	}
	
	function index() {
		$this->load->library('facebook_connect');
		
		$data = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id
				);


		$x_position = 		$this->input->post('sq_pos_x') + 0;
		$y_position = 		$this->input->post('sq_pos_y') + 0;
		$sq_image = 	$this->input->post('sq_image') + 0;
		$base_width = 		$this->input->post('src_img_x') + 0;
		$base_height = 		$this->input->post('src_img_y') + 0;
		$action = 			$this->input->post('action');
		
		if ($sq_image == 3) {
			$squirrel_width = 117; $squirrel_height = 216;
			$squirrel_path = "data/squirrel_large.png";
		} else if ($sq_image == 2) {
			$squirrel_width = 81; $squirrel_height = 150;
			$squirrel_path = "data/squirrel_medium.png";
		} else if ($sq_image == 1) {
			$squirrel_width = 54; $squirrel_height = 100;
			$squirrel_path = "data/squirrel_small.png";
		} else {
			die("INVALID IMAGE");
		}
		
		
		
		$pid = $_POST['pid'] + 0;
		$data['pid'] = $pid;
		$picture_data = $this->facebook_connect->client->photos_get(NULL,NULL,$pid);
		$purl = @$picture_data[0]['src_big'];
		
		$aid = $picture_data[0]['aid'];
		$image = @imagecreatefromjpeg($purl);
		if (!$image) {
			die("INVALID PICTURE DATA FROM FACEBOOK");
		}
		$squirrel_image = @imagecreatefrompng($squirrel_path);
		
		
		if (!$image || !$squirrel_image) {
			die("Couldn't Load Source Image");
		} else {
			$image_width = imagesx($image);
			$image_height = imagesy($image);
			
			$gaussian = array(array(1.0, 2.0, 1.0), array(2.0, 4.0, 2.0), array(1.0, 2.0, 1.0));
			ImageConvolution($image, $gaussian, 16, 0);
			
			$this->_imagecopymerge_alpha(&$image, $squirrel_image, $x_position, $y_position, 0, 0, $squirrel_width, $squirrel_height, 100);
			
			if ($action == 'download') {
				header('content-type: image/jpeg');
				header('Content-Disposition: attachment; filename="'.$pid.'.jpg"');
				imagejpeg($image);
			} else { #upload
				if ($this->facebook_connect->client->users_hasAppPermission('photo_upload')) {
					$album_data = $this->facebook_connect->client->photos_getAlbums($this->facebook_connect->user_id, $aid);
					if ($album_data[0]['type'] != 'profile') {
						$use_aid = $aid;
					} else {
						$use_aid = null;
					}
					$temp_filename = "data/" . microtime() . ".jpg";
					imagejpeg($image, $temp_filename);
					$result = $this->facebook_connect->client->photos_upload($temp_filename, $use_aid, "A squirrel ruined my shot! http://apps.facebook.com/squirrelify/");
					unlink($temp_filename);
				}
				
				if ($this->facebook_connect->client->users_hasAppPermission('publish_stream')) {
					$this->facebook_connect->client->stream_publish("I just had a squirrel ruin a photo of mine!");
				}
		
				$data = array('user' => $this->facebook_connect->user, 'user_id' => $this->facebook_connect->user_id);
				$data['pid'] = $result['pid'];
				$data['aid'] = $result['aid'];
				$data['link'] = $result['link'];
				$data['extra_head'] = '';
				$this->template->load('main_template', 'picturesave', $data);
			}
			imagedestroy($image);  
			imagedestroy($squirrel_image);
		}
	}
	
	function _imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        $opacity=$pct;
        // getting the watermark width
        $w = imagesx($src_im);
        // getting the watermark height
        $h = imagesy($src_im);
        
        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);
        // copying that section of the background to the cut
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        
        // placing the watermark now
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);
    } 
}