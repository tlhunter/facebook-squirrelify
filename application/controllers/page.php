<?php
class Page extends Controller {

	function Page() {
		parent::Controller();
	}
	
	function index() {
		$data = $this->document->generate_page_data();
		$this->template->load('main_template', 'view_name', $data);
	}
	
	function help() {
		echo "Help Page";
	}
	
	function privacy() {
		echo "Privacy Page";
	}
	
	function tos() {
		echo "TOS Page";
	}

}