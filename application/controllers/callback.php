<?php
class Callback extends Controller {

	function Callback() {
		parent::Controller();
	}
	
	function remove() {
		echo "App Removed Callback";
	}
	
	function authorize() {
		echo "App Authorize Callback";
	}
	
	function update() {
		echo "App Update Callback";
	}
	
	function publish() {
		echo "App Publish Callback";
	}
	
	function self_publish() {
		echo "App SelfPublish Callback";
	}

}