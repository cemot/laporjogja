<?php
class ex_pencarian extends ex_controller {
// kesehatan,kekuatan, keturunan, masuk surga
	var $controller ;

	function ex_pencarian(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("ex_pencarian_model","dm");
		$this->controller = get_class($this);

		$this->userdata = $_SESSION['userdata'];

	}

	function index(){


// "operators" => array('equal', 'contains')
// "operators" => array('equal')

		$array = array(

			array(
		   	"id" => "laporan",
			"label" => "Jenis laporan",
			"type" => "string",
			"input" => "select",
			"values" =>  array(
								"lap_a"  => "LAPORAN TIPE A",
								"lap_b"  => "LAPORAN TIPE B",
								"lap_c"  => "LAPORAN TIPE C",
								"lap_d"  => "LAPORAN TIPE D",
								"lap_laka_latas"  =>  "LAPORAN LAKA LANTAS"),
			"operators" => array('equal')
		   	), 

			array(
		   	"id" => "pelapor_nama",
			"label" => "Nama pelapor / pemohon",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	), 

			array(
		   	"id" => "id_fungsi",
			"label" => "Fungsi Terkait",
			"type" => "string",
			"input" => "select",
			"values" => $this->cm->get_arr_dropdown("m_fungsi","id_fungsi","fungsi",'fungsi')
			,
			"operators" => array('equal')
			 
		   	), 


		   	array(
		   	"id" => "id_kelompok",
			"label" => "Kelompok Kejahatan",
			"type" => "string",
			"input" => "select",
			"values" => $this->cm->get_arr_dropdown("m_kelompok_kejahatan","id_kelompok","kelompok",'kelompok')
			,
			"operators" => array('equal')
			 
		   	), 


		   	array(
		   	"id" => "pasal",
			"label" => "Pasal",
			"type" => "string",			 
			"operators" => array('equal','contains')
			 
		   	), 



		   	array(
		   	"id" => "pelapor_umur",
			"label" => "Umur pelapor minimal",
			"type" => "string",			 
			"operators" => array('equal')			 
		   	), 
		   

		   array(
		   	"id" => "pelapor_umur2",
			"label" => "Umur pelapor maximal",
			"type" => "string",			 
			"operators" => array('equal')			 
		   	), 


		   array(
		   	"id" => "tersangka_umur",
			"label" => "Umur tersangka minimal",
			"type" => "string",			 
			"operators" => array('equal')			 
		   	), 
		   

		   array(
		   	"id" => "tersangka_umur2",
			"label" => "Umur tersangka maximal",
			"type" => "string",			 
			"operators" => array('equal')			 
		   	), 



		   array(
		   	"id" => "pelapor_id_pekerjaan",
			"label" => "Pekerjaan pelapor",
			"type" => "string",
			"input" => "select",
			"values" => $this->cm->get_arr_dropdown("m_pekerjaan","id_pekerjaan","pekerjaan",'pekerjaan')
			,
			"operators" => array('equal')
			 
		   	), 

		   array(
		   	"id" => "tersangka_id_pekerjaan",
			"label" => "Pekerjaan tersangka",
			"type" => "string",
			"input" => "select",
			"values" => $this->cm->get_arr_dropdown("m_pekerjaan","id_pekerjaan","pekerjaan",'pekerjaan')
			,
			"operators" => array('equal')
			 
		   	), 


		    array(
		   	"id" => "nomor",
			"label" => "Nomor Laporan",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	), 

		   
		   	array(
		   	"id" => "id_gol_kejahatan",
			"label" => "Golongan Kejahatan",
			"type" => "string",
			"input" => "select",
			"values" => $this->cm->add_arr_head($this->cm->get_arr_dropdown("m_golongan_kejahatan","id","golongan_kejahatan",'golongan_kejahatan'),'x','= SEMUA KEJAHATAN ==')
			,
			"operators" => array('equal')
			 
		   	), 


		   /*	array(
		   	"id" => "id_gol_kejahatan",
			"label" => "Golongan Kejahatan",
			"type" => "string",
			"input" => "select",
			"plugin" => 'selectize', 
			"plugin_config" => array(
					"valueField"       =>  "id",
					"labelField"       =>  "name",
					"searchField"       =>  "name",
					"sortField"       =>  "name",
					"create"       =>  "true",
					"maxItems"       =>  "1",
					"plugins"       =>  "['remove_button']",
					"onInitialize"       => "function() {var that = this;if (localStorage.demoData === undefined) {\$.getJSON('".site_url('general/json_gol_kejahatan')."', function(data) {localStorage.demoData = JSON.stringify(data);data.forEach(function(item) {that.addOption(item);});});}else{JSON.parse(localStorage.demoData).forEach(function(item) {that.addOption(item);});}}",

					),

			"valueSetter" => "function(rule, value) {rule.$elfind('.rule-value-container input')[0].selectize.setValue(value);}"		 
		 
			 
		   	), */


		   	array(
		   	"id" => "id_jenis_lokasi",
			"label" => "Lokasi Kejahatan",
			"type" => "string",
			"input" => "select",
			"values" => $this->cm->get_arr_dropdown("m_jenis_lokasi","id_jenis_lokasi","jenis_lokasi",'jenis_lokasi'),
			"operators" => array('equal')
		   	), 

		   	array(
		   	"id" => "tindak_pidana",
			"label" => "Tindak Pidana",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	),


		  


		 //   	array(
		 //   	"id" => "kp_tempat_kejadian",
			// "label" => "Tempat Kejadian Perkara",
			// "type" => "string",
			// "operators" => array('equal', 'contains')
		 //   	),


		   	array(
		   	"id" => "kp_id_motif_kejahatan",
			"label" => "Motif Kejahatan",
			"type" => "string",
			"input" => "select",
			"values" => $this->cm->get_arr_dropdown("m_motif","id_motif","motif",'motif'),
			"operators" => array('equal')
		   	) ,



		 //   	array(
		 //   	"id" => "kp_awal",
			// "label" => "Tanggal Kejadian Awal",
			// "type" => "date",
			// "operators" => array('equal'),
			// "validation" => array("format"=>"DD-MM-YYYY"),
			// "plugin"   => "datepicker",
			// "plugin_config" => array(
										 
			// 				"format"  => "dd-mm-yyyy",
			// 				"todayBtn"  => "linked",
			// 				"todayHighlight"  => true,
			// 				"autoclose"  => true
			// 						)			 
		 //   	)  , 

		   	array(
		   	"id" => "kp_awal",
			"label" => "Tanggal Kejadian Awal",
			"type" => "string",
			"operators" => array('equal')			 
		   	)  


		   	,
		   	array(
		   	"id" => "kp_akhir",
			"label" => "Tanggal Kejadian Akhir",
			"type" => "string",
			"operators" => array('equal')			 
		   	)  


		   	,



		   	array(
		   	"id" => "bulan_kejadian",
			"label" => "Bulan Kejadian",
			"type" => "string",
			"input" => "select",
			"values" => array(1=>"Januari","Februari","Maret","April","Mei","Juni",
						"Juli","Agustus","September","Oktober","November","Desember"),
			"operators" => array('equal')
		   	) ,


		   	array(
		   	"id" => "tahun_kejadian",
			"label" => "Tahun Kejadian",
			"type" => "string",
			"operators" => array('equal')			 
		   	)  ,


		   	array(
		   	"id" => "tanggal",
			"label" => "Tanggal laporan",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	), 



		 //   	array(
		 //   	"id" => "tanggal_awal",
			// "label" => "Tanggal Pelaporan Awal",
			// "type" => "date",
			// "operators" => array('equal'),
			// "plugin" =>"datepicker"	,
			// "plugin_config" => array(
			// 		"format" => 'dd-mm-yyyy',
			// 		"todayBtn" => "linked",
			// 		"todayHighlight" => "true",
			// 		"autoclose" => "true"
					 
			// 	),
			// "validation" => array("format"=>"dd-mm-yyyy")

		 //   	)  , 

		 //   	array(
		 //   	"id" => "tanggal_akhir",
			// "label" => "Tanggal Pelaporan Akhir",
			// "type" => "date",
			// "operators" => array('equal')	,
			// "plugin" =>"datepicker"	,
			// "plugin_config" => array(
			// 		"format" => 'yyyy/mm/dd',
			// 		"todayBtn" => "linked",
			// 		"todayHighlight" => "true",
			// 		"autoclose" => "true"
					 
			// 	)
			// ,"validation" => array("format"=>"YYYY/MM/DD")		 
		 //   	)  
 		// 	, 

		    array(
		   	"id" => "tanggal_awal",
			"label" => "Tanggal Pelaporan Minimal",
			"type" => "string",
			"operators" => array('equal')			 
		   	)  , 

		   	array(
		   	"id" => "tanggal_akhir",
			"label" => "Tanggal Pelaporan Maksimal",
			"type" => "string",
			"operators" => array('equal')			 
		   	)  


		   	,


		   	array(
		   	"id" => "waktu_awal",
			"label" => "Waktu awal",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	), 



		   	array(
		   	"id" => "waktu_akhir",
			"label" => "Waktu akhir",
			"type" => "string",
			"operators" => array('equal')			 
		   	) 

		   	,

		   	array(
		   	"id" => "kp_tempat_kejadian",
			"label" => "Tempat kejadian perkara",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)

		   	,

		   	array(
		   	"id" => "kejadian_desa",
			"label" => "Desa/Kelurahan tempat kejadian perkara",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)

		   	,

		   	array(
		   	"id" => "kejadian_kecamatan",
			"label" => "Kecamatan tempat kejadian perkara",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)


		   	,

		   	array(
		   	"id" => "kejadian_kota",
			"label" => "Kota/Kabupaten tempat kejadian perkara",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)

		   	,

		   	array(
		   	"id" => "kejadian_provinsi",
			"label" => "Provinsi tempat kejadian perkara",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)

		   	,



		   	array(
		   	"id" => "merk",
			"label" => "Merk Kendaraan",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)


		   	,

		   	array(
		   	"id" => "tersangka_nama",
			"label" => "Nama tersangka",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)

		   	,

		   	array(
		   	"id" => "saksi_nama",
			"label" => "Nama saksi",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)

		   	,

		   	array(
		   	"id" => "korban_nama",
			"label" => "Nama korban",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)

		   	,

		   	array(
		   	"id" => "barbuk_nama",
			"label" => "Barang bukti",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)

		   	,

		   	array(
		   	"id" => "pengemudi_nama",
			"label" => "Nama pengemudi",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)

		   	,

		   	array(
		   	"id" => "no_polisi",
			"label" => "Nomor polisi",
			"type" => "string",
			"operators" => array('equal', 'contains')
		   	)


			);
		 


		$data_array['rules'] = json_encode($array); 

		// show_array($array); 
		// echo json_encode($array); 
		// exit;

		$controller = get_class($this);


		// $data['leasing_id'] = $userdata['leasing_id'];
		 


	 
		//show_array($data_array); exit;
		$data_array['controller'] = $controller;

		//show_array($data_array); exit;

	 
 
		$content = $this->load->view($controller."_view",$data_array,true);

		$this->set_subtitle("PENCARIAN");
		$this->set_title("PENCARIAN");
		$this->set_content($content);
		$this->render();
	}



function cari(){
	$post = $this->input->post();
	// show_array($post['json_data']); 
	//exit;

	$json_data = $post['json_data'];

	 

	$i = 0;

	$str = "";
	foreach($post['json_data']['rules'] as $filter) : 
		extract($filter);	 

		$str .= ($i==0)?" where ":" ".$post['json_data']['condition']." ";

		


		if( !isset($filter['rules']) ) { 

			if($operator =='equal') {
				
				 
				if ($field=="tanggal_awal"){
					$str .=" tanggal  >= '$value' " ;
				}
				else if ($field=="tanggal_akhir"){
					$str .=" tanggal <= '$value' " ;
				}

				else if ($field=="kp_awal"){
					$str .=" kp_tanggal  >= '$value' " ;
				}

				else if ($field=="kp_akhir"){
					$str .=" kp_tanggal <= '$value' " ;
				}

				else if ($field=="pelapor_umur"){
					$str .=" pelapor_umur  >= '$value' " ;
				}

				else if ($field=="pelapor_umur2"){
					$str .=" pelapor_umur <= '$value' " ;
				}


				else if ($field=="tersangka_umur"){
					$str .=" tersangka_umur  >= '$value' " ;
				}

				else if ($field=="tersangka_umur2"){
					$str .=" tersangka_umur <= '$value' " ;
				}

				else if ($field=="waktu_awal"){
					//$value .= ":00";
					$str .=" waktu  >= '$value' " ;
				}
				else if ($field=="waktu_akhir"){
					//$value .= ":00";
					$str .=" waktu <= '$value' " ;
				}
				else { 
				$str .= " $field = '$value' ";
				}
			}
			else {
				$str .= " $field like  '%$value%' ";
			}

		}
		else {
			$str .= "( ";

			$j = 1; 
			$jumlah = count($filter['rules']); 
			foreach($filter['rules'] as $sub_filter) : 
				// $str .=" ".$sub_filter[''];

				if($sub_filter['operator'] =='equal') {
					

					// if($sub_filter['field']=="bulan") {
					// 	$str .=" month(kp_tanggal) = '".$sub_filter['value']."' ";
					// }
					// else if ($sub_filter['field']=="tahun"){
					// 	$str .=" year(kp_tanggal) = '".$sub_filter['value']."' ";
					// }
					if ($sub_filter['field']=="tanggal_awal"){ 
						$str .=" tanggal >= '".$sub_filter['value']."' ";
					}
					else if ($sub_filter['field']=="tanggal_akhir"){ 
						$str .=" tanggal <= '".$sub_filter['value']."' ";
					}


					else if ($sub_filter['field']=="waktu_awal"){
					 	$value = $sub_filter['value'];
						$str .=" waktu  >= '$value' " ;
					}
					else if ($sub_filter['field']=="waktu_akhir"){
						//$value .= ":00";
						$value = $sub_filter['value'];
						$str .=" waktu <= '$value' " ;
					}


					else if ($sub_filter['field']=="kp_awal"){
					 	$value = $sub_filter['value'];
						$str .=" kp_tanggal  >= '$value' " ;
					}
					else if ($sub_filter['field']=="kp_akhir"){
						 
						$value = $sub_filter['value'];
						$str .=" kp_tanggal <= '$value' " ;
					}


					else { 
						$str .= " ". $sub_filter['field'] . " = '".$sub_filter['value']."' ";
					}


				}
				else {
					$str .= " ". $sub_filter['field'] . " like  '%".$sub_filter['value']."%' ";
				}

				if($j < $jumlah) {
					$str .=" ". $filter['condition']. " ";
				}

				$j++;

			endforeach;
			$str .= " )  ";
		}


		// $str .= $filter['id'] 
		$i++;
	endforeach;
	$sql = "select * from v_pencarian ". $str; 

	$sql.=" group by laporan, id";

	// echo $sql; 

	// exit;

	$res = $this->db->query($sql); 
	$data['jumlah'] = $res->num_rows();
	$data['record'] = $res;

	$this->load->view($this->controller."_hasil_view",$data);
	// echo $str;

} 
	 

}
?>
