<?php
class lantas_kendaraan extends lantas_controller {
 	var $controller ;

	function __construct(){
		parent::__construct();
		 
		$this->load->model("coremodel","cm");
		$this->load->library("session");
		// $this->load->helper("tanggal");
		// $this->load->model("ex_lap_a_model","dm");
		// $this->load->model("admindik_lap_a_model","xm");
		$this->controller = get_class($this);
		$this->userdata = $_SESSION['userdata'];


	}




function index(){
		$data_array=array();

		$sql = "select 'lap_a' lp,
			kendaraan_nopol, kendaraan_pemilik, kendaraan_no_rangka, kendaraan_no_mesin, kendaraan_merk, kendaraan_model, kendaraan_warna, kendaraan_no_bpkb, kendaraan_pemilik_alamat, kendaraan_jenis, kendaraan_tahun, kendaraan_jumlah_roda 

			from lap_a
			where is_ranmor = 1 
			union 
			select 'lap_b' lp,
			kendaraan_nopol, kendaraan_pemilik, kendaraan_no_rangka, kendaraan_no_mesin, kendaraan_merk, kendaraan_model, kendaraan_warna, kendaraan_no_bpkb, kendaraan_pemilik_alamat, kendaraan_jenis, kendaraan_tahun, kendaraan_jumlah_roda 

			from lap_b
			where is_ranmor = 1";


		$data_array['record'] = $this->db->query($sql);





		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("DATA KENDARAAN DALAM LAPORAN KEPOLISIAN");
		$this->set_title("DATA KENDARAAN DALAM LAPORAN KEPOLISIAN");
		$this->set_content($content);
		$this->render();
}


function convert_tanggal($tgl) {
	$arr_bulan=array(1=>"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

	$arr_bulan = array_flip($arr_bulan);

	$tmp = explode("-",$tgl);
	$bln_angka = $arr_bulan[$tmp[1]];
	$res = $tmp[2]."-".$bln_angka."-".$tmp[0];
	return $res;
}


function import(){
	$userdata = $_SESSION['userdata'];
	$config['upload_path'] = './temp_upload/';
	$this->db->where('id_user', $userdata['user_id']);
	$this->db->delete('temp_main');
	
	if(!is_uploaded_file($_FILES['xlsfile']['tmp_name'])) {
			$ret = array("error"=>true,'pesan'=>"error");
			echo json_encode($ret);
			redirect(site_url('import_data'));
		}
	else {
		$full_path = $config['upload_path']. date("dmYhis")."_".$_FILES['xlsfile']['name'];
		copy($_FILES['xlsfile']['tmp_name'],$full_path);
		$this->load->library('excel');

		$objPHPExcel = PHPExcel_IOFactory::load($full_path);
		$arr_data = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);	

		
		$filename = $_FILES['xlsfile']['name'];
		

		$i=1;


		// echo "jumlah data ". count($arr_data);

		// show_array($arr_data); 
		// exit;

		$hasil = array();

		$tmpar = array();

		foreach($arr_data   as  $index =>  $data) : 
			//echo "index $index <br />" ;
			// show_array($data);
		// echo $i.'<br />';
		// echo $data[$i]['A'] . '<br />'; 
		$i++;
		
		if($index <= 2)  continue;

		// $nama_pekerjaan = ;
		// $pekerjaan = ;
		// $id_pekerjaan = $pekerjaan;
		// echo $id_pekerjaan;exit;	

			$hasil = array(
			 
		
		"no_reg" 				=>$data['B'],
		"asal_upt" 					=>$data['C'],
		"nama" 				=>$data['D'],
		"nama_alias" 					=>$data['E'],
		"pasal_kejahatan" 					=>$data['F'],
		"tgl_masuk" 					=> $this->convert_tanggal($data['G']),
		"hukuman" 			=>$data['H'],
		"tgl_ekspirasi" 					=> $this->convert_tanggal($data['I']),
		"status" 	=>$data['J'],
		"verifikasi" 			=>$data['K'],
		"id_user" => $userdata['user_id'],
		"jenis_perubahan" => 'T',
		
					);

			 $this->db->insert('temp_main', $hasil);

		$tmpar[] = $hasil;
			endforeach;

			// echo "berapa jumlahnya " . count($tmpar);
			// show_array($tmpar);  //exit;

				$xdata = $hasil;
				// $this->session->set_userdata('agu', $xdata);
				// $userdata = $this->session->userdata('agu');
				// show_array($userdata);exit;
				// $_SESSION['xdata'] = $xdata;
				$arrdata['title'] = "IMPORT DATA";
				$this->db->where('id_user', $userdata['user_id']);
		 		$arrdata['data'] = $this->db->get('temp_main')->result_array();
		 		$arrdata['controller'] = "import_data";
			   	$content = $this->load->view($this->controller."_preview",$arrdata,true);
		}

		// show_array($penduduk);
		//exit();

			$this->set_subtitle("Data Import");
			$this->set_title("Data Import");
			$this->set_content($content);
			$this->render();

}


function save(){

		
		$userdata = $_SESSION['userdata'];
		// $tes = $this->session->userdata("hello");
		// show_array($hasil_data); exit;

		// session_start();
		// show_array($_POST['data']);exit();
		$post = $this->input->post();
		// echo "jumlah ". count($post['data']);
		// show_array($post); 
		// exit;

		// $xdata = $datalogin['xdata']; 
		
		$true = 0;
		$false = 0; 

		$arr_berhasil = array();
		$arr_gagal = array();

		if (!empty($post['data'])) {
			foreach($post['data'] as $index) : 
			
			$this->db->where('id', $index);
			$res = $this->db->get('temp_main')->row_array();
			$id = $res['id'];
			unset($res['id_user']);
			unset($res['id']);
			unset($res['jenis_perubahan']);
					
			// echo $res['no_reg'];
			// exit;
			$data_update = array();
			$this->db->where('no_reg', $res['no_reg']);
			$res2 = $this->db->get('main');

			$baris = $res2->num_rows();
			// echo $this->db->last_query();
			// exit();
			if ($baris>=1) {
				$update = $res2->row_array();
				
				// show_array($update);
				// echo "FUCK";
				// exit;
				$this->db->where('id', $update['id']);
				$this->db->update('main', $res);
				$data_update = array('jenis_perubahan' => 'U' );
				$this->db->where('id', $id);
				$this->db->update('temp_main', $data_update);
			}else{
				
				
				$this->db->insert('main', $res);

				$data_update = array('jenis_perubahan' => 'S' );
				$this->db->where('id', $id);
				$this->db->update('temp_main', $data_update);
			}



				
				
			
			
			endforeach;
		}

		

		// exit;
				

				$this->db->where('jenis_perubahan', 'S');
				$this->db->where('id_user', $userdata['user_id']);
				$simpan = $this->db->get('temp_main')->num_rows();

				$this->db->where('jenis_perubahan', 'U');
				$this->db->where('id_user', $userdata['user_id']);
				$update = $this->db->get('temp_main')->num_rows();

				$this->db->where('jenis_perubahan', 'T');
				$this->db->where('id_user', $userdata['user_id']);
				$tidak_dipilih = $this->db->get('temp_main')->num_rows();
		
		 		
		 		$arrdata['simpan'] = $simpan;
		 		$arrdata['update'] = $update;
		 		$arrdata['tidak_dipilih'] = $tidak_dipilih;
		 		$arrdata['arr_berhasil'] = $arr_berhasil;
		 		$arrdata['arr_gagal'] = $arr_gagal;
		 		$arrdata['controller'] = "penduduk_import";
			   	$content = $this->load->view("import_data_result",$arrdata,true);
			   	$now = date('Y-m-d');
				$this->set_subtitle("Hasil Import Data Tanggal ".flipdate($now));
				$this->set_title("Hasil Import Data ");
				$this->set_content($content);
				$this->render();
	}







}

?>
