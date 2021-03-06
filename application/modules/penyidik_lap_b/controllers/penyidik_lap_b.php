<?php
class penyidik_lap_b extends penyidik_controller {
 	var $controller ;

	function __construct(){
		parent::__construct();
		 
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("admindik_lap_b_model","dm");
        $this->load->model("penyidik_lap_b_model","am");
		$this->controller = get_class($this);
		$this->userdata = $_SESSION['userdata'];

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

		$this->set_subtitle("LAPORAN POLISI MODEL-B");
		$this->set_title("LAPORAN  POLISI MODEL-B");
		$this->set_content($content);
		$this->render_admin();
	}


function get_data(){
		$controller = get_class($this);
	 	$userdata = $this->userdata;
        //show_array($userdata); exit;
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"level"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        $tanggal_awal = $_REQUEST['columns'][1]['search']['value'];
        $tanggal_akhir = $_REQUEST['columns'][2]['search']['value'];
        $id_fungsi = $_REQUEST['columns'][3]['search']['value'];


      //  order[0][column]
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null ,
				"tanggal_awal" => $tanggal_awal, 
				"tanggal_akhir" => $tanggal_akhir, 
				"id_fungsi" => $id_fungsi,
                "id_penyidik" => $userdata['id']
				 
		);     
           
        $row = $this->am->data($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->am->data($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
$id = $row['lap_b_id'];
         
        	$arr_data[] = array(
        		 
								$row['nomor'],
								flipdate($row['tanggal']),
								$row['pelapor_nama'],
								$row['terlapor'],
								$row['tindak_pidana'],								 
        		  			 	($row['nama_penyidik']=="")?"<span style='color:red;'>BELUM ADA</span>":$row['nama_penyidik'], 
        		  			  
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
	$detail['tanggal'] = flipdate($detail['tanggal']);
	// $detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	// $detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);

    $detail['lap_b_id'] = $id;

    $_SESSION['lap_b_id'] = $id;

    // show_array($detail); exit;

	
	$detail['controller'] = $this->controller;

	$detail['rec_pasal'] = $this->dm->get_pasal($id);
	$detail['rec_tersangka'] = $this->dm->get_tersangka($id);
    $detail['rec_saksi'] = $this->dm->get_saksi($id);
    $detail['rec_korban'] = $this->dm->get_korban($id);
    $detail['rec_barbuk'] = $this->dm->get_barbuk($id);


	

	//show_array($detail);
	$content = $this->load->view($this->controller."_view_detail",$detail,true);
	$this->set_subtitle("DETAIL LAPORAN POLISI MODEL-B NOMOR : ".$detail['nomor']);
	$this->set_title("DETAIL  LAPORAN  POLISI MODEL-B NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_admin();


}
 
   

/// korban section 


function get_data_penyidik($lap_b_id){
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
                "lap_b_id" => $lap_b_id
                
                 
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
 





function get_data_perkembangan($lap_b_id){
        $controller = get_class($this);
        $userdata = $this->session->userdata("userdata");
        $draw = $_REQUEST['draw']; // get the requested page 
        $start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = ($_REQUEST['order'][0]['column']=="0")?"2":$_REQUEST['order'][0]['column']; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"asc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $nama = (isset($_REQUEST['columns'][1]['search']['value']))?$_REQUEST['columns'][1]['search']['value']:"";
        // $level = (isset($_REQUEST['columns'][1]['search']['value']))?$_REQUEST['columns'][2]['search']['value']:"x";
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        $nama = $_REQUEST['columns'][1]['search']['value'];
        $level = $_REQUEST['columns'][2]['search']['value'];


      //  order[0][column]
        $userdata = $_SESSION['userdata'];
        $req_param = array (
                "sort_by" => $sidx,
                "sort_direction" => $sord,
                "limit" => null,
                "lap_b_id" => $lap_b_id,
                "userdata" => $userdata
                
                 
        );     
           
        $row = $this->am->get_data_perkembangan($req_param)->result_array();
        
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->am->get_data_perkembangan($req_param)->result_array();
        

       
        $arr_data = array();
        $n=0;
        foreach($result as $row) : 
            $n++;
           
            $filename = $row['file_dokumen']; 

            if(empty($row['file_dokumen']) or !file_exists("./documents/".$row['file_dokumen']) ) {
                $filelink = "-";
            } 
            else {
                // anchor("general/getdokumen/".$row['file_dokumen'],$row['file_dokumen']).
                // $filelink= " <a href=javascript:hapus_dokumen('$id') title='Hapus Dokumen'> 
                //     <img src='".base_url("assets/images/delete.png")."'>
                // </a>";
                $filelink =  '<a target="blank" href="'.base_url("documents/$filename").'"> '.$row['file_dokumen'].' </a> ';
            }

             
            $id = $row['id'];
            $row['lidik']  = ($row['lidik']=="1")?"Penyidikan":"Penyelidikan";
         
            $arr_data[] = array(
                $n,
                flipdate($row['tanggal']), 
                $row['no_urut'], 
                $row['lidik'], 
                $row['tahap'], 
                $row['no_dokumen'],            
                
                $row['keterangan'], 
                $filelink, 
                
                // (empty($row['file_dokumen']))?"-":anchor("general/getdokumen/".$row['file_dokumen'],$row['file_dokumen']). " <a href=javascript:hapus_dokumen('$id') title='Hapus Dokumen'> 
                //     <img src='".base_url("assets/images/delete.png")."'>
                // </a>",
                                 
                                 
                                 
                              
                               "<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
        <li><a '#'  onclick=\"perkembangan_edit('". $id ."')\" ><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li>
          <li><a target='blank'  href='".site_url("$this->controller/cetak_perkembangan/$id")."')\" ><span class=\"glyphicon glyphicon-print\"></span> Cetak </a></li>

        <li><a  href='#' onclick=\"perkembangan_hapus('". $id ."')\" ><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
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





function perkembangan_simpan(){
        $data=$this->input->post();

 

        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tanggal','Tanggal','required'); 
        // $this->form_validation->set_rules('id_pasal','Pasal','required');
         
        $this->form_validation->set_message('required', ' %s Harus diisi ');
        
        $this->form_validation->set_error_delimiters('', '<br>');
        if($this->form_validation->run() == TRUE ) { 

            if($data['id_pn'] == "x"){
                unset($data['id_pn']);
            }
            if($data['id_lapas'] == "x"){
                unset($data['id_lapas']);
            }
            



            /// upload the file 
            if(! empty($_FILES['file_dokumen']['name']) ) {
                    $config['upload_path'] = './documents/';
                    $config['allowed_types'] = 'jpg|jpeg|png|pdf|xlsx|doc|docx';
                    $config['max_size'] = '2048';
                    // $config['max_width']  = '1024000';
                    // $config['max_height']  = '76800000';
                    $this->load->library('upload',$config);
                    if ( ! $this->upload->do_upload('file_dokumen'))
                    {    
                        $error = array('error' => $this->upload->display_errors()); 

                        //show_array($error);
                         
                        $ret = array("success"=>false,
                                    "message"=>"File terlalu besar  atau extens file tidak sesuai ".$error['error'],
                                    "operation" =>"insert");
                        echo json_encode($ret);
                        exit;
                    }
                    else {
                        $arr = $this->upload->data();
                     
                        
                         
                        $data['file_dokumen'] = $arr['file_name'];
                         
                    }
            }

            // end of upload file 








            unset($data['id']);

            


            $data['tanggal'] = flipdate($data['tanggal']);
           
            //$data['user_id'] = $userdata['id'];

             $data['id'] = md5(microtime(). rand(0,999999) );

             $res = $this->db->insert("lap_b_perkembangan",$data);

             $lap_b_id = $this->db->insert_id();

             if($res) {

                 $ret = array("error"=>false,"message"=>"data perkembangan berhasil disimpan");

                 if($data['proses_penyidikan']=="YA") {

                    $arr = array("lap_b_id"=>$data['lap_b_id'],
                            "penyelesaian"=>"lidik");

                    $this->db->where("lap_b_id",$data['lap_b_id']);
                    $rx = $this->db->update("lap_b",$arr);

                }


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


function perkembangan_update(){
        $data=$this->input->post();

 

        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tanggal','Tanggal','required'); 
        // $this->form_validation->set_rules('id_pasal','Pasal','required');
         
        $this->form_validation->set_message('required', ' %s Harus diisi ');
        
        $this->form_validation->set_error_delimiters('', '<br>');
        if($this->form_validation->run() == TRUE ) { 
            



            /// upload the file 
            if(! empty($_FILES['file_dokumen']['name']) ) {
                    $config['upload_path'] = './documents/';
                    $config['allowed_types'] = 'jpg|jpeg|png|pdf|xlsx|doc|docx';
                    $config['max_size'] = '2048';
                    // $config['max_width']  = '1024000';
                    // $config['max_height']  = '76800000';
                    $this->load->library('upload',$config);
                    if ( ! $this->upload->do_upload('file_dokumen'))
                    {    
                        $error = array('error' => $this->upload->display_errors()); 

                        //show_array($error);
                         
                        $ret = array("success"=>false,
                                    "message"=>"File terlalu besar  atau extens file tidak sesuai ".$error['error'],
                                    "operation" =>"insert");
                        echo json_encode($ret);
                        exit;
                    }
                    else {
                        $arr = $this->upload->data();
                     
                        
                         
                        $data['file_dokumen'] = $arr['file_name'];
                         
                    }
            }
            else {
                unset($data['file_dokumen']);
            }

           $data['tanggal'] = flipdate($data['tanggal']);
           
            //$data['user_id'] = $userdata['id'];

            // show_array($data);

            $this->db->where("id",$data['id']);
           


           // show_array($data); exit;
            
            
            $res = $this->db->update("lap_b_perkembangan",$data);

            // echo $this->db->last_query(); exit;

             

             if($res) {
                $ret = array("error"=>false,"message"=>"data perkembangan berhasil disimpan");

                // update ke laporan 
                $this->db->where("lap_b_id",$data['lap_b_id']);
                $this->db->where("proses_penyidikan","YA");
                $jumlah = $this->db->get("lap_b_perkembangan")->num_rows();

                if($jumlah == 0 ){ // kembalikan ke sidik 

                    $arr = array("lap_b_id"=>$data['lap_b_id'],
                            "penyelesaian"=>"sidik");

                    $this->db->where("lap_b_id",$data['lap_b_id']);
                    $rx = $this->db->update("lap_b",$arr);
                }
                else {
                    $arr = array("lap_b_id"=>$data['lap_b_id'],
                            "penyelesaian"=>"lidik");

                    $this->db->where("lap_b_id",$data['lap_b_id']);
                    $rx = $this->db->update("lap_b",$arr);
                }
                


                 

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

    
function perkembangan_hapus(){
    $data = $this->input->post();

    $this->db->where("id",$data['id']);
    $dpk = $this->db->get("lap_b_perkembangan")->row();
    $lap_b_id = $dpk->lap_b_id;

    // echo $this->db->last_query(); exit;


    $this->db->where("id",$data['id']);
    $res = $this->db->delete("lap_b_perkembangan");
    if($res){
        $ret = array("error"=>false,"message"=>"Data Berhasi dihapus");


        $this->db->where("lap_b_id",$lap_b_id);
        $this->db->where("proses_penyidikan","YA");
        $jumlah = $this->db->get("lap_b_perkembangan")->num_rows();

        // echo $this->db->last_query();
        // exit;

        if($jumlah == 0 ){ // kembalikan ke sidik 

            $arr = array("lap_b_id"=>$lap_b_id,
                    "penyelesaian"=>"sidik");

            $this->db->where("lap_b_id",$lap_b_id);
            $rx = $this->db->update("lap_b",$arr);
        }
        else {
            $arr = array("lap_b_id"=>$lap_b_id,
                    "penyelesaian"=>"lidik");

            $this->db->where("lap_b_id",$lap_b_id);
            $rx = $this->db->update("lap_b",$arr);
        }


    }
    else {
        $ret = array("error"=>true,"message"=>"Data gagal dihapus");
    }
    echo json_encode($ret);
}


function get_perkembangan_detail_json($id){
    $detail = $this->am->get_perkembangan_detail_json($id);
    // show_array($detail);
    $detail['tanggal'] = flipdate($detail['tanggal']);
    echo json_encode($detail);
}



function update_penyelesaian(){
    $userdata = $this->userdata;
    $post = $this->input->post();
    $this->db->where("lap_b_id",$_SESSION['lap_b_id']);

    if($post['penyelesaian']=="p21"){
        unset($post['alasan']);
    }
    $post['penyelesaian_waktu'] = date("Y-m-d");
    $post['penyelesaian_by'] = $userdata['id'];

    $res = $this->db->update("lap_b",$post);

    // echo $this->db->last_query();

    if($res){
        $ret = array("error"=>false,"message"=>"Penyelesaian laporan berhasil diupdate");

    }
    else {
        $ret = array("error"=>true,"message"=>"Penyelesaian Laporan berhasil diupdate");
    }
    echo json_encode($ret);

}


function get_lap_b_detail($id){
    $this->db->where("lap_b_id",$id);
    $data = $this->db->get("lap_b")->row_array();

    echo json_encode($data);

}



function perkembangan_hapus_dokumen() {
    $post = $this->input->post();
    $id = $post['id'];

    $this->db->where("id",$id);
   // $dokumen = $this->db->get("lap_b_perkembangan")->row();

    $arr=array("file_dokumen"=>"");

    $this->db->where("id",$id);
    $res = $this->db->update("lap_b_perkembangan",$arr);

    if($res) {
        $ret = array("error"=>false,"message"=>"Dokumen berhasil dihapus");
    }
    else {
        $ret = array("error"=>true,"message"=>"Dokumen gagal dihapus");
    }

    echo json_encode($ret);



}


function cetak_perkembangan($id) {
    $this->db->where("id",$id);
    $data = $this->db->get("lap_b_perkembangan")->row_array(); 

    $this->load->view("penyidik_lap_b_view_perkembangan_cetak",$data); 
}

function cetak_daftar_isi($lap_b_id) {
    $this->db->select('a.*,b.tahap')
    ->from('lap_b_perkembangan a'); 
    $this->db->join("m_tahap b","a.id_tahap = b.id","left");

                // "tanggal_awall" => $tanggal_awal, 
                // "tanggal_akhir" => $tanggal_akhir,
                // "id_fungsi" => $id_fungsi 

    $this->db->order_by("no_urut");

    

    
    $this->db->where("a.lap_b_id",$lap_b_id);
    $data['rec'] = $this->db->get(); 

    $this->load->view("penyidik_lap_b_view_perkembangan_daftar_isi",$data); 

}

function set_monitor($lap_b_id) {
    $post = $this->input->post(); 

    extract($post);
    // cek kesamaan dulu 
    $sql = "SELECT * FROM lap_b 
    WHERE mon_user='$mon_user'  
    AND lap_b_id <> '$lap_b_id'"; 

    $jumlah = $this->db->query($sql)->num_rows(); 

    if($jumlah > 0 ) {
        $arr = array("error"=>true,"message"=>"Username sudah digunakan");
        echo json_encode($arr); 
        exit;
    }


    $this->db->where("lap_b_id",$lap_b_id); 
    $res  = $this->db->update("lap_b",$post); 

    if($res) {
        $arr = array("error"=>false,"message"=>"Akses monitoring berhasil disimpan");
    }
    else {
        $arr = array("error"=>true,"message"=>"Akses monitoring gagal disimpan");
    }

    echo json_encode($arr); 
}


function get_template(){
    $post = $this->input->post(); 

    $this->db->where("id",$post['id']); 
    $data = $this->db->get("template_dokumen")->row_array(); 

    echo json_encode($data); 
}


function simpantemplate(){
    $post = $this->input->post(); 

    $res = $this->db->insert("template_dokumen",$post); 
    $id = $this->db->insert_id();
    if($res) {
        $arr = array("error"=>false,"message"=>"Data template berhasil disimpan");
        

        $this->db->order_by("nama"); 
        $rs  = $this->db->get("template_dokumen"); 
        $html = "<option value='x'> = TEMPLATE BARU = </option>";
        foreach($rs->result() as $row) : 
            $sel = ($row->id == $id)?"selected":"";
            $html .= "<option $sel value=$row->id> $row->nama </option>";
        endforeach;

        $arr['templateList'] = $html;

    }
    else {
        $arr = array("error"=>true,"message"=>"Data template gagal disimpan");
    }

    echo json_encode($arr); 
}

function updatetemplate() {
    $post = $this->input->post();
    $this->db->where("id",$post['id']);
    $res = $this->db->update("template_dokumen",$post); 
    if($res){
        $arr = array("error"=>false,"message"=>"Data template berhasil diupdate");
    }
    else {
        $arr = array("error"=>true,"message"=>"Data template berhasil diupdate");
    }
    echo json_encode($arr);
}

}
?>
