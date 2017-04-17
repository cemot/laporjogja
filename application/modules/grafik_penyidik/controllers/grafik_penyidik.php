<?php
class grafik_penyidik extends admin_controller  {
	function grafik_penyidik(){
		parent::__construct();
		$this->load->model("coremodel","cm");
		// $this->load->model("grafik_penyidik_model","dm");
		$this->load->helper("tanggal");
		$this->controller = get_class($this);
	}
	
	
	function index(){
		$this->set_subtitle("Data Grafik");
		$this->set_title("Data Grafik");
		$this->set_content("WELCOME");
		$this->render_admin();
	}

	function grafik($url) {

		if(!$url) redirect('index_administrator');

		if($url == 1) {
			$table = "lap_a";
			$title = "Data Grafik Penyidik Lap. A";
		}

		if($url == 2) {
			$table = "lap_b";
			$title = "Data Grafik Penyidik Lap. B";
		} 

		if($url == 3) {
			$table = "lap_c";
			$title = "Data Grafik Penyidik Lap. C";
		} 

		if($url == 4) {
			$table = "lap_d";
			$title = "Data Grafik Penyidik Lap. D";
		}

		if($url == 5) {
			$table = "lap_laka_lantas";
			$title = "Data Grafik Penyidik Lap. LAKA LANTAS";
		}

		

		$query = "SELECT  

				  COUNT(IF(MONTH(tanggal)=1,1,NULL) ) AS Januari,
				  COUNT(IF(MONTH(tanggal)=2,1,NULL) ) AS Februari,
				  COUNT(IF(MONTH(tanggal)=3,1,NULL) ) AS Maret,
				  COUNT(IF(MONTH(tanggal)=4,1,NULL) ) AS April,
				  COUNT(IF(MONTH(tanggal)=5,1,NULL) ) AS Mei,
				  COUNT(IF(MONTH(tanggal)=6,1,NULL) ) AS Juni,
				  COUNT(IF(MONTH(tanggal)=7,1,NULL) ) AS Juli,
				  COUNT(IF(MONTH(tanggal)=8,1,NULL) ) AS Agustus,
				  COUNT(IF(MONTH(tanggal)=9,1,NULL) ) AS September,
				  COUNT(IF(MONTH(tanggal)=10,1,NULL) ) AS Oktober,
				  COUNT(IF(MONTH(tanggal)=11,1,NULL) ) AS November,
				  COUNT(IF(MONTH(tanggal)=12,1,NULL) ) AS Desember

				  FROM ".$table."
				  WHERE YEAR(tanggal) = ". date('Y');

		$data_array['query'] = $this->db->query($query)->row();
		$data_array['title'] = $title;
		$controller = get_class($this);

		$data_array['controller'] = $controller;
		$content = $this->load->view($controller."_grafik",$data_array,true);
		// echo $table;
		// exit;
		$this->set_subtitle($title);
		$this->set_title($title);
		$this->set_content($content);
		$this->render_admin();
	}

