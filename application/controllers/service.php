<?php 
class service extends CI_Controller {
	function __construct(){
		parent::__construct();
	} 


	function get_user_info(){
		$post = $this->input->post();

		$sql="select * from pengguna left join m_pangkat on m_pangkat.id_pangkat = pengguna.id_pangkat left join m_polres on m_polres.id_polres = pengguna.id_polres left join m_kesatuan on m_kesatuan.id_kesatuan = pengguna.id_kesatuan "; 
		$sql.=" where user_id = '".$post['user_id']."'";

		$res  = $this->db->query($sql);

		$data = $res->row_array();
		echo json_encode($data);

	}



	function get_data_kendaraan($nopol){

		$nopol = str_replace("%20"," ",$nopol);

		$req_url = "http://180.246.178.136:5000/api.bpkb/index.php/services/get_data_kendaraan";

		$ch = curl_init();

		$req_array = array("key"=>"12345",
							"nopol"=>$nopol);
		$json_data = json_encode($req_array);

		// echo $json_data;
		 
		curl_setopt($ch,CURLOPT_URL, $req_url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $json_data);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		$info = curl_getinfo($ch);

		 // show_array($info);


		//execute post
		$result = curl_exec($ch);
		// echo $result;  

		$obj  = json_decode($result);
		$array = (array) $obj;

		$info = curl_getinfo($ch);

		$error = ($info['http_code']=="200")?false:true;
		// show_array($array); exit;
		curl_close($ch);
		// show_array($array); 
		echo json_encode($array);
		// exit;
		// return array("data"=>$array,"error"=>$error);

	}
}

?>