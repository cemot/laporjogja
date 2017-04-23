<?php
class admin_polda extends admin_controller  {
	function admin_polda(){
		parent::__construct();
		$this->load->helper("tanggal");
		$this->load->model("coremodel","cm");


		$this->controller = get_class($this);
	}
	
	
	function index(){

		$this->db->where("1=1",null,false);
		$data_array = $this->db->get("m_setting_polda")->row_array();


		//$data_array = array();
		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("PENGATURAN DATA POLDA");
		$this->set_title("PENGATURAN DATA POLDA");
		$this->set_content($content);
		$this->render_admin();
	}


function save(){
	$post = $this->input->post();
	// show_array($post);  exit;
	$this->db->where("1=1",null,false);
	$res = $this->db->update("m_setting_polda",$post);

	if($res) {
		$ret = array("error"=>false,"message"=>"Data setting polda berhasil disimpan");
	}
	else {
		$ret = array("error"=>true,"message"=>"Data setting polda gagal disimpan".mysql_error());
	}
	echo json_encode($ret);

}
 
}
?>