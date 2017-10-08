<?php
class index_administrator extends super_controller  {
	function __construct(){
		parent::__construct();
		// echo "pilihan ".$this->session->userdata("pilihan"); exit;
	}
	
	
	function index(){
		// $this->set_subtitle("DASHBOARD");
		// $this->set_title("DASHBOARD");
		// $this->set_content("WELCOME");
		// $this->render_baru();

		$content = $this->load->view("depan_view",array(),true);

		$this->set_subtitle("ADMINISTRATOR DASHBOARD");
		$this->set_title("ADMINISTRATOR DASHBOARD");
		$this->set_content($content);
		$this->render();
	}
}
?>