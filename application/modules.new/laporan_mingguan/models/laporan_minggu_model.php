<?php

class laporan_minggu_model extends CI_Model {
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


	function get_data_gol_kejahatan($id_kelompok,$tanggal,$tanggal2){
		

		$sql  = "select gk.id, gk.golongan_kejahatan, ifnull(total,0) as total, ifnull(belum,0) as belum, ifnull(selesai,0) as selesai  



		from m_golongan_kejahatan gk  left join (

		select x.id_gol_kejahatan, sum(x.belum) as belum ,  sum(x.selesai)  as selesai, count(*) as  total  from ( 

		select lap_a_id as id,tanggal,id_gol_kejahatan,penyelesaian,
		if(penyelesaian='sidik' or penyelesaian = 'lidik' ,1,0) as belum , 
		if(penyelesaian='sidik' or penyelesaian = 'lidik'  ,0,1) as selesai
		from lap_a
		union 
		select lap_b_id as id ,tanggal,id_gol_kejahatan,penyelesaian,
		if(penyelesaian='sidik' or penyelesaian = 'lidik'  ,1,0) as belum , 
		if(penyelesaian='sidik' or penyelesaian = 'lidik'  ,0,1) as selesai
		from lap_b
		) x 
		where x.tanggal between '$tanggal' and '$tanggal2'
		group by x.id_gol_kejahatan ) y on y.id_gol_kejahatan = gk.id 
		where gk.id_kelompok = '$id_kelompok'
		";
		$res = $this->db->query($sql);

		return $res;
	}


	function get_data_gol_kejahatan2($id_kelompok,$tanggal,$tanggal2){
		

		// $sql  = "select gk.id, gk.golongan_kejahatan, ifnull(total,0) as total, ifnull(belum,0) as belum, ifnull(selesai,0) as selesai  



		// from m_golongan_kejahatan gk  left join (

		// select x.id_gol_kejahatan, sum(x.belum) as belum ,  sum(x.selesai)  as selesai, count(*) as  total  from ( 

		// select lap_a_id as id,tanggal,id_gol_kejahatan,penyelesaian,if(penyelesaian='' or penyelesaian is null ,1,0) as belum , 
		// if(penyelesaian='' or penyelesaian is null ,0,1) as selesai
		// from lap_a
		// union 
		// select lap_b_id as id ,tanggal,id_gol_kejahatan,penyelesaian,if(penyelesaian='' or penyelesaian is null ,1,0) as belum , 
		// if(penyelesaian='' or penyelesaian is null ,0,1) as selesai
		// from lap_b
		// ) x 
		// where x.tanggal between '$tanggal' and '$tanggal2'
		// group by x.id_gol_kejahatan ) y on y.id_gol_kejahatan = gk.id 
		// where gk.id_kelompok = '$id_kelompok'
		// ";

		$sql = "
			select gk.golongan_kejahatan, ifnull(md,0)  md ,  ifnull(lr,0) lr,  ifnull(lb,0) lb, ifnull(kejadian,0) kejadian, ifnull(kerugian,0) as kerugian 

			from m_golongan_kejahatan gk 
				left join ( 

				select d.id_gol_kejahatan, 
				sum((korban_mati_l + korban_mati_p )) md, 
				sum((korban_luka_ringan_l +  korban_luka_ringan_p)) lr,  
				sum((korban_luka_berat_l +  korban_luka_berat_p)) lb,
				count(*) as kejadian, 
				sum(d.korban_seluruh_jumlah) as kerugian 		
				from m_golongan gol 
						join m_kelompok_kejahatan kel on kel.id_golongan = gol.id 
						join m_golongan_kejahatan gk on gk.id_kelompok = kel.id_kelompok 

				join lap_d d  on d.id_gol_kejahatan = gk.id
				where d.tanggal between '$tanggal' and '$tanggal2'
				group by gk.id ) x 
				on gk.id = x.id_gol_kejahatan
				where gk.id_kelompok = '$id_kelompok'
		";
		$res = $this->db->query($sql);

		return $res;
	}



