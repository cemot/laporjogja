<?php

class laporan_bulan_model extends CI_Model {
	function laporan_minggu_model(){
		parent::__construct();
	}

	function get_data_golongan() {
		$res = $this->db->get("m_golongan");
		// echo $this->db->last_query(); exit;
		return $res;
	}


	function get_data_mingguan() {
		$this->db->where("id <> '4'",null,false);
		$res = $this->db->get("m_golongan");
		// echo $this->db->last_query(); exit;
		return $res;
	}

	function get_data_mingguan2() {
		$this->db->where("id = '4'",null,false);
		$res = $this->db->get("m_golongan");
		// echo $this->db->last_query(); exit;
		return $res;
	}

	function get_data_kelompok($id_golongan){
		$this->db->where("id_golongan",$id_golongan);
		$res  = $this->db->get("m_kelompok_kejahatan");
		return $res;
	}


	function get_data_gol_kejahatan($id_kelompok,$bulan,$tahun,$jenis,$id_polres){
		

		//echo "$jenis $id_polres <hr />";

		$sql  = "select gk.id,gk.golongan_kejahatan, count(x.bulan) as jumlah,
ifnull(sum(x.p21),0) as p21,
ifnull(sum(x.tcb),0) as tcb,
ifnull(sum(x.bpp),0) as bpp,
ifnull(sum(x.adc),0) as adc,
ifnull(sum(x.nii),0) as nii,
ifnull(sum(x.tm),0) as tm,
ifnull(sum(x.tg),0) as tg,
ifnull(sum(x.exp),0) as exp,
ifnull(sum(x.p21),0) + ifnull(sum(x.tcb),0) + ifnull(sum(x.bpp),0) + ifnull(sum(x.adc),0) + ifnull(sum(x.nii),0) + ifnull(sum(x.tm),0) + ifnull(sum(x.tg),0) + ifnull(sum(x.exp),0)  as jml_selesai,

ifnull(sum(x.sidik),0) as sidik,
ifnull(sum(x.lidik),0) as lidik , 
ifnull(sum(x.sidik),0)  + ifnull(sum(x.lidik),0)  as lidiksidik
from m_golongan_kejahatan gk 
left join 
 (
select lap_a_id as id, 'a' as tb, id_gol_kejahatan, month(tanggal) bulan, year(tanggal) tahun,
if(penyelesaian='p21',1,0) as p21,
if(penyelesaian='dihentikan' and alasan='tidakcukupbukti' ,1,0) as tcb,
if(penyelesaian='dihentikan' and alasan='bukanpkrpidana' ,1,0) as bpp,
if(penyelesaian='dihentikan' and alasan='aduandicabut' ,1,0) as adc,
if(penyelesaian='dihentikan' and alasan='nebisinidem' ,1,0) as nii,
if(penyelesaian='dihentikan' and alasan='tskmati' ,1,0) as tm,
if(penyelesaian='dihentikan' and alasan='tskgila' ,1,0) as tg,
if(penyelesaian='dihentikan' and alasan='kadaluarsa' ,1,0) as exp,
if(penyelesaian='sidik',1,0) as sidik,
if(penyelesaian='lidik',1,0) as lidik
from lap_a a ";

if($jenis=="polres") { 
$sql .= "
join pengguna p on p.id = a.user_id
left join m_polsek sek on sek.`id_polsek` = p.id_polsek
left join m_polres res on res.`id_polres` = sek.id_polsek
where p.id_polres = '$id_polres'
and  month(tanggal) = '$bulan' and year(tanggal) = '$tahun' ";
}
else {
	$sql .= " where  month(tanggal) = '$bulan' and year(tanggal) = '$tahun' ";
}

$sql .= "
union 
select lap_b_id as id, 'b' as tb, id_gol_kejahatan, month(tanggal) bulan, year(tanggal) tahun,
if(penyelesaian='p21',1,0) as p21,
if(penyelesaian='dihentikan' and alasan='tidakcukupbukti' ,1,0) as tcb,
if(penyelesaian='dihentikan' and alasan='bukanpkrpidana' ,1,0) as bpp,
if(penyelesaian='dihentikan' and alasan='aduandicabut' ,1,0) as adc,
if(penyelesaian='dihentikan' and alasan='nebisinidem' ,1,0) as nii,
if(penyelesaian='dihentikan' and alasan='tskmati' ,1,0) as tm,
if(penyelesaian='dihentikan' and alasan='tskgila' ,1,0) as tg,
if(penyelesaian='dihentikan' and alasan='kadaluarsa' ,1,0) as exp,
if(penyelesaian='sidik',1,0) as sidik,
if(penyelesaian='lidik',1,0) as lidik
from lap_b a ";

if($jenis=="polres") { 
$sql .= "
join pengguna p on p.id = a.user_id
left join m_polsek sek on sek.`id_polsek` = p.id_polsek
left join m_polres res on res.`id_polres` = sek.id_polsek
where p.id_polres = '$id_polres'
and  month(tanggal) = '$bulan' and year(tanggal) = '$tahun' ";
}
else {
	$sql .= " where  month(tanggal) = '$bulan' and year(tanggal) = '$tahun' ";
}

$sql .= "


) x  on gk.id = x.id_gol_kejahatan
where gk.id_kelompok = '$id_kelompok'
group by gk.id";

		$res = $this->db->query($sql);

		// echo $this->db->last_query(); exit;

		return $res;
	}

 
function get_jml_sebelum($bulan,$tahun,$jenis,$id_polres) {
 	$tanggal = "$tahun-$bulan-1";
 	$sql = "select gk.id 
		, count(x.id_gol_kejahatan) as jumlah
		from 
		m_golongan_kejahatan gk left join 
		( 
		select lap_a_id as id, `id_gol_kejahatan` from `lap_a` a ";



		if($jenis=="polres") { 
		$sql .= "
		join pengguna p on p.id = a.user_id
		left join m_polsek sek on sek.`id_polsek` = p.id_polsek
		left join m_polres res on res.`id_polres` = sek.id_polsek
		where p.id_polres = '$id_polres'
		and  tanggal < '$tanggal' and penyelesaian in ('sidik','lidik')";
		}
		else {
			$sql.=" where tanggal < '$tanggal' and penyelesaian in ('sidik','lidik') ";
		}
		
		


		$sql.=" union 


		select lap_b_id as id, `id_gol_kejahatan` from `lap_b` a ";

		if($jenis=="polres") { 
		$sql .= " 
		join pengguna p on p.id = a.user_id
		left join m_polsek sek on sek.`id_polsek` = p.id_polsek
		left join m_polres res on res.`id_polres` = sek.id_polsek
		where p.id_polres = '$id_polres'
		and  tanggal < '$tanggal' and penyelesaian in ('sidik','lidik')";
		}
		else {
			$sql.=" where tanggal < '$tanggal' and penyelesaian in ('sidik','lidik') ";
		}


		$sql.=" 
		) x  on gk.id = x.id_gol_kejahatan
		group by gk.id";

	$res  = $this->db->query($sql);
	// echo $this->db->last_query();
	$arr = array();
	foreach($res->result() as $row) : 
		$arr[$row->id] = $row->jumlah;
	endforeach;
	// show_array($arr); exit;

	return $arr;



 }
 

