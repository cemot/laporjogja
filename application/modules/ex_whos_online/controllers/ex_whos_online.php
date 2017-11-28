<?php
class ex_whos_online extends super_controller {
	var $controller ;

	function __construct(){
		parent::__construct();
		$this->load->model("ex_whos_online_model","ewh");
		$this->controller = get_class($this);

		$this->userdata = $_SESSION['userdata'];

	}

	function index(){
		$data_array['peoples'] = $this->ewh->getUserOnline();
		$controller = get_class($this);
		$data_array['controller'] = $controller;
		$content = $this->load->view($controller."_view",$data_array,true);
		
		$this->set_subtitle("Who's Online");
		$this->set_title("Online User");
		$this->set_content($content);
		$this->render();
	} 

}
?>
