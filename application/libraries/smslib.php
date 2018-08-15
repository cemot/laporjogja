<?php 
class smslib extends CI_Controller {

	var $userkey = '113214144';
	var $passkey = 'xxxxxxx';


	function __construct() {
		parent::__construct();
	}


	function send($tujuan,$pesan=""){


		$url ="https://reguler.zenziva.net/apps/smsapi.php";


		$url .="?userkey=$this->userkey&passkey=$this->passkey&nohp=$tujuan&pesan=$pesan";

		echo "Url ".$url; exit;

		$exec = file_get_contents($url);


	}


}


?>