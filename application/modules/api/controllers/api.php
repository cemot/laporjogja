<?php 

class api extends CI_Controller {
	function api() {
		parent::__construct(); 
		$this->load->helper(array("tanggal","file"));
	}




	function pulldata(){
		$postdata = $this->input->post("jsondata"); 

		// echo "reposse from server <hr /"; 
		 
		$jsondata = json_decode($postdata); 



		
	 // show_array($jsondata); 
	 
	 	// echo "jenis ". $jsondata->jenis. "<br />";
	 	// echo "polres ". $jsondata->id_polres. "<br />";
	 	// echo "polsek ". $jsondata->id_polsek. "<br />";

	 	$jenis = $jsondata->jenis; 
	 	$id_polsek = $jsondata->id_polsek; 
	 	$id_polres = $jsondata->id_polres; 


	 	$res_array = array(); 

	 	/// processing lap_a_id 


	 	$arr_file = array();


	 	$this->db->select('a.*')->from("lap_a a")
	 	->join("pengguna u",'a.user_id = u.id');

	 	if($jenis == "polsek") {
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polsek",$id_polsek);
	 		$dirname = $jenis.$id_polsek; 
	 	}
	 	else if($jenis=="polres"){
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polres",$id_polres);
	 		$dirname = $jenis.$id_polres; 
	 	}
	 	else {
	 		$this->db->where("u.jenis","polda");
	 	}


	 	$res = $this->db->get(); 

	 	//echo $this->db->last_query();
	 	if($res->num_rows() > 0 ) {

	 		$res_array['lap_a']['index'] = "lap_a_id"; 
	 		foreach($res->result_array() as $row) :
	 			$res_array['lap_a']['data'][] = $row;


	 		 
	 			$this->db->where("lap_a_id",$row['lap_a_id']); 
	 			$rs_tersangka = $this->db->get("lap_a_tersangka");
	 			if($rs_tersangka->num_rows() > 0 ) {
	 					foreach($rs_tersangka->result_array() as $row_tersangka) : 
	 						$res_array['lap_a']['child']['lap_a_tersangka'][]=$row_tersangka; 
	 					endforeach;
	 			}


	 			$this->db->where("lap_a_id",$row['lap_a_id']); 
	 			$rs_saksi = $this->db->get("lap_a_saksi");
	 			if($rs_saksi->num_rows() > 0 ) {
	 					foreach($rs_saksi->result_array() as $row_saksi) : 
	 						$res_array['lap_a']['child']['lap_a_saksi'][]=$row_saksi; 
	 					endforeach;
	 			}
 
 				$this->db->where("lap_a_id",$row['lap_a_id']); 
	 			$rs_perkembangan = $this->db->get("lap_a_perkembangan");
	 			if($rs_perkembangan->num_rows() > 0 ) {
	 					foreach($rs_perkembangan->result_array() as $row_perkembangan) : 
	 						$res_array['lap_a']['child']['lap_a_perkembangan'][]=$row_perkembangan; 

	 						if($row_perkembangan['file_dokumen'] <> '') {
	 							$arr_file[] = $row_perkembangan['file_dokumen']; 
	 						}

	 					endforeach;
	 			}


	 			$this->db->where("lap_a_id",$row['lap_a_id']); 
	 			$rs_penyidik = $this->db->get("lap_a_penyidik");
	 			if($rs_penyidik->num_rows() > 0 ) {
	 					foreach($rs_penyidik->result_array() as $row_penyidik) : 
	 						$res_array['lap_a']['child']['lap_a_penyidik'][]=$row_penyidik; 
	 					endforeach;
	 			}

	 			$this->db->where("lap_a_id",$row['lap_a_id']); 
	 			$rs_korban = $this->db->get("lap_a_korban");
	 			if($rs_korban->num_rows() > 0 ) {
	 					foreach($rs_korban->result_array() as $row_korban) : 
	 						$res_array['lap_a']['child']['lap_a_korban'][]=$row_korban; 
	 					endforeach;
	 			}


	 			$this->db->where("lap_a_id",$row['lap_a_id']); 
	 			$rs_barbuk = $this->db->get("lap_a_barbuk");
	 			if($rs_barbuk->num_rows() > 0 ) {
	 					foreach($rs_barbuk->result_array() as $row_barbuk) : 
	 						$res_array['lap_a']['child']['lap_a_barbuk'][]=$row_barbuk; 
	 					endforeach;
	 			}


 			endforeach;

	 	}



	 	// ================= PROCESSING LAP B========================= // 

	 	 

	 	$this->db->select('a.*')->from("lap_b a")
	 	->join("pengguna u",'a.user_id = u.id');

	 	if($jenis == "polsek") {
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polsek",$id_polsek);
	 	}
	 	else if($jenis=="polres"){
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polres",$id_polres);
	 	}
	 	else {
	 		$this->db->where("u.jenis","polda");
	 	}


	 	$res = $this->db->get(); 

	 	// echo $this->db->last_query();

	 	// echo "jumlah ". $res->num_rows(); 

	 	if($res->num_rows() > 0 ) {
	 		$res_array['lap_b']['index'] = "lap_b_id"; 

	 		foreach($res->result_array() as $row) :

	 			// echo show_array($row); 
	 			$res_array['lap_b']['data'][] = $row;


	 		 
	 			$this->db->where("lap_b_id",$row['lap_b_id']); 
	 			$rs_tersangka = $this->db->get("lap_b_tersangka");
	 			if($rs_tersangka->num_rows() > 0 ) {
	 					foreach($rs_tersangka->result_array() as $row_tersangka) : 
	 						$res_array['lap_b']['child']['lap_b_tersangka'][]=$row_tersangka; 
	 					endforeach;
	 			}


	 			$this->db->where("lap_b_id",$row['lap_b_id']); 
	 			$rs_saksi = $this->db->get("lap_b_saksi");
	 			if($rs_saksi->num_rows() > 0 ) {
	 					foreach($rs_saksi->result_array() as $row_saksi) : 
	 						$res_array['lap_b']['child']['lap_b_saksi'][]=$row_saksi; 
	 					endforeach;
	 			}
 
 				$this->db->where("lap_b_id",$row['lap_b_id']); 
	 			$rs_perkembangan = $this->db->get("lap_b_perkembangan");
	 			if($rs_perkembangan->num_rows() > 0 ) {
	 					foreach($rs_perkembangan->result_array() as $row_perkembangan) : 
	 						$res_array['lap_b']['child']['lap_b_perkembangan'][]=$row_perkembangan; 

	 						if($row_perkembangan['file_dokumen'] <> '') {
	 							$arr_file[] = $row_perkembangan['file_dokumen']; 
	 						}

	 					endforeach;
	 			}


	 			$this->db->where("lap_b_id",$row['lap_b_id']); 
	 			$rs_penyidik = $this->db->get("lap_b_penyidik");
	 			if($rs_penyidik->num_rows() > 0 ) {
	 					foreach($rs_penyidik->result_array() as $row_penyidik) : 
	 						$res_array['lap_b']['child']['lap_b_penyidik'][]=$row_penyidik; 
	 					endforeach;
	 			}

	 			$this->db->where("lap_b_id",$row['lap_b_id']); 
	 			$rs_korban = $this->db->get("lap_b_korban");
	 			if($rs_korban->num_rows() > 0 ) {
	 					foreach($rs_korban->result_array() as $row_korban) : 
	 						$res_array['lap_b']['child']['lap_b_korban'][]=$row_korban; 
	 					endforeach;
	 			}


	 			$this->db->where("lap_b_id",$row['lap_b_id']); 
	 			$rs_barbuk = $this->db->get("lap_b_barbuk");
	 			if($rs_barbuk->num_rows() > 0 ) {
	 					foreach($rs_barbuk->result_array() as $row_barbuk) : 
	 						$res_array['lap_b']['child']['lap_b_barbuk'][]=$row_barbuk; 
	 					endforeach;
	 			}


 			endforeach;

	 	} 




	 	//show_array($res_array); 


	 	// ================= PROCESSING LAP C ========================= // 

	 	 
	 	$this->db->select('a.*')->from("lap_c a")
	 	->join("pengguna u",'a.user_id = u.id');

	 	if($jenis == "polsek") {
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polsek",$id_polsek);
	 	}
	 	else if($jenis=="polres"){
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polres",$id_polres);
	 	}
	 	else {
	 		$this->db->where("u.jenis","polda");
	 	}


	 	$res = $this->db->get(); 

	 	// echo $this->db->last_query();

	 	// echo "jumlah ". $res->num_rows(); 

	 	if($res->num_rows() > 0 ) {
	 		$res_array['lap_c']['index'] = "lap_c_id"; 

	 		foreach($res->result_array() as $row) :

	 			//echo show_array($row); 
	 			$res_array['lap_c']['data'][] = $row;


	 		 
	 			 
 
 				$this->db->where("lap_c_id",$row['lap_c_id']); 
	 			$rs_perkembangan = $this->db->get("lap_c_perkembangan");
	 			if($rs_perkembangan->num_rows() > 0 ) {
	 					foreach($rs_perkembangan->result_array() as $row_perkembangan) : 
	 						$res_array['lap_c']['child']['lap_c_perkembangan'][]=$row_perkembangan; 

	 					if($row_perkembangan['file_dokumen'] <> '') {
	 							$arr_file[] = $row_perkembangan['file_dokumen']; 
	 						}



	 					endforeach;
	 			}


	 			$this->db->where("lap_c_id",$row['lap_c_id']); 
	 			$rs_penyidik = $this->db->get("lap_c_penyidik");
	 			if($rs_penyidik->num_rows() > 0 ) {
	 					foreach($rs_penyidik->result_array() as $row_penyidik) : 
	 						$res_array['lap_c']['child']['lap_c_penyidik'][]=$row_penyidik; 
	 					endforeach;
	 			}

 


 			endforeach;

	 	}

	  



	 	// ================= PROCESSING LAP D ========================= // 
	 

	 	$this->db->select('a.*')->from("lap_d a")
	 	->join("pengguna u",'a.user_id = u.id');

	 	if($jenis == "polsek") {
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polsek",$id_polsek);
	 	}
	 	else if($jenis=="polres"){
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polres",$id_polres);
	 	}
	 	else {
	 		$this->db->where("u.jenis","polda");
	 	}


	 	$res = $this->db->get(); 

	 	// echo $this->db->last_query();

	 	// echo "jumlah ". $res->num_rows(); 

	 	if($res->num_rows() > 0 ) {
	 		$res_array['lap_d']['index'] = "lap_d_id"; 

	 		foreach($res->result_array() as $row) :

	 			//echo show_array($row); 
	 			$res_array['lap_d']['data'][] = $row;


	 		 
	 			 
 
 				$this->db->where("lap_d_id",$row['lap_d_id']); 
	 			$rs_perkembangan = $this->db->get("lap_d_perkembangan");
	 			if($rs_perkembangan->num_rows() > 0 ) {
	 					foreach($rs_perkembangan->result_array() as $row_perkembangan) : 
	 						$res_array['lap_d']['child']['lap_d_perkembangan'][]=$row_perkembangan; 


	 						if($row_perkembangan['file_dokumen'] <> '') {
	 							$arr_file[] = $row_perkembangan['file_dokumen']; 
	 						}


	 					endforeach;
	 			}


	 			$this->db->where("lap_d_id",$row['lap_d_id']); 
	 			$rs_penyidik = $this->db->get("lap_d_penyidik");
	 			if($rs_penyidik->num_rows() > 0 ) {
	 					foreach($rs_penyidik->result_array() as $row_penyidik) : 
	 						$res_array['lap_d']['child']['lap_d_perkembangan'][]=$row_penyidik; 
	 					endforeach;
	 			}

 


 			endforeach;

	 	}  



	 	// ================= LAKA LANTAS ========================= // 


	 	$this->db->select('a.*')->from("lap_laka_lantas a")
	 	->join("pengguna u",'a.user_id = u.id');

	 	if($jenis == "polsek") {
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polsek",$id_polsek);
	 	}
	 	else if($jenis=="polres"){
	 		$this->db->where("u.jenis",$jenis);
	 		$this->db->where("u.id_polres",$id_polres);
	 	}
	 	else {
	 		$this->db->where("u.jenis","polda");
	 	}


	 	$res = $this->db->get(); 

	 	// echo $this->db->last_query();

	 	// echo "jumlah ". $res->num_rows(); 

	 	if($res->num_rows() > 0 ) {

	 		$res_array['lap_laka_lantas']['index'] = "lap_laka_lantas_id"; 

	 		foreach($res->result_array() as $row) :

	 			//echo show_array($row); 
	 			$res_array['lap_laka_lantas']['data'][] = $row;


	 		 
	 			 
 
 				$this->db->where("lap_laka_lantas_id",$row['lap_laka_lantas_id']); 
	 			$rs_lap_laka_saksi = $this->db->get("lap_laka_saksi");
	 			if($rs_lap_laka_saksi->num_rows() > 0 ) {
	 					foreach($rs_lap_laka_saksi->result_array() as $row_lap_laka_saksi) : 
	 						$res_array['lap_laka_lantas']['child']['lap_laka_saksi'][]=$row_lap_laka_saksi; 
	 					endforeach;
	 			}



	 			$this->db->where("lap_laka_lantas_id",$row['lap_laka_lantas_id']); 
	 			$rs_lap_laka_perkembangan = $this->db->get("lap_laka_perkembangan");
	 			if($rs_lap_laka_perkembangan->num_rows() > 0 ) {
	 					foreach($rs_lap_laka_perkembangan->result_array() as $row_lap_laka_perkembangan) : 
	 					$res_array['lap_laka_lantas']['child']['lap_laka_perkembangan'][]=$row_lap_laka_perkembangan; 
	 					endforeach;
	 			}

	 			$this->db->where("lap_laka_lantas_id",$row['lap_laka_lantas_id']); 
	 			$rs_lap_laka_penyidik = $this->db->get("lap_laka_penyidik");
	 			if($rs_lap_laka_penyidik->num_rows() > 0 ) {
	 					foreach($rs_lap_laka_penyidik->result_array() as $row_lap_laka_penyidik) : 
	 						$res_array['lap_laka_lantas']['child']['lap_laka_penyidik'][]=$row_lap_laka_penyidik; 
	 					endforeach;
	 			}


	 			$this->db->where("lap_laka_lantas_id",$row['lap_laka_lantas_id']); 
	 			$rs_lap_laka_pengemudi = $this->db->get("lap_laka_pengemudi");
	 			if($rs_lap_laka_pengemudi->num_rows() > 0 ) {
	 					foreach($rs_lap_laka_pengemudi->result_array() as $row_lap_laka_pengemudi) : 
	 						$res_array['lap_laka_lantas']['child']['lap_laka_pengemudi'][]=$row_lap_laka_pengemudi; 
	 					endforeach;
	 			}


	 			$this->db->where("lap_laka_lantas_id",$row['lap_laka_lantas_id']); 
	 			$rs_lap_laka_korban = $this->db->get("lap_laka_korban");
	 			if($rs_lap_laka_korban->num_rows() > 0 ) {
	 					foreach($rs_lap_laka_korban->result_array() as $row_lap_laka_korban) : 
	 						$res_array['lap_laka_lantas']['child']['lap_laka_korban'][]=$row_lap_laka_korban; 
	 					endforeach;
	 			}

	 			$this->db->where("lap_laka_lantas_id",$row['lap_laka_lantas_id']); 
	 			$rs_lap_laka_kendaraan = $this->db->get("lap_laka_kendaraan");
	 			if($rs_lap_laka_kendaraan->num_rows() > 0 ) {
	 					foreach($rs_lap_laka_kendaraan->result_array() as $row_lap_laka_kendaraan) : 
	 						$res_array['lap_laka_lantas']['child']['lap_laka_kendaraan'][]=$row_lap_laka_kendaraan; 
	 					

	 						if($row_perkembangan['file_dokumen'] <> '') {
	 							$arr_file[] = $row_perkembangan['file_dokumen']; 
	 						}

	 					endforeach;
	 			}
	 			 
 


 			endforeach;

	 	}  


	 	// show_array($res_array); 

	 	// echo json_encode($res_array); 

	 	//show_array($arr_file);

	 	//echo "path." FCPATH; 


	 	// exit; 


	 	if(!is_dir("./tmp/$dirname")) { 
	 		mkdir("./tmp/$dirname");
	 	}

	 	$this->load->helper('file');

	 	write_file("./tmp/$dirname/jsondata.txt",json_encode($res_array)); 

	 	$this->load->library('zip');

	 	foreach($arr_file as $file) : 
	 		copy("./documents/$file","./tmp/$dirname/$file");
	 	endforeach;

	 	

	 	$zipdir = "tmp/$dirname/"; 
	  
	 	// echo $zipdir;
	 	$this->zip->read_dir($zipdir);

	 	 
	 	$this->zip->archive("tmp/$dirname".".zip");
	  

	 	// $this->load->library('zip');
	 	// $zipdir = "tmp/polsek9c8071debae5c875a49240c8d41fec47"; 
	 	// $this->zip->read_dir($zipdir);

	 	$this->zip->download("$dirname".".zip");





	}


