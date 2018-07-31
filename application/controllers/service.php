<?php 
class service extends CI_Controller {

	var $service_url;
	function __construct(){
		parent::__construct();

	 
		$this->service_url = $this->config->item('bpkb_service_url');

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

		// $req_url = "http://180.246.178.136:5000/api.bpkb/index.php/services/get_data_kendaraan";

		$url = $this->service_url."/get_data_kendaraan";

		$ch = curl_init();

		$req_array = array("key"=>"12345",
							"nopol"=>$nopol);
		$json_data = json_encode($req_array);

		// echo $json_data;
		 
		curl_setopt($ch,CURLOPT_URL, $url);
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

function upload_blokir() {
	$post = $this->input->post();

	// show_array($post); show_array($_FILES); exit;

	$config['upload_path']          = './berkas_blokir/';
    $config['allowed_types']        = 'gif|jpg|png|pdf|docx';
    $this->load->library('upload', $config);

     if ( ! $this->upload->do_upload('file'))
    {
            $error = array('error' => $this->upload->display_errors());
            // show_array($error); 

          	$ret = array("error"=>true,"message"=>$error);
           
    }
    else
    {
            $uploaddata = array('upload_data' => $this->upload->data());

	        // show_array($uploaddata); 
            $data['no_lp'] = $post['no_lp'];
		    $data['file']  = $uploaddata['upload_data']['file_name'];
			$res = $this->db->insert("t_berkas",$data);

			if($res) {
				$ret = array("error"=>false,"message"=>"Data berhasil diupload");
			}
			else {
				$ret = array("error"=>true,"message"=>mysql_error());
			}
    }

    echo json_encode($ret);
   


}

function testupload(){
	$this->load->view("uploadberkas");
}

}

?>