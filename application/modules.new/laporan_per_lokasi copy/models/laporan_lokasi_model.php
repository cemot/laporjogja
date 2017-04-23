<?php

class laporan_lokasi_model extends CI_Model {
	function laporan_lokasi_model(){
		parent::__construct();
	}




	function get_data_jumlah_lokasi($data) {

		extract($data);

$tanggal1  =  flipdate($tanggal1); 
$tanggal2  =  flipdate($tanggal2); 
$tanggal  =   flipdate($tanggal) ; 

		$sql="
		select x.id,x.kota,count(y.tb) as jumlah 

		from (select * from tiger_kota c 
			where c.id_provinsi = '34') x 

			left join (
			select 'a' as tb, tanggal, a.kp_tempat_id_desa, desa.id_kecamatan, kec.id_kota  
			from lap_a a 
			join tiger_desa desa on desa.id = a.kp_tempat_id_desa 
			join tiger_kecamatan kec on kec.id = desa.id_kecamatan 
			   where a.id_gol_kejahatan  ='$id_gol_kejahatan'";

			if($jenis=="bulanan")
			$sql.=" and year(a.tanggal) = '$tahun' and month(a.tanggal) = '$bulan' " ; 
			else if($jenis=="periodik")
			$sql.=" and  a.tanggal between '$tanggal1' and '$tanggal2'  " ;  
			else 
			$sql.=" and  a.tanggal = '$tanggal'  " ; 	

			$sql.="
			union 
			select 'b' as tb, tanggal, b.kejadian_id_desa ,desa.id_kecamatan, kec.id_kota  
			from lap_b b
			join tiger_desa desa on desa.id = b.kejadian_id_desa 
			join tiger_kecamatan kec on kec.id = desa.id_kecamatan 
			    where b.id_gol_kejahatan  ='$id_gol_kejahatan'"; 
			
			if($jenis=="bulanan")
			$sql.=" and year(b.tanggal) = '$tahun' and month(b.tanggal) = '$bulan' " ; 
			else if($jenis=="periodik")
			$sql.=" and  b.tanggal between '$tanggal1' and '$tanggal2'  " ;  
			else 
			$sql.=" and  b.tanggal = '$tanggal'  " ; 	


			$sql.=" ) y 



			on x.id = y.id_kota 

			group by x.id


		";

		$res = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$arr = array();
		foreach($res->result() as $row ) : 
			$arr['a'.$row->id] = "$row->jumlah";
		endforeach;

		return $arr;

	}
	


function get_data_per_polsek($param) {
extract($param);
$tanggal1  =  flipdate($tanggal1); 
$tanggal2  =  flipdate($tanggal2); 
$tanggal  =   flipdate($tanggal) ; 

	$sql="
		select x.id,x.kota,count(y.tb) as jumlah 

		from (select * from tiger_kota c 
			where c.id_provinsi = '34') x 

			left join (
			select 'a' as tb, tanggal, a.kp_tempat_id_desa, desa.id_kecamatan, kec.id_kota  
			from lap_a a 
			join tiger_desa desa on desa.id = a.kp_tempat_id_desa 
			join tiger_kecamatan kec on kec.id = desa.id_kecamatan 
			   where a.id_gol_kejahatan  ='$id_gol_kejahatan'";

			if($jenis=="bulanan")
			$sql.=" and year(a.tanggal) = '$tahun' and month(a.tanggal) = '$bulan' " ; 
			else if($jenis=="periodik")
			$sql.=" and  a.tanggal between '$tanggal1' and '$tanggal2'  " ;  
			else 
			$sql.=" and  a.tanggal = '$tanggal'  " ; 	

			$sql.="
			union 
			select 'b' as tb, tanggal, b.kejadian_id_desa ,desa.id_kecamatan, kec.id_kota  
			from lap_b b
			join tiger_desa desa on desa.id = b.kejadian_id_desa 
			join tiger_kecamatan kec on kec.id = desa.id_kecamatan 
			    where b.id_gol_kejahatan  ='$id_gol_kejahatan'"; 
			
			if($jenis=="bulanan")
			$sql.=" and year(b.tanggal) = '$tahun' and month(b.tanggal) = '$bulan' " ; 
			else if($jenis=="periodik")
			$sql.=" and  b.tanggal between '$tanggal1' and '$tanggal2'  " ;  
			else 
			$sql.=" and  b.tanggal = '$tanggal'  " ; 	


			$sql.=" ) y 



			on x.id = y.id_kota 

			group by x.id


		";
}


 

}