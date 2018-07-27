<?php
class lantas_kendaraan_a extends lantas_controller {
 	var $controller ;

	function __construct(){
		parent::__construct();
		 
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("lantas_kendaraan_a_model","dm");
		$this->controller = get_class($this);
		$this->userdata = $_SESSION['userdata'];

	}

	function hapus_session(){
	
		$this->session->unset_userdata("temp_lap_a_id");
	}

	function index(){
		// echo "fuckkk.."; exit;
		$userdata = $_SESSION['userdata'];

		// show_array($userdata); exit;
		$controller = get_class($this);


		// $data['leasing_id'] = $userdata['leasing_id'];
		 


	 
		//show_array($data_array); exit;
		$data_array['controller'] = $controller;

	 

		//$data_array['status'] = ( isset($this->input->get('status'))?$this->input->get('status'):"0"; 
		//echo "uri .. ".$data_array['uri']; exit;
		$data_array['status'] = isset($_GET['status'])?$_GET['status']:'0';
		$content = $this->load->view($controller."_view",$data_array,true);

		$this->set_subtitle("DATA KENDARAAN DALAM LAPORAN KEPOLISIAN MODEL-A");
		$this->set_title("DATA KENDARAAN DALAM LAPORAN KEPOLISIAN MODEL-A");
		$this->set_content($content);
		$this->render();
	}


function get_data(){
		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = !empty($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"1"; // get index row - i.e. user click to sort 
        $sord = !empty($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        $tanggal_awal = $_REQUEST['columns'][1]['search']['value'];
        $tanggal_akhir = $_REQUEST['columns'][2]['search']['value'];
        $id_fungsi = $_REQUEST['columns'][3]['search']['value'];

        $pelapor_nama = $_REQUEST['columns'][4]['search']['value'];
        $nomor = $_REQUEST['columns'][5]['search']['value'];


      //  order[0][column]


        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null ,
				"tanggal_awal" => $tanggal_awal, 
				"tanggal_akhir" => $tanggal_akhir, 
				"id_fungsi" => $id_fungsi , 
				"userdata" => $this->userdata,
				"pelapor_nama" => $pelapor_nama,
				"nomor" => $nomor
				 
		);     
           
        $row = $this->dm->data($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->data($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
$id = $row['lap_a_id'];
         
        	$arr_data[] = array(
        		 
								strtoupper($row['nomor']),
								flipdate($row['tanggal']),
								strtoupper($row['kendaraan_nopol']),
								flipdate($row['tanggal']),
								strtoupper($row['pelapor_nama']),
								strtoupper($row['terlapor']),
								strtoupper($row['tindak_pidana']),
								 ($row['uploaded']==1)?"<i class=\"fa fa-check\"></i>":"",

								
        		  			 "
        		  			 <a class=\"btn btn-primary\" href=\" " . site_url("$controller/detail/".$id) ."\"> Detail </a>

        		  			 "
        		  			  
 //        		  				"<div class=\"btn-group\"> 
 //     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
 //     <ul class=\"dropdown-menu\">
	// 	<li><a  href=\" " . site_url("$controller/edit/".$id) ."\" ><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li>
	// 	<li><a  href=\" " . site_url("$controller/detail/".$id) ."\" ><span class=\"glyphicon glyphicons-article\"></span> Detail </a></li>

	// 	<li><a  href='#' onclick=\"hapus('". $id ."')\" ><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 // 	 </ul>


	// </div> "
        		  				);
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
    }


  

function detail($id){

	$detail = $this->dm->detail($id);

	// show_array($detail); exit;
	
	$detail['tanggal'] = flipdate($detail['tanggal']);
	$detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	$detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);

	
	$detail['controller'] = $this->controller;


	//show_array($detail);
	$content = $this->load->view($detail['controller']."_view_detail",$detail,true);
	$this->set_subtitle("DETAIL LAPORAN POLISI MODEL-A NOMOR : ".$detail['nomor']);
	$this->set_title("DETAIL  LAPORAN  POLISI MODEL-A NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render();


}

function get_detail_json($id) {
	$detail = $this->dm->detail($id);
	$detail['tanggal'] = flipdate($detail['tanggal']);
	$detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	$detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);
	// show_array($detail); exit;
	echo json_encode($detail);
}
 
function upload($lap_a_id){

	$this->db->where("lap_a_id",$lap_a_id);
	$detail = $this->db->get("lap_a")->row_array();



	$detail['controller'] = $this->controller;


	//show_array($detail);
	$content = $this->load->view($detail['controller']."_view_upload",$detail,true);
	$this->set_subtitle("UPLOAD BERKAS LAPORAN  NOMOR :   ".$detail['nomor']. ". NOMOR POLISI : ".$detail['kendaraan_nopol']);
	$this->set_title("UPLOAD BERKAS  LAPORAN  NOMOR :  ".$detail['nomor']. ". NOMOR POLISI : ".$detail['kendaraan_nopol']);
	$this->set_content($content);
	$this->render();

}


function update_upload(){
		$post = $this->input->post();

		$this->db->where("lap_a_id",$post['lap_a_id']);
		$res = $this->db->update("lap_a",array("uploaded"=>1));
		if($res) {
			$ret = array("error"=>false,"message"=>"Data Berhasil diupload");
		}
		else {
			$ret = array("error"=>true,"message"=>"Data gagal diupload");
		}

		echo json_encode($ret);
}


}
?>
