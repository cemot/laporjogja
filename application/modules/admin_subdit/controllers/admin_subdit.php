<?php
class admin_subdit extends admin_controller {

	var $controller ;

	function __construct(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		// $this->load->helper("form");
		$this->load->model("admin_subdit_model","dm");
		$this->controller = get_class($this);

	}

	function index(){
		// echo "fuckkk.."; exit;
		$userdata = $this->session->userdata("userdata");

		$controller = get_class($this);

 
		$data_array['controller'] = $controller;	 
 		 
		$content = $this->load->view($controller."_view",$data_array,true);

		$this->set_subtitle("DATA SUBDIT / UNIT");
		$this->set_title("DATA SUBDIT / UNIT");
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
				"id_kesatuan"=>$id_kesatuan
				 
				 
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
        	 
			$id = $row['id_subdit'];
         
        	$arr_data[] = array(
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
		 
		$this->form_validation->set_rules('subdit','Subdit/Unit','required'); 
		 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			 
			// unset($data['id_kesatuan']);
			unset($data['id_subdit']);
			unset($data['jenis']);

			$data['id_subdit'] = md5(microtime()); 
			 

			 
			 $res = $this->db->insert("m_subdit",$data);
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
		$this->form_validation->set_rules('subdit','Subdit/Unit','required'); 		 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			 
			 
			 


			 unset($data['jenis']);
			 $this->db->where("id_subdit",$data['id_subdit']);
			 $res = $this->db->update("m_subdit",$data);

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
	$this->db->where("id_subdit",$data['id']);
	$res = $this->db->delete("m_subdit");
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

function get_kesatuan($jenis) {
	$this->db->where("jenis",$jenis); 
	$this->db->order_by("kesatuan");
	$rs = $this->db->get("m_kesatuan");
	$arr= array();
	foreach($rs->result() as $row) :
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_kesatuan> $row->kesatuan </option>  ";
	endforeach;
}

function get_kesatuan_cari($jenis) {
	$this->db->where("jenis",$jenis); 
	$this->db->order_by("kesatuan");
	$rs = $this->db->get("m_kesatuan");
	$arr= array();
	echo "<option value='x'>== SEMUA TINGKAT == </option>";
	foreach($rs->result() as $row) :
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_kesatuan> $row->kesatuan </option>  ";
	endforeach;
}

}
?>
