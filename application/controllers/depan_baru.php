<?php
class depan_baru extends master_controller  {
	function depan_baru(){
		parent::__construct();
		// echo "pilihan ".$this->session->userdata("pilihan"); exit;
		$this->load->model("coremodel","cm");
	}
	
	
	function index(){
		// $this->set_subtitle("DASHBOARD");
		// $this->set_title("DASHBOARD");
		// $this->set_content("WELCOME");
		// $this->render_baru();

		$content = $this->load->view("op_depan_view",array(),true);

		$this->set_subtitle("DASHBOARD OPERATOR ");
		$this->set_title("DASHBOARD OPERATOR ");
		$this->set_content($content);
		$this->render_baru();
	}
}
?>