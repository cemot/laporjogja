<?php
class lantas_controller extends CI_Controller {

var $pilihan; 
	function __construct() {
		parent::__construct();  


	$userdata = $_SESSION['userdata'];
	// show_array($userdata); exit;

		if($userdata['login'] == false ) {
			redirect('login/');
		} 
		
		
	 
		$this->userdata = $this->session->userdata("userdata");
		 
		
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
 
		// $this->load->view("newtheme",$this->content);
		$this->load->view("lantas_theme",$this->content);
	}

 

}

?>
