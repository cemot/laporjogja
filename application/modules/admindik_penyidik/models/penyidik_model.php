<?php
class penyidik_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}

 

function data($param){

	// show_array($param);

	$arr_column = array("user_id",
						"nama",
						"nomor_hp","email",
						"pangkat",
						"level"
		);

	$sort_by = $arr_column[$param['sort_by']];

	$this->db->select("a.*, b.pangkat, l.level  as level2,
	   res.nama_polres, sek.nama_polsek
	 ")->from('pengguna a',false)
	->join('m_pangkat b','a.id_pangkat=b.id_pangkat','left')
	->join("m_polres res","res.id_polres = a.id_polres",'left')
	->join("m_polsek sek","sek.id_polsek=a.id_polsek","left")
	->join("m_level l",'l.id=a.level','left')
	->join("m_unit unit","unit.id_unit=a.id_unit","left");




	if($param['id_kesatuan']<>'x') {
		$this->db->where("a.id_kesatuan",$param['id_kesatuan']);
	}
	if($param['id_subdit']<>'x') {
		$this->db->where("unit.id_subdit",$param['id_subdit']);
	}

	if($param['id_unit']<>'x') {
		$this->db->where("unit.id_unit",$param['id_unit']);
	}


	if($param['nama'] <> '') {
		$this->db->like('nama',$param['nama']);
	}

	extract($param); 

	if($userdata['jenis']=="polres"){
		$this->db->where("a.id_polres",$userdata['id_polres']);
	}
	if ($userdata['jenis']=="polsek") {
		$this->db->where("a.id_polsek",$userdata['id_polsek']);
	}

	$this->db->where("a.jenis",$userdata['jenis']);




	// if ($userdata['jenis']=="polda") {
	// 	$this->db->where("a.id_polda",$userdata['id_polda']);
	// }



	//echo "level = $level";

	// if($level <> 'x' ) {
		
		$this->db->where("a.level","2");
	// } 
	// else {
	// 	$this->db->where("a.level <> '0'",null,false);
	// }

	

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    // ($param['sort_by'] != null) ? $this->db->order_by($sort_by,$param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;
 	

	 

}


function get_arr_kesatuan(){
	$userdata = $this->session->userdata("userdata");

	$jenis = ($userdata['jenis']=="polda")?"polda":"polrespolsek";

	$this->db->where("jenis",$jenis);
	$this->db->order_by("kesatuan");
	$res = $this->db->get("m_kesatuan");
	// echo $this->db->last_query(); 
	foreach($res->result() as $row) : 
		$arr[$row->id_kesatuan] = $row->kesatuan;
	endforeach;
	return $arr;
}
	 

 
function detail($id){
	 
	$this->db->select("u.*, unit.id_subdit")
	->from('pengguna u')
	->join('m_unit unit','unit.id_unit=u.id_unit','left')
	->where("id",$id);
	$ret = $this->db->get();
	return $ret;
}

	
}
?>