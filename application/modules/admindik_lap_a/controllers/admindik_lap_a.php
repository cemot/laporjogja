<?php
class admindik_lap_a extends admindik_controller {
 	var $controller ;

	function __construct(){
		parent::__construct();
		 
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("admindik_lap_a_model","dm");
		$this->controller = get_class($this);
		$this->userdata = $_SESSION['userdata'];

        //show_array($this->userdata); exit;

	}

 

	function index(){
		// echo "fuckkk.."; exit;
		$userdata = $this->session->userdata("userdata");

        


		$controller = get_class($this);


		// $data['leasing_id'] = $userdata['leasing_id'];
		 


	 
		//show_array($data_array); exit;
		$data_array['controller'] = $controller;

	 

		//$data_array['status'] = ( isset($this->input->get('status'))?$this->input->get('status'):"0"; 
		//echo "uri .. ".$data_array['uri']; exit;
		$data_array['status'] = isset($_GET['status'])?$_GET['status']:'0';
		$content = $this->load->view($controller."_view",$data_array,true);

		$this->set_subtitle("LAPORAN POLISI MODEL-A");
		$this->set_title("LAPORAN  POLISI MODEL-A");
		$this->set_content($content);
		$this->render_admin();
	}


function get_data(){
		$controller = get_class($this);
	 	$userdata = $_SESSION['userdata']; //$this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"level"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        $tanggal_awal = $_REQUEST['columns'][1]['search']['value'];
        $tanggal_akhir = $_REQUEST['columns'][2]['search']['value'];
        $id_fungsi = $_REQUEST['columns'][3]['search']['value'];
        $nomor = $_REQUEST['columns'][5]['search']['value'];
        $pelapor_nama = $_REQUEST['columns'][4]['search']['value'];


      //  order[0][column]
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null ,
				"tanggal_awal" => $tanggal_awal, 
				"tanggal_akhir" => $tanggal_akhir, 
				"id_fungsi" => $id_fungsi , 
                "userdata" => $userdata,
                "nomor" =>$nomor,
                "pelapor_nama"=>$pelapor_nama
                 
				 
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
								strtoupper($row['pelapor_nama']),
								strtoupper($row['terlapor']),
								strtoupper($row['tindak_pidana']),								 
        		  			 	($row['penyidik_nama']=="")?"<span style='color:red;'>BELUM ADA</span>":strtoupper($row['penyidik_nama']), 
        		  			  
        		  				" 
     <a class=\"btn btn-primary\" href=\" " . site_url("$controller/detail/".$id) ."\" >Detail </a>");
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

    $detail['lap_a_id'] = $id;

	
	$detail['controller'] = $this->controller;

	$detail['rec_pasal'] = $this->dm->get_pasal($id);
	$detail['rec_tersangka'] = $this->dm->get_tersangka($id);
    $detail['rec_saksi'] = $this->dm->get_saksi($id);
    $detail['rec_korban'] = $this->dm->get_korban($id);
    $detail['rec_barbuk'] = $this->dm->get_barbuk($id);
    $detail['rec_perkembangan'] = $this->dm->get_perkembangan($id);


	

