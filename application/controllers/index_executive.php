<?php
class index_executive extends super_controller  {
	function __construct(){
		parent::__construct();
		// echo "pilihan ".$this->session->userdata("pilihan"); exit;
		$this->load->model("coremodel","cm");
	}
	
	
	function index(){
		// $this->set_subtitle("DASHBOARD");
		// $this->set_title("DASHBOARD");
		// $this->set_content("WELCOME");
		// $this->render_baru();

		$userdata = $_SESSION['userdata'];
		// show_array($userdata);
		// exit();
		$content = $this->load->view("ex_depan_view",array(),true);

		$this->set_subtitle("DASHBOARD EXECUTIVE ");
		$this->set_title("DASHBOARD EXECUTIVE ");
		$this->set_content($content);
		$this->render();
	}
}
?>