	function contoh(){
		$this->load->library('zip');
	 	$zipdir = "tmp/polsek9c8071debae5c875a49240c8d41fec47/"; 
	 	$this->zip->read_dir($zipdir);

	 	$this->zip->download("firmansya.zip");
	}



	function pushdata(){

		// show_array($_FILES); 
		// show_array($_POST); 
		$server_file_name = $_POST['filename']; 
		$dirname = $_POST['dirname'];

		 

		$uploadfile =  "client_tmp/$server_file_name";

		 

		 

		if(is_uploaded_file($_FILES['file_contents']['tmp_name'])) {

			// copy()

			echo "sumber file ". $_FILES['file_contents']['tmp_name']; 
			echo "<br /> server file name ". $uploadfile; 
			copy( $_FILES['file_contents']['tmp_name'],$uploadfile); 
			 // copy($_FILES['file_contents']['tmp_name'],$server_file_path);


			$zip = new ZipArchive;


			if(!is_dir("./client_tmp/$dirname")) { 
	 		mkdir("./client_tmp/$dirname");
	 		}

			if ($zip->open($uploadfile) === TRUE) {

				$zip->extractTo("client_tmp/$dirname");
				$zip->close();

				$doc_path = "documents/"; 
				$doc_src_path  = "client_tmp/$dirname/temp_upload/uploaddata/";

				 
				copyr($doc_src_path,$doc_path); 

				 
				// recursiveDelete("tmp/*");

				$jsonfile = $doc_src_path."/jsondata.txt"; 

				$result = file_get_contents($jsonfile); 

				$this->dataProcess($result); 

			}



		}

	}



function dataProcess($jsondata) {

	$data = json_decode($jsondata); 
	
	foreach($data as $idx => $val) : 

		 
		
		$tbname = $idx;
		$id =  $val->index;

		//echo $id; 
		 

		foreach($val->data as $isidata ):
			$isidata = (array) $isidata; 
			
			// show_array($isidata);  

			$this->db->where($id, $isidata[$id]); 

			$this->db->delete($tbname); 

			

			$this->db->insert($tbname,$isidata); 
			// echo $this->db->last_query();  


			foreach($val->child as $c_tb_name => $c_tb_data) : 
				 
				$this->db->where($id, $isidata[$id]); 
				$this->db->delete($c_tb_name); 

				foreach($c_tb_data as $c_tb_data_row) : 
					$c_tb_data_row = (array) $c_tb_data_row; 


					if($c_tb_data_row[$id] == $isidata[$id] ) 
					 { 
					 	$this->db->insert($c_tb_name,$c_tb_data_row);
					 }

					//echo $this->db->last_query(); 

				endforeach;

			endforeach;

			 
		endforeach;





		



	endforeach;


}





}

?>