<?php
class monitor_dashboard extends monitor_controller  {
	function monitor_dashboard(){
		parent::__construct();
		// echo "pilihan ".$this->session->userdata("pilihan"); exit;
		$this->load->model("coremodel","cm");
		$this->load->model("admindik_lap_b_model","dm");
	}
	
	
	function index(){
		
		$id = $_SESSION['lap_b_id'];

		$detail = $this->dm->detail($id);
		$detail['tanggal'] = flipdate($detail['tanggal']);

		$detail['rec_pasal'] = $this->dm->get_pasal($id);
		$detail['rec_tersangka'] = $this->dm->get_tersangka($id);
	    $detail['rec_saksi'] = $this->dm->get_saksi($id);
	    $detail['rec_korban'] = $this->dm->get_korban($id);
	    $detail['rec_barbuk'] = $this->dm->get_barbuk($id);



	      $this->db->select('a.*,b.tahap')
	    ->from('lap_b_perkembangan a'); 
	    $this->db->join("m_tahap b","a.id_tahap = b.id","left");
	    $this->db->order_by("tanggal,no_urut");    
	    $this->db->where("a.lap_b_id",$id);
	    $detail['rec_perkembangan'] = $this->db->get(); 


		$content = $this->load->view("monitor_dashboard_view",$detail,true);

		$this->set_subtitle("DASHBOARD MONITORING ");
		$this->set_title("DASHBOARD MONITORING ");
		$this->set_content($content);
		$this->render();
	}
}
?>