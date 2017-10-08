<?php
class admin_subdit_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}

 

function data($param){

	// show_array($param);

	$arr_column = array(0=>"subdit","kesatuan","jenis");

	$sort_by = $arr_column[$param['sort_by']];

	$this->db->select('dit.*,sat.kesatuan,sat.jenis')
	->from("m_subdit dit")
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



	 

	

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by,$param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();

}


	 

 
function detail($id){
	
	$this->db->select("s.*, sat.jenis")
	->from("m_subdit s")->join("m_kesatuan sat",'sat.id_kesatuan=s.id_kesatuan')
	->where("s.id_subdit",$id);
	$ret = $this->db->get();
	// echo $this->db->last_query(); 
	return $ret;
}

	
}
?>