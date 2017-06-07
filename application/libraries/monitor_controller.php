<?php
class monitor_controller extends CI_Controller {

var $pilihan; 
	function monitor_controller() {
		parent::__construct();  


	$userdata = $_SESSION['monitor'];
	// show_array($userdata); exit;

		if($userdata == false ) {
			redirect('monitor/');
		} 
		
		
	 
		//$this->userdata = $this->session->userdata("userdata");
		 
		
	}

	function set_content($str) {
		$this->content['content'] = $str;
	}
	
	function set_title($str) {
		$this->content['title'] = $str;
	}
	
	function set_subtitle($str) {
		$this->content['subtitle'] = $str;
	}
	
	function render(){
		$arr = array();		 
		$this->load->view("monitor_theme",$this->content);
		
	}



}

?>
