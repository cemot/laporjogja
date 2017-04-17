<?php
class laporan_mingguan extends admin_controller  {
	function laporan_mingguan(){
		parent::__construct();
		$this->load->helper("tanggal");
		$this->load->model("laporan_minggu_model","lm");


		$this->controller = get_class($this);
	}
	
	
	function index(){
		$data_array = array();
		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("LAPORAN MINGGUAN GANGGUAN KAMTIBMAS (LMGK)");
		$this->set_title("LAPORAN MINGGUAN GANGGUAN KAMTIBMAS (LMGK)");
		$this->set_content($content);
		$this->render_admin();
	}


	function pdf() {
		$post = $this->input->get();
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('LAPORAN');
		//$pdf->SetHeaderMargin(30);
		//$pdf->SetTopMargin(10);

		
		$pdf->SetMargins(20, 10, 10);
		$pdf->SetHeaderMargin(15);
		$pdf->SetFooterMargin(15);
		$pdf->setFooterFont(Array('times', '', 8));

 		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetAuthor('polda JOGJA');
		 
			
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

	 	// show_array($data); exit;
		 
		$pdf->AddPage('P');
		//$data = array();
		$data['tanggal'] = $post['tanggal'];
		$data['tanggal2'] = $post['tanggal2'];


		$data['rec_golongan'] = $this->lm->get_data_mingguan();

		$data['rec_golongan2'] = $this->lm->get_data_mingguan2();
		//$data['rec_golongan_4'] = $this->lm->get_data_mingguan4();
		$html = $this->load->view("pdf/laporan_mingguan_pdf_view",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('LHGK.pdf', 'I');

	}


function get_laporan(){
	$post = $this->input->post();
	$tanggal = flipdate($post['tanggal']);
	$tanggal2 = flipdate($post['tanggal2']);
	$data['tanggal'] = $post['tanggal'];
	$data['tanggal2'] = $post['tanggal2'];
	$data['rec']  = $this->lm->get_data_laporan($tanggal,$tanggal2);
	$data['rec_bencana']  = $this->lm->get_data_laporan_bencana($tanggal,$tanggal2);
	$this->load->view("laporan_mingguan_result_view",$data);
}
 
}
?>