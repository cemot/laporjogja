<?php
class ex_grafik_lap extends super_controller  {
	function __consruct(){
		parent::__construct();
	}
	
	
	function index(){
		$this->set_subtitle("Data Grafik");
		$this->set_title("Data Grafik");
		$this->set_content("WELCOME");
		$this->render();
	}

	function grafik($url) {

		if(!$url) redirect('index_administrator');

		if($url == 1) {
			$table = "lap_a";
			$title = "DATA GRAFIK LAPORAN A";
		}

		if($url == 2) {
			$table = "lap_b";
			$title = "DATA GRAFIK LAPORAN B";
		} 

		if($url == 3) {
			$table = "lap_c";
			$title = "DATA GRAFIK LAPORAN C";
		} 

		if($url == 4) {
			$table = "lap_d";
			$title = "DATA GRAFIK LAPORAN D";
		}

		if($url == 5) {
			$table = "lap_laka_lantas";
			$title = "DATA GRAFIK LAPORAN LAKA LANTAS";
		}

		$controller = get_class($this);

		$data_array['controller'] = $controller;

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

		$content = $this->load->view($controller."_grafik",$data_array,true);
		// echo $table;
		// exit;
		$this->set_subtitle($title);
		$this->set_title($title);
		$this->set_content($content);
		$this->render();
	}

	function get_grafik() {

		$controller = get_class($this);

		$tahun = $this->input->get('tahun');

		$url = $this->input->get('url');

		if($url == 1) {
			$table = "lap_a";
			$field_name = "kp_tanggal";
			$title = "DATA GRAFIK LAPORAN A";
		}

		if($url == 2) {
			$table = "lap_b";
			$field_name = "kejadian_tanggal";
			$title = "DATA GRAFIK LAPORAN B";
		} 

		if($url == 3) {
			$table = "lap_c";
			$field_name = "kejadian_tanggal";
			$title = "DATA GRAFIK LAPORAN C";
		} 

		if($url == 4) {
			$table = "lap_d";
			$field_name = "kejadian_tanggal";
			$title = "DATA GRAFIK LAPORAN D";
		}

		if($url == 5) {
			$table = "lap_laka_lantas";
			$field_name = "kp_tanggal";
			$title = "DATA GRAFIK LAPORAN LAKA LANTAS";
		}


		$query = "SELECT  

				  COUNT(IF(MONTH($field_name)=1,1,NULL) ) AS Januari,
				  COUNT(IF(MONTH($field_name)=2,1,NULL) ) AS Februari,
				  COUNT(IF(MONTH($field_name)=3,1,NULL) ) AS Maret,
				  COUNT(IF(MONTH($field_name)=4,1,NULL) ) AS April,
				  COUNT(IF(MONTH($field_name)=5,1,NULL) ) AS Mei,
				  COUNT(IF(MONTH($field_name)=6,1,NULL) ) AS Juni,
				  COUNT(IF(MONTH($field_name)=7,1,NULL) ) AS Juli,
				  COUNT(IF(MONTH($field_name)=8,1,NULL) ) AS Agustus,
				  COUNT(IF(MONTH($field_name)=9,1,NULL) ) AS September,
				  COUNT(IF(MONTH($field_name)=10,1,NULL) ) AS Oktober,
				  COUNT(IF(MONTH($field_name)=11,1,NULL) ) AS November,
				  COUNT(IF(MONTH($field_name)=12,1,NULL) ) AS Desember

				  FROM ".$table."
				  WHERE YEAR($field_name) = ".$tahun;

		$data_array['query'] = $this->db->query($query)->row_array();
		// show_array($data_array['query'] ); exit;
		// echo $this->db->last_query();  
		$data_array['tahun'] = $tahun;
		$data_array['title'] = $title;

		//show_array($data_array);

		$this->load->view($controller."_grafik_view",$data_array);

	}
}
?>