 function get_data_gol_kejahatan2($bulan,$tahun,$jenis,$id_polres){
		

		//echo "$jenis $id_polres <hr />";

$sql  = "select gk.id,gk.golongan_kejahatan, count(x.bulan) as jumlah,
ifnull(sum(x.p21),0) as p21,
ifnull(sum(x.tcb),0) as tcb,
ifnull(sum(x.bpp),0) as bpp,
ifnull(sum(x.adc),0) as adc,
ifnull(sum(x.nii),0) as nii,
ifnull(sum(x.tm),0) as tm,
ifnull(sum(x.tg),0) as tg,
ifnull(sum(x.exp),0) as exp,
ifnull(sum(x.p21),0) + ifnull(sum(x.tcb),0) + ifnull(sum(x.bpp),0) + ifnull(sum(x.adc),0) + ifnull(sum(x.nii),0) + ifnull(sum(x.tm),0) + ifnull(sum(x.tg),0) + ifnull(sum(x.exp),0)  as jml_selesai,

ifnull(sum(x.sidik),0) as sidik,
ifnull(sum(x.lidik),0) as lidik , 
ifnull(sum(x.sidik),0)  + ifnull(sum(x.lidik),0)  as lidiksidik
from m_golongan_kejahatan gk 
  join 
 (
select lap_a_id as id, 'a' as tb, id_gol_kejahatan, month(tanggal) bulan, year(tanggal) tahun,
if(penyelesaian='p21',1,0) as p21,
if(penyelesaian='dihentikan' and alasan='tidakcukupbukti' ,1,0) as tcb,
if(penyelesaian='dihentikan' and alasan='bukanpkrpidana' ,1,0) as bpp,
if(penyelesaian='dihentikan' and alasan='aduandicabut' ,1,0) as adc,
if(penyelesaian='dihentikan' and alasan='nebisinidem' ,1,0) as nii,
if(penyelesaian='dihentikan' and alasan='tskmati' ,1,0) as tm,
if(penyelesaian='dihentikan' and alasan='tskgila' ,1,0) as tg,
if(penyelesaian='dihentikan' and alasan='kadaluarsa' ,1,0) as exp,
if(penyelesaian='sidik',1,0) as sidik,
if(penyelesaian='lidik',1,0) as lidik
from lap_a a ";

if($jenis=="polres") { 
$sql .= "
join pengguna p on p.id = a.user_id
left join m_polsek sek on sek.`id_polsek` = p.id_polsek
left join m_polres res on res.`id_polres` = sek.id_polsek
where p.id_polres = '$id_polres'
and  month(tanggal) = '$bulan' and year(tanggal) = '$tahun' ";
}
else {
	$sql .= " where  month(tanggal) = '$bulan' and year(tanggal) = '$tahun' ";
}

$sql .= "
union 
select lap_b_id as id, 'b' as tb, id_gol_kejahatan, month(tanggal) bulan, year(tanggal) tahun,
if(penyelesaian='p21',1,0) as p21,
if(penyelesaian='dihentikan' and alasan='tidakcukupbukti' ,1,0) as tcb,
if(penyelesaian='dihentikan' and alasan='bukanpkrpidana' ,1,0) as bpp,
if(penyelesaian='dihentikan' and alasan='aduandicabut' ,1,0) as adc,
if(penyelesaian='dihentikan' and alasan='nebisinidem' ,1,0) as nii,
if(penyelesaian='dihentikan' and alasan='tskmati' ,1,0) as tm,
if(penyelesaian='dihentikan' and alasan='tskgila' ,1,0) as tg,
if(penyelesaian='dihentikan' and alasan='kadaluarsa' ,1,0) as exp,
if(penyelesaian='sidik',1,0) as sidik,
if(penyelesaian='lidik',1,0) as lidik
from lap_b a ";

if($jenis=="polres") { 
$sql .= "
join pengguna p on p.id = a.user_id
left join m_polsek sek on sek.`id_polsek` = p.id_polsek
left join m_polres res on res.`id_polres` = sek.id_polsek
where p.id_polres = '$id_polres'
and  month(tanggal) = '$bulan' and year(tanggal) = '$tahun' ";
}
else {
	$sql .= " where  month(tanggal) = '$bulan' and year(tanggal) = '$tahun' ";
}

$sql .= "


) x  on gk.id = x.id_gol_kejahatan
group by gk.id";

		$res = $this->db->query($sql);

		// echo $this->db->last_query(); 
		//exit;

		return $res;
}

 

}