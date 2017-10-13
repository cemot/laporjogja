<?php
class ex_lap_d_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}

 

function data($param){

	// show_array($param);

	$arr_column = array(
						'nomor',
						'tanggal',
						'kejadian_uraian',
						'pelapor_nama',
						'nama_penyidik'
						);

	$sort_by = $arr_column[$param['sort_by']];

	$this->db->select('a.*')->from('v_lap_d a'); 
	$this->db->join('pengguna u','a.user_id = u.id');

				// "tanggal_awall" => $tanggal_awal, 
				// "tanggal_akhir" => $tanggal_akhir,
				// "id_fungsi" => $id_fungsi 


	if($param['jenis']<>'x'  ) {

		// echo "kok masuk sini";
		$this->db->where("u.jenis",$param['jenis']);

		if($param['jenis']=="polres") {
			$this->db->where("u.id_polres",$param['id_polres']);
		}
		else if($param['jenis']=="polsek") {
			$this->db->where("u.id_polsek",$param['id_polsek']);
		}


	}



    if($param['tanggal_awal']<> '') {
    	$tanggal_awal = flipdate($param['tanggal_awal']); 
    	$tanggal_akhir = flipdate($param['tanggal_akhir']); 
    	$this->db->where("tanggal between '$tanggal_awal' and '$tanggal_akhir'",null,false);
    }

   
     


	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();

}




function get_data_perkembangan($param){

	// show_array($param);

	$arr_column = array("lidik","tahap","no_dokumen","tanggal","keterangan");

	$sort_by = $arr_column[$param['sort_by']];

	$this->db->select('a.*,b.tahap')->from('lap_d_perkembangan a'); 
	$this->db->join("m_tahap b","a.id_tahap = b.id","left");

				// "tanggal_awall" => $tanggal_awal, 
				// "tanggal_akhir" => $tanggal_akhir,
				// "id_fungsi" => $id_fungsi 

    

    
    $this->db->where("a.lap_d_id",$param['lap_d_id']);




	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();

}

function get_perkembangan_detail_json($id){
	$this->db->where("id",$id);
	$data = $this->db->get("lap_d_perkembangan")->row_array();
	return $data;
}

	
}
?>