	function get_jumlah_kejahatan($tanggal,$id_gol_kejahatan){
		$tanggal = flipdate($tanggal);
		$sql = "
		select count(*) as jumlah from 
(select lap_a_id,tanggal,id_gol_kejahatan from lap_a
union 
select lap_b_id,tanggal,id_gol_kejahatan from lap_b
union 
select lap_d_id,tanggal,id_gol_kejahatan from lap_d)  x 
where x.tanggal='$tanggal' and x.id_gol_kejahatan='$id_gol_kejahatan'

		";

		$res = $this->db->query($sql)->row();
		// echo $this->db->last_query(); //exit;
		return $res->jumlah; 
		 
	}


function get_data_laporan($tanggal,$tanggal2) {
	// $sql="select gol.golongan, kel.kelompok, gk.golongan_kejahatan , count(x.tanggal) as jumlah from m_golongan gol join m_kelompok_kejahatan kel on kel.id_golongan = gol.id join m_golongan_kejahatan gk on gk.id_kelompok = kel.id_kelompok join ( select 'a' as tb,lap_a_id as id, tanggal,id_gol_kejahatan from lap_a union select 'b' as tb,lap_b_id as id,tanggal,id_gol_kejahatan from lap_b union select 'c' as tb,lap_d_id as id,tanggal,id_gol_kejahatan from lap_d ) x on gk.id = x.id_gol_kejahatan 
	// 	where x.tanggal between '$tanggal'  and '$tanggal2'
	// 	group by gk.id order by gol.id, kel.id_kelompok, gk.id ";

	$sql = "select gol.golongan, kel.kelompok, gk.golongan_kejahatan , y.belum, y.selesai, y.total
		from m_golongan gol 
		join m_kelompok_kejahatan kel on kel.id_golongan = gol.id 
		join m_golongan_kejahatan gk on gk.id_kelompok = kel.id_kelompok 

		join (
		select x.id_gol_kejahatan, sum(x.belum) as belum ,  sum(x.selesai)  as selesai, count(*) as  total  from ( 

				select lap_a_id as id,tanggal,id_gol_kejahatan,penyelesaian,
				if(penyelesaian='sidik' or penyelesaian = 'lidik'  ,1,0) as belum , 
				if(penyelesaian='sidik' or penyelesaian = 'lidik'  ,0,1) as selesai
				from lap_a
				union 
				select lap_b_id as id ,tanggal,id_gol_kejahatan,penyelesaian,
				if(penyelesaian='sidik' or penyelesaian = 'lidik'  ,1,0) as belum , 
				if(penyelesaian='sidik' or penyelesaian = 'lidik'  ,0,1) as selesai
				from lap_b
				) x 
				where x.tanggal between  '$tanggal'  and '$tanggal2'
				group by x.id_gol_kejahatan

		) y on y.id_gol_kejahatan = gk.id order by   gol.id, kel.id_kelompok, gk.id"; 


		 


	$res = $this->db->query($sql);
	return $res;
	
}


function get_data_laporan_bencana($tanggal,$tanggal2) {
	$sql = "select gol.golongan, kel.kelompok, gk.golongan_kejahatan,   
			sum((korban_mati_l + korban_mati_p )) md, 
			sum((korban_luka_ringan_l +  korban_luka_ringan_p)) lr,  
			sum((korban_luka_berat_l +  korban_luka_berat_p)) lb 		
			from m_golongan gol 
					join m_kelompok_kejahatan kel on kel.id_golongan = gol.id 
					join m_golongan_kejahatan gk on gk.id_kelompok = kel.id_kelompok 

			join lap_d d  on d.id_gol_kejahatan = gk.id
			where d.tanggal between  '$tanggal'  and '$tanggal2'
			group by gk.id
			"; 
	$res = $this->db->query($sql);
	return $res;
}


}