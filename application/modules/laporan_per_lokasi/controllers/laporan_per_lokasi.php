<?php
class laporan_per_lokasi extends admin_controller  {
	function laporan_per_lokasi(){
		parent::__construct();
		$this->load->helper("tanggal");
		$this->load->model("laporan_lokasi_model","lm");
		$this->load->model("coremodel","cm");


		$this->controller = get_class($this);
	}
	
	
	function index(){
		$data_array = array();
		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("TIDAK KEJAHATAN PER LOKASI ");
		$this->set_title("TIDAK KEJAHATAN PER LOKASI");
		$this->set_content($content);
		$this->render_admin();
	}

 


function get_laporan(){
	$data = $this->input->post();

	$data['stat'] = $this->lm->get_data_jumlah_lokasi($data);

	echo json_encode($data['stat']);

	 
}


function get_data_per_polsek($id_polsek){
	$data = $this->input->get();

	$arr = array(

			"sleman"  =>  "a34_4",
			"wonosari"  => "a34_3",
			"jogja"  => "a34_71",
			"bantul"  => "a34_2",
			"wates"  => "a34_1"		

	);
	$data['id_polres'] = $arr[id_polsek];
	



}


 
}
?>