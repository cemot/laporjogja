<?php
class pengaturan extends master_controller  {
	function pengaturan(){
		parent::__construct();
		$this->load->helper("tanggal");
		$this->load->model("coremodel","cm");


		$this->controller = get_class($this);
	}
	
	
	function index(){
		$arr = array();

		$this->db->where("1=1",null,false);
		$data_array = $this->db->get("m_setting_polda")->row_array();

		$userdata = $_SESSION['userdata'];

		if($userdata['jenis']=='polda'){
			$this->db->where("1=1",null,false);
			$data = $this->db->get("m_setting_polda")->row_array();
			// show_array($data);

			$arr['id'] = null;
			$arr['nama'] = $data['nama_polda'];
			$arr['alamat'] = $data['alamat'];
			$arr['tempat'] = $data['tempat'];
			$arr['alamat'] = $data['alamat'];

		}
		else if($userdata['jenis']=='polres') {
			$this->db->where("id_polres",$userdata['id_polres']);
			$data = $this->db->get("m_polres")->row_array();
			$arr['id'] = $data['id_polres'];
			$arr['nama'] = $data['nama_polres'];
			$arr['alamat'] = $data['alamat'];
			$arr['tempat'] = $data['tempat'];
		}

		else if($userdata['jenis']=='polsek') {
			$this->db->where("id_polsek",$userdata['id_polsek']);
			$data = $this->db->get("m_polsek")->row_array();
			$arr['id'] = $data['id_polsek'];
			$arr['nama'] = $data['nama_polsek'];
			$arr['alamat'] = $data['alamat'];
			$arr['tempat'] = $data['tempat'];
		}

		$_SESSION['arr'] = $arr;

		//$data_array = array();
		$arr['userdata'] = $userdata;
		$content = $this->load->view($this->controller."_view",$arr,true);

		$this->set_subtitle("PENGATURAN DATA POLDA");
		$this->set_title("PENGATURAN DATA POLDA");
		$this->set_content($content);
		$this->render_baru();
	}


function save(){
	$post = $this->input->post();
	

	$userdata=$_SESSION['userdata'];
	$arr = $_SESSION['arr'];

	// show_array($userdata);

	if($userdata['jenis']=="polda") {
		$post['nama_polda'] = $post['nama'];
		unset($post['nama']);
		$res = $this->db->update("m_setting_polda",$post);
		// echo $this->db->last_query(); 
	}
	else if ($userdata['jenis']=="polres") {
		$post['nama_polres'] = $post['nama'];
		unset($post['nama']);
		$this->db->where("id_polres",$arr['id']);
		$res = $this->db->update("m_polres",$post);
	} 

	else if ($userdata['jenis']=="polsek") {
		$post['nama_polsek'] = $post['nama'];
		unset($post['nama']);
		$this->db->where("id_polsek",$arr['id']);
		$res = $this->db->update("m_polsek",$post);
	} 

// 
	//echo $this->db->last_query();

	$jenis = $userdata['jenis'];

	if($res) {
		$ret = array("error"=>false,"message"=>"Data setting $jenis berhasil disimpan");
	}
	else {
		$ret = array("error"=>true,"message"=>"Data setting $jenis gagal disimpan".mysql_error());
	}
	echo json_encode($ret);

}
 
}
?>