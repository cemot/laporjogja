<?php
class index_lantas extends lantas_controller  {
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
		$content = $this->load->view("lantas_depan_view",array(),true);

		$this->set_subtitle("DASHBOARD LALU LINTAS ");
		$this->set_title("DASHBOARD LALU LINTAS ");
		$this->set_content($content);
		$this->render();
	}
}
?>