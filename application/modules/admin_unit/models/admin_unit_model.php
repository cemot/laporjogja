<?php
class admin_unit_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}

 

function data($param){

	// show_array($param);

	// echo "param id_kesatuan ". $param['id_kesatuan'];

	if($param['id_kesatuan']=="null") {
		$param['id_kesatuan'] = "x";
	}

	if($param['id_subdit']=="null") {
		$param['id_subdit'] = "x";
	}

// show_array($param);


	$arr_column = array(0=>"unit","subdit","kesatuan","jenis");

	$sort_by = $arr_column[$param['sort_by']];

	$this->db->select('u.*,dit.*,sat.kesatuan,sat.jenis')
	->from("m_unit u")
	->join("m_subdit dit",'u.id_subdit=dit.id_subdit')
	->join("m_kesatuan sat",'sat.id_kesatuan = dit.id_kesatuan');

	if($param['nama'] <> '') {
		$this->db->like('subdit',$param['nama']);
	}

	if($param['jenis']<>'x') {
		$this->db->where("sat.jenis",$param['jenis']);
	}

	if($param['id_kesatuan']<>'x') {
		$this->db->where("sat.id_kesatuan",$param['id_kesatuan']);
	}

	if($param['id_subdit']<>'x') {
		$this->db->where("dit.id_kesatuan",$param['id_subdit']);
	}


	 

	

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by,$param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();

}


	 

 
function detail($id){
	
	$this->db->select('u.*,dit.*,sat.kesatuan,sat.jenis')
	->from("m_unit u")
	->join("m_subdit dit",'u.id_subdit=dit.id_subdit')
	->join("m_kesatuan sat",'sat.id_kesatuan = dit.id_kesatuan');
	$this->db->where("id_unit",$id);
	$ret = $this->db->get();
	return $ret;
}

	
}
?>