	function get_grafik() {

		$controller = get_class($this);

		$tahun = $this->input->get('tahun');
		$polres = $this->input->get('id_polres');
		$polsek = $this->input->get('id_polsek');

		// echo $polsek;
		// exit();

		$url = $this->input->get('url');

		if($url == 1){
			$table_penyidik = "lap_a_penyidik";
			$table_utama = "lap_a"; 
			$title = "Data Grafik Penyidik Lap. A";
		}
		if($url == 2){
			$table_penyidik = "lap_b_penyidik";
			$table_utama = "lap_b"; 
			$title = "Data Grafik Penyidik Lap. B";
		}
		if($url == 3){
			$table_penyidik = "lap_c_penyidik";
			$table_utama = "lap_c"; 
			$title = "Data Grafik Penyidik Lap. C";
		}
		if($url == 4){
			$table_penyidik = "lap_d_penyidik";
			$table_utama = "lap_d"; 
			$title = "Data Grafik Penyidik Lap. D";
		}
		if($url == 5){
			$table_penyidik = "lap_laka_penyidik";
			$table_utama = "lap_laka_lantas"; 
			$title = "Data Grafik Penyidik Lap. LAKA LANTAS";
		}
	if (!empty($polsek)) {
		$this->db->where('id_polsek', $polsek);
	}

	
	$this->db->where('level', 2);
	if (!empty($polsek)) {
		$this->db->where('id_polsek', $polsek);
	}else{
		$this->db->where('id_polres', $polres);
	}
	$res = $this->db->get('pengguna');


	if ($res->num_rows()>=1) {
		
	

	$penyidik = $res->result_array();




	$this->db->select('lp.* , a.tanggal, p.nama')->from($table_penyidik.' lp')
	->join($table_utama.' a','a.'.$table_utama.'_id = lp.'.$table_utama.'_id','left')
	->join('pengguna p','lp.id_penyidik = p.id ','left');
	$this->db->where('YEAR(tanggal)', $tahun);
	
	$res = $this->db->get();
	$hasil = $res->result_array();


	$indexpengguna = 0;
	foreach ($penyidik as $rowp) {
		

				$Januari = 0;
				$Februari = 0;
				$Maret = 0;
				$April = 0;
				$Mei = 0;
				$Juni = 0;
				$Juli = 0;
				$Agustus = 0;
				$September = 0;
				$Oktober = 0;
				$November = 0;
				$Desember = 0;

		foreach ($hasil as $rowh) {
				

			if ($rowp['id']==$rowh['id_penyidik']) {
				$unixtime = strtotime($rowh['tanggal']);
				$bulankasus = date('m', $unixtime);

				
				if ($bulankasus==1) {
					$Januari = $Januari+1;
				}
				if ($bulankasus==2) {
					$Februari = $Februari+1;
				}
				if ($bulankasus==3) {
					$Maret = $Maret+1 ;
				}
				if ($bulankasus==4) {
					$April = $April+1 ;
				}
				if ($bulankasus==5) {
					$Mei = $Mei+1 ;
				}
				if ($bulankasus==6) {
					$Juni = $Juni+1 ;
				}
				if ($bulankasus==7) {
					$Juli = $Juli+1 ;
				}
				if ($bulankasus==8) {
					$Agustus = $Agustus+1 ;
				}
				if ($bulankasus==9) {
					$September = $September+1 ;
				}
				if ($bulankasus==10) {
					$Oktober = $Oktober+1 ;
				}
				if ($bulankasus==11) {
					$November = $November+1 ;
				}
				if ($bulankasus==12) {
					$Desember = $Desember+1 ;
				}
			}

			

			
		}

		$penyidik[$indexpengguna]['Januari'] = $Januari;
		$penyidik[$indexpengguna]['Februari'] = $Februari;
		$penyidik[$indexpengguna]['Maret'] = $Maret;
		$penyidik[$indexpengguna]['April'] = $April;
		$penyidik[$indexpengguna]['Mei'] = $Mei;
		$penyidik[$indexpengguna]['Juni'] = $Juni;
		$penyidik[$indexpengguna]['Juli'] = $Juli;
		$penyidik[$indexpengguna]['Agustus'] = $Agustus;
		$penyidik[$indexpengguna]['September'] = $September;
		$penyidik[$indexpengguna]['Oktober'] = $Oktober;
		$penyidik[$indexpengguna]['November'] = $November;
		$penyidik[$indexpengguna]['Desember'] = $Desember;
		$indexpengguna++;

		}

	}else{
		$penyidik[0]['nama'] = "Data Kosong";
		$penyidik[0]['Januari'] = 0;
		$penyidik[0]['Februari'] = 0;
		$penyidik[0]['Maret'] = 0;
		$penyidik[0]['April'] = 0;
		$penyidik[0]['Mei'] = 0; 
		$penyidik[0]['Juni'] = 0;
		$penyidik[0]['Juli'] = 0;
		$penyidik[0]['Agustus'] = 0;
		$penyidik[0]['September'] = 0;
		$penyidik[0]['Oktober'] = 0;
		$penyidik[0]['November'] = 0;
		$penyidik[0]['Desember'] = 0;

	}

	// show_array($hasil);
	// show_array($penyidik);

	// echo $this->db->last_query();
	// exit();


		$data_array['penyidik'] = $penyidik;
		
		$data_array['tahun'] = $tahun;
		$data_array['title'] = $title;

		// show_array($data_array);
		// // echo $nilai;
		// exit();
		
		$this->load->view($controller."_grafik_view",$data_array);

	}

function get_polsek(){
    $data = $this->input->post();

    
    $id_polres = $data['id_polres'];

    $this->db->where("id_polres",$id_polres);
    $this->db->order_by("nama_polsek");
    $rs = $this->db->get("m_polsek");
    echo "<option value=''>- Semua Polsek -</option>";
    foreach($rs->result() as $row ) :
        echo "<option value=$row->id_polsek>$row->nama_polsek </option>";
    endforeach;


}
}
?>