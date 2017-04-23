<?php
class index_admindik extends admindik_controller  {
	function index_admindik(){
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

		$content = $this->load->view("admindik_depan_view",array(),true);

		$this->set_subtitle("DASHBOARD ADMINDIK ");
		$this->set_title("DASHBOARD ADMINDIK ");
		$this->set_content($content);
		$this->render_admin();
	}
}
?>