	//show_array($detail);
	$content = $this->load->view($this->controller."_view_detail",$detail,true);
	$this->set_subtitle("DETAIL LAPORAN POLISI MODEL-A NOMOR : ".$detail['nomor']);
	$this->set_title("DETAIL  LAPORAN  POLISI MODEL-A NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_admin();


}
 
   

/// korban section 


function get_data_penyidik($lap_a_id){
        $controller = get_class($this);
        $userdata = $this->session->userdata("userdata");
        $draw = $_REQUEST['draw']; // get the requested page 
        $start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"nama"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"asc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $nama = (isset($_REQUEST['columns'][1]['search']['value']))?$_REQUEST['columns'][1]['search']['value']:"";
        // $level = (isset($_REQUEST['columns'][1]['search']['value']))?$_REQUEST['columns'][2]['search']['value']:"x";
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        $nama = $_REQUEST['columns'][1]['search']['value'];
        $level = $_REQUEST['columns'][2]['search']['value'];


      //  order[0][column]
        $req_param = array (
                "sort_by" => $sidx,
                "sort_direction" => $sord,
                "limit" => null,
                "lap_a_id" => $lap_a_id
                
                 
        );     
           
        $row = $this->dm->get_data_penyidik($req_param)->result_array();
        
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_data_penyidik($req_param)->result_array();
        

       
        $arr_data = array();
        
        foreach($result as $row) : 
        //$daft_id = $row['daft_id'];

            $koordinator = ($row['koordinator']==1)?"Ya":"Tidak";
             
            $id = $row['idlp'];
            $polres_polsek = "";

            //echo "jenis =". $row['jenis'] . "<br />";
            if($row['jenis']=='polsek') {

                //echo "WATTTDEFAAAAKKK"; 
                $polres_polsek = "POLSEK - ". $row['nama_polsek'];
            }
            else if($row['jenis']=='polres') {
                $polres_polsek = "POLRES - ". $row['nama_polres'];
            }
            else {
            $polres_polsek   = "POLDA ";
            }
         
            $arr_data[] = array(
                 
                                
                                 
                                $row['user_id'], 
                                $row['nama'], 
                                $koordinator,
                                $row['pangkat'],

                                $polres_polsek,

                                $row['nomor_hp'], 
                                $row['email'], 
                                 
                                 
                              
                                " 
         <a class='btn btn-danger'   href=\"javascript:penyidik_hapus('". $id ."')\" ><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a> "
                                );
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
                          'recordsTotal' => $count, 
                          'recordsFiltered' => $count,
                          'data'=>$arr_data
            );
         
        echo json_encode($responce); 
    }
 

 
// function cek_penyidik($id_penyidik)

function cek_penyidik($id_penyidik){
   $post = $this->input->post();

   $this->db->where("id_penyidik",$id_penyidik); 
   $this->db->where("lap_a_id",$post['lap_a_id']);
   $rs = $this->db->get("lap_a_penyidik");
   if($rs->num_rows() > 0 ) {
    $this->form_validation->set_message('cek_penyidik', ' %s Penyidik sudah ada.  ');
    return false;
   }

   $this->db->where("koordinator","1"); 
   $this->db->where("lap_a_id",$post['lap_a_id']);
   $rs = $this->db->get("lap_a_penyidik");
   if($rs->num_rows() > 0 and $post['koordinator'] == 1 ) {
    $this->form_validation->set_message('cek_penyidik', ' Koordinator sudah ada.  ');
    return false;
   }


}


function penyidik_simpan($lap_a_id){
        $data=$this->input->post();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_penyidik','Penyidik','callback_cek_penyidik'); 
         
                
         
        $this->form_validation->set_message('required', ' %s Harus diisi ');
        
        $this->form_validation->set_error_delimiters('', '<br>');
        if($this->form_validation->run() == TRUE ) { 

             
            unset($data['id']);

            $data['lap_a_id'] = $lap_a_id;
         

            $data['id'] = md5(microtime(). rand(0,999999) );

             $res = $this->db->insert("lap_a_penyidik",$data);
             if($res) {
                $ret = array("error"=>false,"message"=>"data penyidik berhasil disimpan","mode"=>"I");
             }
             else {
                $ret = array("error"=>true,"message"=>$this->db->_error_message());
             }
             
        }
        else {
            $ret = array("error"=>true,"message"=>validation_errors());
        }
        
        echo json_encode($ret);
        
    }


function penyidik_hapus(){
    $data = $this->input->post();
    $this->db->where("id",$data['id']);
    $res = $this->db->delete("lap_a_penyidik");

    // echo $this->db->last_query();
    if($res){
        $ret = array("error"=>false,"message"=>"Data Berhasi dihapus");

    }
    else {
        $ret = array("error"=>true,"message"=>"Data gagal dihapus");
    }
    echo json_encode($ret);
}

}
?>
