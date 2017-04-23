<?php
class ex_diagram_pie extends ex_controller {
 	var $controller ;

	function ex_diagram_pie(){
		parent::__construct();
		 
		$this->load->model("coremodel","cm");
		// $this->load->helper("tanggal");
		// $this->load->model("ex_lap_a_model","dm");
		// $this->load->model("admindik_lap_a_model","xm");
		$this->controller = get_class($this);
		$this->userdata = $_SESSION['userdata'];

	}







function index(){
		// echo "what's wrong"; exit();
		$data_array=array();
        $userdata =  $_SESSION['userdata'];


        $res = $this->db->get("m_lapas");
        $arr_lapas = array();
        foreach($res->result() as $row) : 
        	$nama_lapas = str_replace(" ","",(strtolower($row->lapas)));
        	$arr_lapas[$nama_lapas] = $row->kapasitas;
    	endforeach;



        $query  = "SELECT asal_upt, COUNT(no_reg) jumlah FROM main group by asal_upt";
        // $jml    = $this->db->query($query)->result();
        $data_array['arr_lapas'] = $arr_lapas;
        $data_array['jml'] = $this->db->query($query)->result_array();
        // show_array($data_array);
        // exit();
		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("Data Diagram");
		$this->set_title("Data Diagram");
		$this->set_content($content);
		$this->render();


	}
























	

}

?>