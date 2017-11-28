<?php
class ex_whos_online_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function getUserOnline(){
		$time = strtotime("-2 minutes");
		$now = time();
		$this->db->select("*")
				->from("ci_sessions")
				->where('last_activity >=', $time)
				->where('last_activity <=', $now);
		return $this->db->get()->result_array();
	}
}
?>