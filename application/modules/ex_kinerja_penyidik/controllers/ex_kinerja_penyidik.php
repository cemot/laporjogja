<?php
class ex_kinerja_penyidik extends super_controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("coremodel","cm");
		// $this->load->model("ex_kinerja_penyidik_model","dm");
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
			$title = "KINERJA PENYIDIK LP MODEL  A";
		}

		if($url == 2) {
			$table = "lap_b";
			$title = "KINERJA PENYIDIK LP MODEL  B";
		} 

		if($url == 3) {
			$table = "lap_c";
			$title = "KINERJA PENYIDIK LP MODEL  C";
		} 

		if($url == 4) {
			$table = "lap_d";
			$title = "KINERJA PENYIDIK LP MODEL  D";
		}

		if($url == 5) {
			$table = "lap_laka_lantas";
			$title = "KINERJA PENYIDIK LP  LAKA LANTAS";
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

	

    if(!isset($post['id_kesatuan'])) {
    	$post['id_kesatuan']="x";
    }

     if(!isset($post['id_subdit'])) {
    	$post['id_subdit']="x";
    }
     if(!isset($post['id_unit'])) {
    	$post['id_unit']="x";
    }

		// echo $polsek;
		// exit();

		//$url = $this->input->get('url');

		if($url == 1){
			$table_penyidik = "lap_a_penyidik";
			$table_utama = "lap_a"; 
			$title = "KINERJA PENYIDIK LP MODEL  A";
			$id="lap_a_id";
		}
		else if($url == 2){
			$table_penyidik = "lap_b_penyidik";
			$table_utama = "lap_b"; 
			$title = "KINERJA PENYIDIK LP MODEL  B";
			$id="lap_b_id";
		}
		else if($url == 3){
			$table_penyidik = "lap_c_penyidik";
			$table_utama = "lap_c"; 
			$id="lap_c_id";
			$title = "KINERJA PENYIDIK LP MODEL  C";
		}
		else if($url == 4){
			$table_penyidik = "lap_d_penyidik";
			$table_utama = "lap_d"; 
			$id="lap_d_id";
			$title = "KINERJA PENYIDIK LP MODEL  D";
		}
		else if($url == 5){
			$table_penyidik = "lap_laka_penyidik";
			$table_utama = "lap_laka_lantas"; 
			$id="lap_laka_lantas_id";
			$title = "KINERJA PENYIDIK LP MODEL  LAKA LANTAS";
		}
	 
	 	$tahun = $post['tahun'];

		 
		

		/// summaries table 
		extract($post);
		$sql = "select *  from (select 
			x.id, x.nama, 
			sum(p21) as p21, 
			sum(sidik) as sidik,
			sum(lidik) as lidik, 
			sum(sp3) as sp3, 
			count(*) as total


			from (select 'a' as tb, 
			p.id ,
			p.nama, 
			lp.$id  as lap_id , 
			a.penyelesaian , 
			if(a.penyelesaian = 'p21',1,0) as p21, 
			if(a.penyelesaian = 'sidik',1,0) as sidik, 
			if(a.penyelesaian = 'lidik',1,0) as lidik, 
			if(a.penyelesaian = 'sp3',1,0) as sp3, 
			op.jenis,a.user_id 	 
			from pengguna  p 
			join $table_penyidik lp on   lp.id_penyidik = p.id 
			join $table_utama a on lp.$id =  a.$id 

			join pengguna op on a.user_id = op.id 

			left join m_unit unit on unit.id_unit = p.id_unit

			";


			if($post['id_kesatuan']<>'x') {
				$this->db->where("p.id_kesatuan",$post['id_kesatuan']);
			}

			if($post['id_subdit']<>'x') {
				$this->db->where("unit.id_subdit",$post['id_subdit']);
			}

			if($post['id_unit']<>'x') {
				$this->db->where("p.id_unit",$post['id_unit']);
			}




			if($jenis=="polresall") {
			$sql .= " left join m_polsek sek on sek.id_polsek = op.id_polsek ";
			$sql .= " left join m_polres res on res.id_polres = sek.id_polsek ";
			}





			$sql.= " where p.level='2' ";

			if($jenis<>'x') {
				//$sql.= " and u.jenis ='$jenis' "
				if($jenis == "polres") {
					$sql .=" and op.jenis='$jenis' and op.id_polres = '$id_polres' ";
				}
				else if ($jenis=="polsek") {
					$sql .=" and op.jenis='$jenis' and op.id_polsek = '$id_polsek' ";
				}
				else if ($jenis=="polda") {
					$sql .=" and op.jenis='$jenis' ";
				}
				else {
					$sql .= " and op.id_polres = '$id_polres' ";
				}
			}


			// if($post['id_fungsi']<> 'x') {
			// 	// $this->db->where("a.id_fungsi",$post['id_fungsi']);
			// 	$sql .= " and a.id_fungsi = '$id_fungsi'";
			// }




			$sql .= " ) x group by x.id) y 

			 order by y.total desc limit 20 ";

			 // echo $sql;


		$data_array['rec_penyidik'] = $this->db->query($sql);

		$data_array['tahun'] = $tahun ;

		$data_array['table_penyidik'] = $table_penyidik ;
		$data_array['table_utama'] = $table_utama;
		$data_array['id'] = $id;
			 
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


function get_kasus_per_user($iduser) {

	$tahun = $this->uri->segment(4);
	$tbname = $this->uri->segment(5);
	$table_penyidik = $this->uri->segment(6);
	$id = $this->uri->segment(7);

	// show_array($this->uri->uri_to_assoc());
	// exit;

	$this->db->select("l.tanggal,l.nomor,l.tindak_pidana")
	->from("$tbname l")
	->join("$table_penyidik lp ","l.$id=lp.$id")
	->group_by("l.$id")
	->where("lp.id_penyidik",$iduser)
	->order_by("l.tanggal");

	$this->db->where("year(l.tanggal) = $tahun",null,false);

	$rs = $this->db->get();
	// echo $this->db->last_query(); 
	$data['dataKasus']= $rs;

	// cari data user 

	$this->db->select("p.*,polsek.nama_polsek, polres.nama_polres")
	->from("pengguna p")
	->join("m_polres polres","polres.id_polres=p.id_polres",'left')
	->join("m_polsek polsek","polsek.id_polsek=p.id_polsek",'left'); 

	$this->db->where("id",$iduser); 


	$datauser = $this->db->get()->row_array();

	// echo $this->db->last_query(); 

	$data['datauser'] = $datauser;


	$this->load->view($this->controller."_list_kasus",$data); 



}


function get_kesatuan($jenis) {

// 	x
// polda
// polres
// polresall
// polsek

if($jenis=="polda" or $jenis=="x") {
	$jenis="polda";
}
else {
	$jenis="polrespolsek";
}





	$this->db->where("jenis",$jenis);
	$this->db->order_by("kesatuan");
	$rs = $this->db->get("m_kesatuan");
	echo "<option value='x'>= SEMUA  = </option>";
	foreach($rs->result() as $row ) : 
		echo "<option value=$row->id_kesatuan>$row->kesatuan</option>";
	endforeach;
}


function get_subdit($jenis) {

	// $id_subdit = $this->uri->segment(4);

	$this->db->where("id_kesatuan",$jenis); 
	$this->db->order_by("subdit");
	$rs = $this->db->get("m_subdit");
	$arr= array();
	echo "<option value='x'>= SEMUA  = </option>";
	$sel="";
	foreach($rs->result() as $row) :
		// $sel=($row->id_subdit==$id_subdit)?"selected":"";
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_subdit> $row->subdit </option>  ";
	endforeach;
}



function get_unit($jenis) {

	// $id_unit = $this->uri->segment(4);

	$this->db->where("id_subdit",$jenis); 
	$this->db->order_by("unit");
	$rs = $this->db->get("m_unit");
	$arr= array();
	echo "<option value='x'>= SEMUA  = </option>";
	$sel="";
	foreach($rs->result() as $row) :
		// $sel=($row->id_unit==$id_unit)?"selected":"";
		// $arr[$row->id_kesatuan] = $row->kesatuan;
		echo "<option value=$row->id_unit  > $row->unit </option>  ";
	endforeach;
}



}
?>