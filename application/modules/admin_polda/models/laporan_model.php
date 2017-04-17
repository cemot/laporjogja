<?php

class laporan_model extends CI_Model {
	function laporan_model(){
		parent::__construct();
	}

	function get_data_golongan() {
		$res = $this->db->get("m_golongan");
		// echo $this->db->last_query(); exit;
		return $res;
	}

	function get_data_kelompok($id_golongan){
		$this->db->where("id_golongan",$id_golongan);
		$res  = $this->db->get("m_kelompok_kejahatan");
		return $res;
	}


	function get_data_gol_kejahatan($id_kelompok){
		$this->db->where("id_kelompok",$id_kelompok);
		$res  = $this->db->get("m_golongan_kejahatan");
		return $res;
	}

	function get_jumlah_kejahatan($tanggal,$id_gol_kejahatan){
		$tanggal = flipdate($tanggal);
		$sql = "
		select count(*) as jumlah from 
(select lap_a_id, tanggal,id_gol_kejahatan from lap_a
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


}