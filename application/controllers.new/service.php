<?php 
class service extends CI_Controller {
	function service(){
		parent::_construct();
	} 


	function get_user_info(){
		$post = $this->input->post();

		$sql="select * from pengguna left join m_pangkat on m_pangkat.id_pangkat = pengguna.id_pangkat left join m_polres on m_polres.id_polres = pengguna.id_polres left join m_kesatuan on m_kesatuan.id_kesatuan = pengguna.id_kesatuan "; 
		$sql.=" where user_id = '".$post['user_id']."'";

		$res  = $this->db->query($sql);

		$data = $res->row_array();
		echo json_encode($data);

	}
}

?>