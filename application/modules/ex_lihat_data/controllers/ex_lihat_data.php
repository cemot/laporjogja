<?php
class ex_lihat_data extends super_controller {
    var $controller ;

    function ex_lihat_data(){
        parent::__construct();
         
        $this->load->model("coremodel","cm");
        // $this->load->helper("tanggal");
        $this->load->model("ex_lihat_data_model","dm");
        // $this->load->model("admindik_lap_a_model","xm");
        $this->controller = get_class($this);
        $this->userdata = $_SESSION['userdata'];

    }







function index(){
		$data_array=array();
        $userdata = $_SESSION['userdata'];

        
		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("Data Hasil Import");
		$this->set_title("Data Hasil Import");
		$this->set_content($content);
		$this->render();
}











    function get_data() {

    	

        // $this->db->select('nama_file, COUNT(nama_file) as total');
        // $this->db->group_by('nama_file'); 
        // $this->db->order_by('total', 'desc'); 
        // $group = $this->db->get('stck_non_provite')->result_array();
        // // echo $this->db->last_query();
        // foreach ($group as $row) {
        //     echo $row['nama_file'];
        //     echo $row['total'];
        // }
        // exit;
    	// show_array($userdata);

    	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:0; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"asc"; // get the direction if(!$sidx) $sidx =1;  
        
        $tgl_masuk = $_REQUEST['columns'][1]['search']['value'];
        $tgl_ekspirasi = $_REQUEST['columns'][2]['search']['value'];
        $asal_upt = $_REQUEST['columns'][3]['search']['value'];
        $nama = $_REQUEST['columns'][4]['search']['value'];

        $userdata = $_SESSION['userdata'];



        // show_array($userdata);exit();
      //  order[0][column]
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null,
                "tgl_masuk" => flipdate($tgl_masuk),
                "tgl_ekspirasi" => flipdate($tgl_ekspirasi),
				"asal_upt" => $asal_upt,
                "nama" => $nama,
				
				 
		);     
           
        $row = $this->dm->data($req_param)->result_array();
        // echo $this->db->last_query();exit;
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->data($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		// $daft_id = $row['daft_id'];
        $id = $row['id'];
        
        
        	$arr_data[] = array(
                $row['no_reg'],
        		$row['nama'],
                $row['hukuman'],
                flipdate($row['tgl_masuk']),
                flipdate($row['tgl_ekspirasi']),
                
                $row['asal_upt'],
                $row['pasal_kejahatan'],
        		
         			 
        		  				);
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
    }

    










	

}

?>