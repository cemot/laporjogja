<?php
class laporan_grafik_waktu extends super_controller  {
	function laporan_grafik_waktu(){
		parent::__construct();
		$this->load->helper("tanggal");
		$this->load->model("lgw_model","lm");
		$this->load->model("coremodel","cm");


		$this->controller = get_class($this);
	}
	
	
	function index(){
		$data_array = array();
		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("TINDAK KEJAHATAN PER LOKASI ");
		$this->set_title("TINDAK KEJAHATAN PER LOKASI");
		$this->set_content($content);
		$this->render();
	}

 


function get_laporan(){
	$data = $this->input->post();
	extract($data);

	$sql = "select hour(waktu) jam , 
sum(if(id_kota='34_1',1,0)) as kp,
sum(if(id_kota='34_2',1,0)) as bt,
sum(if(id_kota='34_3',1,0)) as gk,
sum(if(id_kota='34_4',1,0)) as sl,
sum(if(id_kota='34_71',1,0)) as jog

from (
select 'a' as tb,kp_tanggal as tanggal, kp_wktu waktu, kp_tempat_id_desa as  id_desa 
,b.desa, b.id_kecamatan, c.kecamatan, c.id_kota, d.kota, a.id_gol_kejahatan
from lap_a a 
join tiger_desa b on a.kp_tempat_id_desa = b.id
join tiger_kecamatan c on b.id_kecamatan  = c.id
join tiger_kota d on c.id_kota = d.id

union 
select 'b' as tb,kejadian_tanggal, kejadian_jam, kejadian_id_desa as id_desa 

,b.desa, b.id_kecamatan, c.kecamatan, c.id_kota, d.kota, a.id_gol_kejahatan
from lap_b a
join tiger_desa b on a.kejadian_id_desa = b.id
join tiger_kecamatan c on b.id_kecamatan  = c.id
join tiger_kota d on c.id_kota = d.id  ) x ";

$sql.= " where x.id_gol_kejahatan  ='$id_gol_kejahatan'"; 

if($jenis=="bulanan")
$sql.=" and year(x.tanggal) = '$tahun' and month(x.tanggal) = '$bulan' " ; 
else if($jenis=="periodik")
$sql.=" and  x.tanggal between '$tanggal1' and '$tanggal2'  " ;  
else 
$sql.=" and  x.tanggal = '$tanggal'  " ; 

 




$sql.=" group by hour(waktu) ";

//echo $sql;
$res = $this->db->query($sql);

foreach($res->result() as $row) : 
	$arr['jam'][] = $row->jam;
	$arr['Kulon Progo'][] = $row->kp;
	$arr['Bantuul'][] = $row->bt;
	$arr['Gunung Kidul'][] = $row->kp;
	$arr['Sleman'][] = $row->kp;
	$arr['Kota Jogja'][] = $row->kp;


	
endforeach;

// show_array($arr);
$data['arr'] = $arr;


$this->load->view("laporan_grafik_waktu_result_view",$data);

	
	 
}


function get_data_per_polsek($id_polsek){
	$data = $this->input->get();

	$arr = array(

			"sleman"  =>  "a34_4",
			"wonosari"  => "a34_3",
			"jogja"  => "a34_71",
			"bantul"  => "a34_2",
			"wates"  => "a34_1"		

	);
	$data['id_polres'] = $arr[id_polsek];
	



}


 
}
?>