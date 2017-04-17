<?php 
class sync extends CI_Controller {
	function sync(){
		parent::__construct();
	}





function test(){
	echo json_encode(array("error"=>false));
}



function send(){
	$post = $this->input->post();

	// show_array($post);
	// exit;

	$arr_data = json_decode($post['data']);

	// show_array($arr_data); exit;


	$ret = array();

	if(isset($arr_data->pengguna)){

	 	foreach($arr_data->pengguna as $row_pengguna):
	 		$data_pengguna = (array) $row_pengguna;

	 		$this->db->where("id",$data_pengguna['id']); 
	 		$res = $this->db->get("pengguna");
	 		if($res->num_rows() == 0 ) { // input baru
	 			
	 			$this->db->insert("pengguna",$data_pengguna);
	 		}
	 		else {
	 			$this->db->where("id",$data_pengguna['id']);
	 			$this->db->update("pengguna",$data_pengguna);

	 		}

	 		
	 		$ret['pengguna']['id'][] = $data_pengguna['id'];

	 	endforeach;

	}

	// proses pasal 

	if(isset($arr_data->pasal)){

	 	foreach($arr_data->pasal as $row_pasal):
	 		$data_pasal = (array) $row_pasal;

	 		$this->db->where("id",$data_pasal['id']); 
	 		$res = $this->db->get("m_pasal");
	 		if($res->num_rows() == 0 ) { // input baru
	 			
	 			$this->db->insert("m_pasal",$data_pasal);
	 		}
	 		else {
	 			$this->db->where("id",$data_pasal['id']);
	 			$this->db->update("m_pasal",$data_pasal);

	 		}

	 		//echo $this->db->last_query();
	 		$ret['m_pasal']['id'][] = $data_pasal['id'];
	 	endforeach;

	}


	// proses lap a 
	if(isset($arr_data->lap_a)){
		foreach($arr_data->lap_a as $row_lap_a): 
			$data_lap_a = (array) $row_lap_a;

			// $data_lap_a_


			if(isset($data_lap_a['lap_a_pasal'])) {
					$data_lap_a_pasal = $data_lap_a['lap_a_pasal']; 
					unset($data_lap_a['lap_a_pasal']);
			}


			if(isset($data_lap_a['lap_a_tersangka'])) {
					$data_lap_a_tersangka = $data_lap_a['lap_a_tersangka']; 
					unset($data_lap_a['lap_a_tersangka']);
			}

			if(isset($data_lap_a['lap_a_saksi'])) {
					$data_lap_a_saksi = $data_lap_a['lap_a_saksi']; 
					unset($data_lap_a['lap_a_saksi']);
			}

			if(isset($data_lap_a['lap_a_korban'])) {
					$data_lap_a_korban = $data_lap_a['lap_a_korban']; 
					unset($data_lap_a['lap_a_korban']);
			}

			if(isset($data_lap_a['lap_a_barbuk'])) {
					$data_lap_a_barbuk = $data_lap_a['lap_a_barbuk']; 
					unset($data_lap_a['lap_a_barbuk']);
			}

			if(isset($data_lap_a['lap_a_penyidik'])) {
					$data_lap_a_penyidik = $data_lap_a['lap_a_penyidik']; 
					unset($data_lap_a['lap_a_penyidik']);
			}

			if(isset($data_lap_a['lap_a_perkembangan'])) {
					$data_lap_a_perkembangan = $data_lap_a['lap_a_perkembangan']; 
					unset($data_lap_a['lap_a_perkembangan']);
			}


			$this->db->where("lap_a_id",$data_lap_a['lap_a_id']);
			$this->db->delete("lap_a");
			// echo $this->db->last_query()."<br />";


			$this->db->insert("lap_a",$data_lap_a);
			// echo $this->db->last_query()."<br />";

			if(isset($data_lap_a_tersangka)) {
				foreach($data_lap_a_tersangka as $row_tersangka): 
					// show_array($row_tersangka);
					$data_tersangka = (array) $row_tersangka;
					// show_array($data_tersangka);
					$this->db->insert("lap_a_tersangka",$data_tersangka);
				endforeach;	 
			}

			if(isset($data_lap_a_saksi)) {
				foreach($data_lap_a_saksi as $row_saksi): 
					// show_array($row_saksi);
					$data_saksi = (array) $row_saksi;
					// show_array($data_saksi);
					$this->db->insert("lap_a_saksi",$data_saksi);
				endforeach;	 
			}

			if(isset($data_lap_a_korban)) {
				foreach($data_lap_a_korban as $row_korban): 
					// show_array($row_korban);
					$data_korban = (array) $row_korban;
					// show_array($data_korban);
					$this->db->insert("lap_a_korban",$data_korban);
				endforeach;	 
			}

			if(isset($data_lap_a_barbuk)) {
				foreach($data_lap_a_barbuk as $row_barbuk): 
					// show_array($row_barbuk);
					$data_barbuk = (array) $row_barbuk;
					// show_array($data_barbuk);
					$this->db->insert("lap_a_barbuk",$data_barbuk);
				endforeach;	 
			}

			if(isset($data_lap_a_penyidik)) {
				foreach($data_lap_a_penyidik as $row_penyidik): 
					// show_array($row_penyidik);
					$data_penyidik = (array) $row_penyidik;
					// show_array($data_penyidik);
					$this->db->insert("lap_a_penyidik",$data_penyidik);
				endforeach;	 
			}

			if(isset($data_lap_a_perkembangan)) {
				foreach($data_lap_a_perkembangan as $row_perkembangan): 
					// show_array($row_perkembangan);
					$data_perkembangan = (array) $row_perkembangan;
					// show_array($data_perkembangan);
					$this->db->insert("lap_a_perkembangan",$data_perkembangan);
				endforeach;	 
			}

			if(isset($data_lap_a_pasal)) {
				foreach($data_lap_a_pasal as $row_pasal): 
					// show_array($row_pasal);
					$data_pasal = (array) $row_pasal;
					// show_array($data_pasal);
					$this->db->insert("lap_a_pasal",$data_pasal);
				endforeach;	 
			}

			
			$ret['lap_a']['lap_a_id'][] = $data_lap_a['lap_a_id'];
		endforeach;
	} // end of proses lap a


	// prose lap b
	if(isset($arr_data->lap_b)){
		foreach($arr_data->lap_b as $row_lap_b): 
			$data_lap_b = (array) $row_lap_b;

			// $data_lap_b_
			if(isset($data_lap_b['lap_b_pasal'])) {
					$data_lap_b_pasal = $data_lap_b['lap_b_pasal']; 
					unset($data_lap_b['lap_b_pasal']);
			}


			if(isset($data_lap_b['lap_b_tersangka'])) {
					$data_lap_b_tersangka = $data_lap_b['lap_b_tersangka']; 
					unset($data_lap_b['lap_b_tersangka']);
			}

			if(isset($data_lap_b['lap_b_saksi'])) {
					$data_lap_b_saksi = $data_lap_b['lap_b_saksi']; 
					unset($data_lap_b['lap_b_saksi']);
			}

			if(isset($data_lap_b['lap_b_korban'])) {
					$data_lap_b_korban = $data_lap_b['lap_b_korban']; 
					unset($data_lap_b['lap_b_korban']);
			}

			if(isset($data_lap_b['lap_b_barbuk'])) {
					$data_lap_b_barbuk = $data_lap_b['lap_b_barbuk']; 
					unset($data_lap_b['lap_b_barbuk']);
			}

			if(isset($data_lap_b['lap_b_penyidik'])) {
					$data_lap_b_penyidik = $data_lap_b['lap_b_penyidik']; 
					unset($data_lap_b['lap_b_penyidik']);
			}

			if(isset($data_lap_b['lap_b_perkembangan'])) {
					$data_lap_b_perkembangan = $data_lap_b['lap_b_perkembangan']; 
					unset($data_lap_b['lap_b_perkembangan']);
			}




			$this->db->where("lap_b_id",$data_lap_b['lap_b_id']);
			$this->db->delete("lap_b");
			// echo $this->db->last_query()."<br />";


			$this->db->insert("lap_b",$data_lap_b);
			// echo $this->db->last_query()."<br />";

			if(isset($data_lap_b_tersangka)) {
				foreach($data_lap_b_tersangka as $row_tersangka): 
					// show_array($row_tersangka);
					$data_tersangka = (array) $row_tersangka;
					// show_array($data_tersangka);
					$this->db->insert("lap_b_tersangka",$data_tersangka);
				endforeach;	 
			}

			if(isset($data_lap_b_saksi)) {
				foreach($data_lap_b_saksi as $row_saksi): 
					// show_array($row_saksi);
					$data_saksi = (array) $row_saksi;
					// show_array($data_saksi);
					$this->db->insert("lap_b_saksi",$data_saksi);
				endforeach;	 
			}

			if(isset($data_lap_b_korban)) {
				foreach($data_lap_b_korban as $row_korban): 
					// show_array($row_korban);
					$data_korban = (array) $row_korban;
					// show_array($data_korban);
					$this->db->insert("lap_b_korban",$data_korban);
				endforeach;	 
			}

			if(isset($data_lap_b_barbuk)) {
				foreach($data_lap_b_barbuk as $row_barbuk): 
					// show_array($row_barbuk);
					$data_barbuk = (array) $row_barbuk;
					// show_array($data_barbuk);
					$this->db->insert("lap_b_barbuk",$data_barbuk);
				endforeach;	 
			}

			if(isset($data_lap_b_penyidik)) {
				foreach($data_lap_b_penyidik as $row_penyidik): 
					// show_array($row_penyidik);
					$data_penyidik = (array) $row_penyidik;
					// show_array($data_penyidik);
					$this->db->insert("lap_b_penyidik",$data_penyidik);
				endforeach;	 
			}

			if(isset($data_lap_b_perkembangan)) {
				foreach($data_lap_b_perkembangan as $row_perkembangan): 
					// show_array($row_perkembangan);
					$data_perkembangan = (array) $row_perkembangan;
					// show_array($data_perkembangan);
					$this->db->insert("lap_b_perkembangan",$data_perkembangan);
				endforeach;	 
			}


			if(isset($data_lap_b_pasal)) {
				foreach($data_lap_b_pasal as $row_pasal): 
					// show_array($row_pasal);
					$data_pasal = (array) $row_pasal;
					// show_array($data_pasal);
					$this->db->insert("lap_b_pasal",$data_pasal);
				endforeach;	 
			}

			
			$ret['lap_b']['lap_b_id'][] = $data_lap_b['lap_b_id'];
		endforeach;
	}  // end of lap b 


	// proses lap c
	if(isset($arr_data->lap_c)){
		foreach($arr_data->lap_c as $row_lap_c): 
			$data_lap_c = (array) $row_lap_c;

			 

			if(isset($data_lap_c['lap_c_penyidik'])) {
					$data_lap_c_penyidik = $data_lap_c['lap_c_penyidik']; 
					unset($data_lap_c['lap_c_penyidik']);
			}

			if(isset($data_lap_c['lap_c_perkembangan'])) {
					$data_lap_c_perkembangan = $data_lap_c['lap_c_perkembangan']; 
					unset($data_lap_c['lap_c_perkembangan']);
			}


			$this->db->where("lap_c_id",$data_lap_c['lap_c_id']);
			$this->db->delete("lap_c");
			// echo $this->db->last_query()."<br />";


			$this->db->insert("lap_c",$data_lap_c);
			// echo $this->db->last_query()."<br />";

			 

			if(isset($data_lap_c_penyidik)) {
				foreach($data_lap_c_penyidik as $row_penyidik): 
					// show_array($row_penyidik);
					$data_penyidik = (array) $row_penyidik;
					// show_array($data_penyidik);
					$this->db->insert("lap_c_penyidik",$data_penyidik);
				endforeach;	 
			}

			if(isset($data_lap_c_perkembangan)) {
				foreach($data_lap_c_perkembangan as $row_perkembangan): 
					// show_array($row_perkembangan);
					$data_perkembangan = (array) $row_perkembangan;
					// show_array($data_perkembangan);
					$this->db->insert("lap_c_perkembangan",$data_perkembangan);
				endforeach;	 
			}


			 

			$ret['lap_c']['lap_c_id'][] = $data_lap_c['lap_c_id'];	

		endforeach;
	} // end of lap c 


	// proses lap d
	if(isset($arr_data->lap_d)){
		foreach($arr_data->lap_d as $row_lap_d): 
			$data_lap_d = (array) $row_lap_d;

			 

			if(isset($data_lap_d['lap_d_penyidik'])) {
					$data_lap_d_penyidik = $data_lap_d['lap_d_penyidik']; 
					unset($data_lap_d['lap_d_penyidik']);
			}

			if(isset($data_lap_d['lap_d_perkembangan'])) {
					$data_lap_d_perkembangan = $data_lap_d['lap_d_perkembangan']; 
					unset($data_lap_d['lap_d_perkembangan']);
			}


			$this->db->where("lap_d_id",$data_lap_d['lap_d_id']);
			$this->db->delete("lap_d");
			// echo $this->db->last_query()."<br />";


			$this->db->insert("lap_d",$data_lap_d);
			// echo $this->db->last_query()."<br />";

			 

			if(isset($data_lap_d_penyidik)) {
				foreach($data_lap_d_penyidik as $row_penyidik): 
					// show_array($row_penyidik);
					$data_penyidik = (array) $row_penyidik;
					// show_array($data_penyidik);
					$this->db->insert("lap_d_penyidik",$data_penyidik);
				endforeach;	 
			}

			if(isset($data_lap_d_perkembangan)) {
				foreach($data_lap_d_perkembangan as $row_perkembangan): 
					// show_array($row_perkembangan);
					$data_perkembangan = (array) $row_perkembangan;
					// show_array($data_perkembangan);
					$this->db->insert("lap_d_perkembangan",$data_perkembangan);
				endforeach;	 
			}


			 

		$ret['lap_d']['lap_d_id'][] = $data_lap_d['lap_d_id'];	

		endforeach;
	} // end of lap d


	// proses lap laka 
	if(isset($arr_data->lap_laka_lantas)){
		foreach($arr_data->lap_laka_lantas as $row_lap_laka_lantas): 
			$data_lap_laka_lantas = (array) $row_lap_laka_lantas;

			// $data_lap_laka_lantas_


			 


			if(isset($data_lap_laka_lantas['lap_laka_pengemudi'])) {
					$data_lap_laka_pengemudi = $data_lap_laka_lantas['lap_laka_pengemudi']; 
					unset($data_lap_laka_lantas['lap_laka_pengemudi']);
			}

			if(isset($data_lap_laka_lantas['lap_laka_saksi'])) {
					$data_lap_laka_saksi = $data_lap_laka_lantas['lap_laka_saksi']; 
					unset($data_lap_laka_lantas['lap_laka_saksi']);
			}

			if(isset($data_lap_laka_lantas['lap_laka_korban'])) {
					$data_lap_laka_korban = $data_lap_laka_lantas['lap_laka_korban']; 
					unset($data_lap_laka_lantas['lap_laka_korban']);
			}

			if(isset($data_lap_laka_lantas['lap_laka_kendaraan'])) {
					$data_lap_laka_kendaraan = $data_lap_laka_lantas['lap_laka_kendaraan']; 
					unset($data_lap_laka_lantas['lap_laka_kendaraan']);
			}

			if(isset($data_lap_laka_lantas['lap_laka_penyidik'])) {
					$data_lap_laka_penyidik = $data_lap_laka_lantas['lap_laka_penyidik']; 
					unset($data_lap_laka_lantas['lap_laka_penyidik']);
			}

			if(isset($data_lap_laka_lantas['lap_laka_perkembangan'])) {
					$data_lap_laka_perkembangan = $data_lap_laka_lantas['lap_laka_perkembangan']; 
					unset($data_lap_laka_lantas['lap_laka_perkembangan']);
			}

			if(isset($data_lap_laka_lantas['lap_laka_pasal'])) {
					$data_lap_laka_pasal = $data_lap_laka_lantas['lap_laka_pasal']; 
					unset($data_lap_laka_lantas['lap_laka_pasal']);
			}


			$this->db->where("lap_laka_lantas_id",$data_lap_laka_lantas['lap_laka_lantas_id']);
			$this->db->delete("lap_laka_lantas");
			// echo $this->db->last_query()."<br />";


			$this->db->insert("lap_laka_lantas",$data_lap_laka_lantas);
			// echo $this->db->last_query()."<br />";

			if(isset($data_lap_laka_pengemudi)) {
				foreach($data_lap_laka_pengemudi as $row_pengemudi): 
					// show_array($row_pengemudi);
					$data_pengemudi = (array) $row_pengemudi;
					// show_array($data_tersangka);
					$this->db->insert("lap_laka_pengemudi",$data_pengemudi);
				endforeach;	 
			}

			if(isset($data_lap_laka_saksi)) {
				foreach($data_lap_laka_saksi as $row_saksi): 
					// show_array($row_saksi);
					$data_saksi = (array) $row_saksi;
					// show_array($data_saksi);
					$this->db->insert("lap_laka_saksi",$data_saksi);
				endforeach;	 
			}

			if(isset($data_lap_laka_korban)) {
				foreach($data_lap_laka_korban as $row_korban): 
					// show_array($row_korban);
					$data_korban = (array) $row_korban;
					// show_array($data_korban);
					$this->db->insert("lap_laka_korban",$data_korban);
				endforeach;	 
			}

			if(isset($data_lap_laka_kendaraan)) {
				foreach($data_lap_laka_kendaraan as $row_kendaraan): 
					// show_array($row_kendaraan);
					$data_kendaraan = (array) $row_kendaraan;
					// show_array($data_kendaraan);
					$this->db->insert("lap_laka_kendaraan",$data_kendaraan);
				endforeach;	 
			}

// data_lap_laka_penyidik
// data_lap_laka_perkembangan

			if(isset($data_lap_laka_penyidik)) {
				foreach($data_lap_laka_penyidik as $row_penyidik): 
					// show_array($row_penyidik);
					$data_penyidik = (array) $row_penyidik;
					// show_array($data_penyidik);
					$this->db->insert("lap_laka_penyidik",$data_penyidik);
				endforeach;	 
			}

			if(isset($data_lap_laka_perkembangan)) {
				foreach($data_lap_laka_perkembangan as $row_perkembangan): 
					// show_array($row_perkembangan);
					$data_perkembangan = (array) $row_perkembangan;
					// show_array($data_perkembangan);
					$this->db->insert("lap_laka_perkembangan",$data_perkembangan);
				endforeach;	 
			}


			if(isset($data_lap_laka_pasal)) {
				foreach($data_lap_laka_pasal as $row_pasal): 
					// show_array($row_pasal);
					$data_pasal = (array) $row_pasal;
					// show_array($data_pasal);
					$this->db->insert("lap_laka_pasal",$data_pasal);
				endforeach;	 
			}
			 

		$ret['lap_laka_lantas']['lap_laka_lantas_id'][] = $data_lap_laka_lantas['lap_laka_lantas_id'];	

		endforeach;
	} // end of proses lap laka


	$return = array("error"=>false,"data"=>$ret);
	//show_array($return);
	echo json_encode($return);
}

}
?>