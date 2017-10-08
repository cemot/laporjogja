<?php
class admin_unit extends admin_controller {

	var $controller ;

	function __construct(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		// $this->load->helper("form");
		$this->load->model("admin_unit_model","dm");
		$this->controller = get_class($this);

	}

	function index(){
		// echo "fuckkk.."; exit;
		$userdata = $this->session->userdata("userdata");

		$controller = get_class($this);

 
		$data_array['controller'] = $controller;	 
 		 
		$content = $this->load->view($controller."_view",$data_array,true);

		$this->set_subtitle("DATA UNIT / PANIT");
		$this->set_title("DATA UNIT / PANIT");
		$this->set_content($content);
		$this->render_admin();
	}


function get_data(){
		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"nama_polres"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"asc"; // get the direction if(!$sidx) $sidx =1;  
        
        $nama = (isset($_REQUEST['columns'][1]['search']['value']))?$_REQUEST['columns'][1]['search']['value']:"";

        $jenis = (!empty($_REQUEST['columns'][2]['search']['value']))?$_REQUEST['columns'][2]['search']['value']:"x";

        $id_kesatuan = (!empty($_REQUEST['columns'][3]['search']['value']))?$_REQUEST['columns'][3]['search']['value']:"x";
        $id_subdit = (!empty($_REQUEST['columns'][4]['search']['value']))?$_REQUEST['columns'][4]['search']['value']:"x";
       
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null,
				"nama" =>$nama ,
				"jenis"=>$jenis,
				"id_kesatuan"=>$id_kesatuan,
				"id_subdit"=>$id_subdit
				 
				 
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
        	 
			$id = $row['id_unit'];
         
        	$arr_data[] = array(
        	$row['unit'],	
        	$row['subdit'],
        	$row['kesatuan'],
        	($row['jenis']=="polda")?"POLDA":"POLRES/POLSEK",
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


 


function simpan(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		 
		$this->form_validation->set_rules('unit','Unit/Panit','required'); 
		 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			 
			// unset($data['id_kesatuan']);
			// unset($data['id_subdit']);
			unset($data['jenis']);
			unset($data['id_kesatuan']);

			$data['id_unit'] = md5(microtime()); 
			 

			 
			 $res = $this->db->insert("m_unit",$data);
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




 

function update(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('unit','Unit/Panit','required'); 		 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			 
			 
			 


			 unset($data['jenis']);
			 unset($data['id_kesatuan']);

			 $this->db->where("id_unit",$data['id_unit']);
			 $res = $this->db->update("m_unit",$data);

			 // $this->db->last_query();
			 

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
	
function hapus(){
	$data = $this->input->post();
	$this->db->where("id_unit",$data['id']);
	$res = $this->db->delete("m_unit");
	if($res){
		$ret = array("error"=>false,"message"=>"Data Berhasi dihapus");

	}
	else {
		$ret = array("error"=>true,"message"=>"Data gagal dihapus");
	}
	echo json_encode($ret);
}

function get_json_detail($id){
	$data = $this->dm->detail($id)->row_array();
	// show_array($data);
	echo json_encode($data);
}

function get_kesatuan($jenis,$id_kesatuan) {
	$this->db->where("jenis",$jenis); 
	$this->db->order_by("kesatuan");
	$rs = $this->db->get("m_kesatuan");
	$arr= array();
	$sel="";
	foreach($rs->result() as $row) :
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		$sel=($row->id_kesatuan==$id_kesatuan)?"selected":"";
		echo "<option value=$row->id_kesatuan $sel>  $row->kesatuan </option>  ";
	endforeach;
}

function get_kesatuan_cari($jenis) {
	$this->db->where("jenis",$jenis); 
	$this->db->order_by("kesatuan");
	$rs = $this->db->get("m_kesatuan");
	$arr= array();
	echo "<option value='x'>= SEMUA = </option>";
	foreach($rs->result() as $row) :
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_kesatuan> $row->kesatuan </option>  ";
	endforeach;
}

function get_subdit_cari($jenis) {
	$this->db->where("id_kesatuan",$jenis); 
	$this->db->order_by("subdit");
	$rs = $this->db->get("m_subdit");
	$arr= array();
	echo "<option value='x'>= PILIH = </option>";
	foreach($rs->result() as $row) :
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_subdit> $row->subdit </option>  ";
	endforeach;
}


function get_subdit($jenis,$id_subdit) {
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

}
?>
