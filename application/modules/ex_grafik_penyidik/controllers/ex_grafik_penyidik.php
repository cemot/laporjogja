<?php
class ex_grafik_penyidik extends ex_controller  {
	function ex_grafik_penyidik(){
		parent::__construct();
		$this->load->model("coremodel","cm");
		// $this->load->model("ex_grafik_penyidik_model","dm");
		$this->load->helper("tanggal");
		$this->controller = get_class($this);
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
		$data_array['url'] = $url;
		$controller = get_class($this);

		$data_array['controller'] = $controller;
		$content = $this->load->view($controller."_grafik",$data_array,true);
		// echo $table;
		// exit;
		$this->set_subtitle($title);
		$this->set_title($title);
		$this->set_content($content);
		$this->render();
	}

	function get_grafik($url) {

		$controller = get_class($this);

		$post = $this->input->post();
		// show_array($post);

		// echo $polsek;
		// exit();

		//$url = $this->input->get('url');

		if($url == 1){
			$table_penyidik = "lap_a_penyidik";
			$table_utama = "lap_a"; 
			$title = "Data Grafik Penyidik Lap. A";
			$id="lap_a_id";
		}
		else if($url == 2){
			$table_penyidik = "lap_b_penyidik";
			$table_utama = "lap_b"; 
			$title = "Data Grafik Penyidik Lap. B";
			$id="lap_b_id";
		}
		else if($url == 3){
			$table_penyidik = "lap_c_penyidik";
			$table_utama = "lap_c"; 
			$id="lap_c_id";
			$title = "Data Grafik Penyidik Lap. C";
		}
		else if($url == 4){
			$table_penyidik = "lap_d_penyidik";
			$table_utama = "lap_d"; 
			$id="lap_d_id";
			$title = "Data Grafik Penyidik Lap. D";
		}
		else if($url == 5){
			$table_penyidik = "lap_laka_penyidik";
			$table_utama = "lap_laka_lantas"; 
			$id="lap_laka_lantas_id";
			$title = "Data Grafik Penyidik Lap. LAKA LANTAS";
		}
	 
	 	$tahun = $post['tahun'];

		$this->db->select('u.nama, a.tanggal, count(*) as total, 
				count(if(month(a.tanggal)=1,1,null)) as  januari,
				count(if(month(a.tanggal)=2,1,null)) as  februari,
				count(if(month(a.tanggal)=3,1,null)) as  maret,
				count(if(month(a.tanggal)=4,1,null)) as  april,
				count(if(month(a.tanggal)=5,1,null)) as  mei,
				count(if(month(a.tanggal)=6,1,null)) as  juni,
				count(if(month(a.tanggal)=7,1,null)) as  juli,
				count(if(month(a.tanggal)=8,1,null)) as  agustus,
				count(if(month(a.tanggal)=9,1,null)) as  september,
				count(if(month(a.tanggal)=10,1,null)) as  oktober,
				count(if(month(a.tanggal)=11,1,null)) as  november,
				count(if(month(a.tanggal)=12,1,null)) as  desember',false)
		->from("pengguna u")
		->join("$table_penyidik pa","pa.id_penyidik=u.id")
		->join("$table_utama a","a.$id=pa.$id")
		->where("year(tanggal)= '$tahun'",null,false)
		->group_by("u.id");

	if($post['jenis']<>'x'  ) {

		// echo "kok masuk sini";
		

		if($post['jenis']=="polres") {
			// echo "ini polres <hr />";
			// echo "poles id = ". $post['id_polres'];
			// show_array($post);
			$this->db->where("u.id_polres",$post['id_pores']);
			 // $this->db->where("u.id_polres",'vangkeh');

			$this->db->where("u.jenis",$post['jenis']);
		}
		else if($post['jenis']=="polsek") {
			$this->db->where("u.id_polsek",$post['id_polsek']);
			$this->db->where("u.jenis",$post['jenis']);
		}
		else if($post['jenis']=="polda") {
			 
			$this->db->where("u.jenis",$post['jenis']);
		}
		else {
			$this->db->join("m_polsek sek","sek.id_polsek = u.id_polsek",'left');
			$this->db->join("m_polres res","res.id_polres = sek.id_polres","left");
			$this->db->where("res.id_polres",$post['id_polres']);
		}


	}

	if($post['id_fungsi']<> 'x') {
		$this->db->where("a.id_fungsi",$post['id_fungsi']);
	}

	$res = $this->db->get();
	// echo $this->db->last_query(); exit;

	$arr = array();
	foreach($res->result() as $row ) : 
		$arr[] = array("nama"=>$row->nama."( Total $row->total kasus )", "data"=>array($row->januari,
								$row->februari,
								$row->maret,
								$row->april,
								$row->mei,
								$row->juni,
								$row->juli,
								$row->agustus,
								$row->september,
								$row->oktover,
								$row->november,
								$row->desember
						  			));
	endforeach;
	 
	 	$data_array['arr'] = $arr;

	 	// echo json_encode($data_array['arr']); exit;

	 	//show_array($arr) ;  
	 	//exit;


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