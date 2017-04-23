<?php
class a_pengguna_model extends CI_Model {
	function a_pengguna_model(){
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

	$this->db->select("a.*, b.pangkat, l.level  as level2, sat.kesatuan,
	   res.nama_polres, sek.nama_polsek
	 ")->from('pengguna a')
	->join('m_pangkat b','a.id_pangkat=b.id_pangkat','left')
	->join("m_polres res","res.id_polres = a.id_polres",'left')
	->join("m_polsek sek","sek.id_polsek=a.id_polsek","left")
	->join("m_kesatuan sat","sat.id_kesatuan=a.id_kesatuan","left")
	->join("m_level l",'l.id=a.level','left');

	if($param['nama'] <> '') {
		$nama = $param['nama'];
		//$this->db->like('nama',$param['nama']);
		$this->db->where(" ( nama like '%$nama%' or user_id like '%$nama%' )",null,false);
	}

	extract($param); 

	//echo "level = $level";

	if($level <> 'x' ) {
		
		$this->db->where("a.level",$level);
	} 
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


	 

 
function detail($id){
	$this->db->where("id",$id);
	$ret = $this->db->get('pengguna');
	return $ret;
}

	
}
?>