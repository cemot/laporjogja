<?php
class admindik_penyidik extends admindik_controller {

	var $controller ;

	function __construct(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("penyidik_model","dm");
		$this->controller = get_class($this);

	}

	function index(){
		// echo "fuckkk.."; exit;
		$userdata = $this->session->userdata("userdata");

		$controller = get_class($this);

 
		$data_array['controller'] = $controller;	 
 		 
		$content = $this->load->view($controller."_view",$data_array,true);

		$this->set_subtitle("DATA PENYIDIK");
		$this->set_title("DATA PENYIDIK");
		$this->set_content($content);
		$this->render_admin();
	}


function get_data(){
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
        $id_kesatuan = (!empty($_REQUEST['columns'][2]['search']['value']))?$_REQUEST['columns'][2]['search']['value']:"x"; 
        $id_subdit = (!empty($_REQUEST['columns'][3]['search']['value']))?$_REQUEST['columns'][3]['search']['value']:"x"; 
        $id_unit = (!empty($_REQUEST['columns'][4]['search']['value']))?$_REQUEST['columns'][4]['search']['value']:"x"; 


      //  order[0][column]

        $userdata = $_SESSION['userdata'];
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null,
				"nama" =>$nama,
				// "level"=>($level == "")?"x":$level,
				"userdata" => $userdata, 
				"id_kesatuan" => $id_kesatuan,
				"id_subdit" => $id_subdit, 
				"id_unit" => $id_unit
				 
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
        	 
			$id = $row['id'];
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
			$polres_polsek 	 = "POLDA ";
			}
         
        	$arr_data[] = array(
        		 
        		  			 	
        		  				 
        		  				$row['user_id'], 
        		  				$row['nama'], 
        		  				$row['pangkat'],

 								$polres_polsek,

        		  				$row['nomor_hp'], 
        		  				$row['email'], 
        		  				 
        		  				 
        		  			  
        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a '#'  onclick=\"edit('". $id ."')\" ><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li>
		<li><a  href='#' onclick=\"hapus('". $id ."')\" ><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 	 </ul>


	</div> "
        		  				);
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
    }



function baru(){

		$data['action']="simpan";
		$data['mode']="I";
		$data['arr_pangkat'] = $this->cm->get_arr_dropdown('pangkat','pangkat_id','pangkat_nama','pangkat_nama');
		
		$data['controller'] = $this->controller;
		$content = $this->load->view($this->controller."_view_form",$data,true);
		$this->set_subtitle("INPUT DATA PANGKAT");
		$this->set_title("PANGKAT");
		$this->set_content($content);
		$this->render_admin();
	 
} 


function cek_pass($pass) {
	$pass2 = $_POST['user_pass2'];

	if($pass == "" or $pass2 == "") {
		$this->form_validation->set_message('cek_pass', ' %s Harus diisi ');
		return false;
	}


	if($pass <> $pass2) {
		$this->form_validation->set_message('cek_pass', ' %s Tidak sama ');
		return false;
	}
}

function cek_user_id($user_id) {
	$this->db->where("user_id",$user_id);
	$res = $this->db->get("pengguna");
	if($res->num_rows() > 0 ) {
		$this->form_validation->set_message('cek_user_id', ' %s Sudah Ada');
		return false;
	}
}

function simpan(){





		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_id','Username / NRP','callback_cek_user_id');	
		$this->form_validation->set_rules('user_pass','Password','callback_cek_pass'); 
		 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			 
			unset($data['id']);
			unset($data['user_pass2']);

			unset($data['id_subdit']);

			$data['user_pass'] = md5($data['user_pass']);

			$data['level'] = 2;
			$data['id'] = md5(microtime());



			$userdata = $_SESSION['userdata'];

			if($userdata['jenis'] == "polda") {
				$data['jenis'] = 'polda';

			}
			if($userdata['jenis'] == "polres") {
				$data['jenis'] = 'polres';
				$data['id_polres'] = $userdata['id_polres'];
			}
			if($userdata['jenis'] == "polsek") {
				$data['jenis'] = 'polsek';
				$data['id_polsek'] = $userdata['id_polsek'];
			}



			 $res = $this->db->insert("pengguna",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan","mode"=>"I");
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





function edit($id){
		 
		$data = $this->dm->detail($id)->row_array(); 
		//$data = $arr['message'];
		$data['action']="update";
		$data['mode']="U";
		$data['arr_pangkat'] = $this->cm->get_arr_dropdown('pangkat','pangkat_id','pangkat_nama','pangkat_nama');
		
		$data['controller'] = $this->controller;
		$content = $this->load->view($this->controller."_view_form",$data,true);
		
		$this->set_subtitle("EDIT DATA PELAKSANA");
		$this->set_title("EDIT DATA PELAKSANA");
		$this->set_content($content);
		$this->render_baru();
	}

function update(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_id','Username / NRP','required');	 
		 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			 
			 
			unset($data['user_pass2']);

			if($data['user_pass'] == "") {
				unset($data['user_pass2']);
				unset($data['user_pass']);
			}
			else {
				$data['user_pass'] = md5($data['user_pass']);
			}



			 $this->db->where("id",$data['id']);
			 $res = $this->db->update("pengguna",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message(),"mode"=>"U");
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}
	

function get_json_detail($id){
	$data = $this->dm->detail($id)->row_array();
	// show_array($data);
	echo json_encode($data);
}


function get_subdit($jenis) {

	$id_subdit = $this->uri->segment(4);

	$this->db->where("id_kesatuan",$jenis); 
	$this->db->order_by("subdit");
	$rs = $this->db->get("m_subdit");
	$arr= array();
	echo "<option value='x'>= PILIH  = </option>";
	$sel="";
	foreach($rs->result() as $row) :
		$sel=($row->id_subdit==$id_subdit)?"selected":"";
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_subdit $sel> $row->subdit </option>  ";
	endforeach;
}



function get_unit($jenis) {

	$id_unit = $this->uri->segment(4);

	$this->db->where("id_subdit",$jenis); 
	$this->db->order_by("unit");
	$rs = $this->db->get("m_unit");
	$arr= array();
	echo "<option value='x'>= PILIH  = </option>";
	$sel="";
	foreach($rs->result() as $row) :
		$sel=($row->id_unit==$id_unit)?"selected":"";
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_unit $sel> $row->unit </option>  ";
	endforeach;
}


function get_subdit_cari($jenis) {

	$id_subdit = $this->uri->segment(4);

	$this->db->where("id_kesatuan",$jenis); 
	$this->db->order_by("subdit");
	$rs = $this->db->get("m_subdit");
	$arr= array();
	echo "<option value='x'>= SEMUA  = </option>";
	$sel="";
	foreach($rs->result() as $row) :
		$sel=($row->id_subdit==$id_subdit)?"selected":"";
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_subdit $sel> $row->subdit </option>  ";
	endforeach;
}



function get_unit_cari($jenis) {

	$id_unit = $this->uri->segment(4);

	$this->db->where("id_subdit",$jenis); 
	$this->db->order_by("unit");
	$rs = $this->db->get("m_unit");
	$arr= array();
	echo "<option value='x'>= SEMUA  = </option>";
	$sel="";
	foreach($rs->result() as $row) :
		$sel=($row->id_unit==$id_unit)?"selected":"";
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_unit $sel> $row->unit </option>  ";
	endforeach;
}

}
?>
