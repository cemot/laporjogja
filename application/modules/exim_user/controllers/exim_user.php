<?php
class exim_user extends master_controller {
// kesehatan,kekuatan, keturunan, masuk surga
	var $controller ;

	function __construct(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		// $this->load->model("pencarian_model","dm");
		$this->controller = get_class($this);

		$this->userdata = $_SESSION['userdata'];

	}

	function index(){

 	
		$data_array = array();
	 
 
		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("EXPORT DATA USER ONLINE ");
		$this->set_title("EXPORT DATA USER ONLINE ");
		$this->set_content($content);
		$this->render_baru();
	}

 
 function export_data_user() {
 	 
 	 	$userdata = $this->userdata ; 

 	 	// show_array($userdata); 


 	 	if($userdata['jenis'] == "polres") {
 	 		$this->db->where("id_polres",$userdata['id_polres']); 
 	 		$this->db->where("jenis",$userdata['jenis']);

 	 		$filename = "user_".$userdata['jenis']."_".$userdata['id_polres'];


 	 	}
 	 	else if ($userdata['jenis'] == "polsek") {
 	 		$this->db->where("id_polsek",$userdata['id_polsek']); 
 	 		$this->db->where("jenis",$userdata['jenis']);
 	 		$filename = "user_".$userdata['jenis']."_".$userdata['id_polsek'];
 	 	}
 	 	else {
 	 		$this->db->where("jenis",$userdata['jenis']);
 	 		$filename = "user_polda";
 	 	}


 	 	$res = $this->db->get("pengguna"); 

 	 	$arr_user = array();

 	 	foreach($res->result_array() as $row) : 
 	 		$arr_user[] = $row; 
 		endforeach;

 		// show_array($arr_user); 

 		$data = json_encode($arr_user);

 		$this->load->library('zip');


 		 $this->zip->add_data($filename, $data);

 		 $this->zip->download($filename."_".date("dmYhis").'.zip');




 }
	 

}
?>
