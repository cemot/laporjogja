<?php
class index_penyidik extends super_controller  {
	function index_penyidik(){
		parent::__construct();
		// echo "pilihan ".$this->session->userdata("pilihan"); exit;
		$this->load->model("coremodel","cm");
	}
	
	
	function index(){
		// $this->set_subtitle("DASHBOARD");
		// $this->set_title("DASHBOARD");
		// $this->set_content("WELCOME");
		// $this->render_baru();

		$content = $this->load->view("penyidik_depan_view",array(),true);

		$this->set_subtitle("PENYIDIK DASHBOARD");
		$this->set_title("PENYIDIK DASHBOARD");
		$this->set_content($content);
		$this->render();
	}
}
?>