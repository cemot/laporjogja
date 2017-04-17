<?php
class laporan_bulanan extends admin_controller  {
	function laporan_bulanan(){
		parent::__construct();
		$this->load->helper("tanggal");
		$this->load->model("laporan_bulan_model","lm");
		$this->load->model("coremodel","cm");


		$this->controller = get_class($this);
	}
	
	
	function index(){
		$data_array = array();
		$content = $this->load->view($this->controller."_view",$data_array,true);

		$this->set_subtitle("LAPORAN BULANAN GANGGUAN KAMTIBMAS");
		$this->set_title("LAPORAN BULANAN GANGGUAN KAMTIBMAS");
		$this->set_content($content);
		$this->render_admin();
	}


	function pdf() {
		$post = $this->input->get();
		$dp = $this->db->get("m_setting_polda")->row();
		//$dp = $res->row();
		$data['nama_polda'] = $dp->nama_polda;

		if($post['jenis']=="polres") {
			$this->db->where("id_polres",$post['id_polres']);
			$ds = $this->db->get("m_polres")->row();
			$this->db->last_query();
			$data['nama_polres'] = $ds->nama_polres;
		}
		else {
			$data['nama_polres'] = '';
		}

		//show_array($data); exit;
		
		// show_array($post);
		$this->load->library('Pdf');
		$pdf = new Pdf('L', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('LAPORAN');
		//$pdf->SetHeaderMargin(30);
		//$pdf->SetTopMargin(10);

		
		$pdf->SetMargins(10, 10, 10);
		$pdf->SetHeaderMargin(15);
		$pdf->SetFooterMargin(15);
		$pdf->setFooterFont(Array('times', '', 8));

 		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetAuthor('polda JOGJA');
		 
			
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

	 	// show_array($data); exit;
		 
		$pdf->AddPage('L');
		//$data = array();
		$data['bulan'] = $post['bulan'];
		$arr_bulan = $this->cm->arr_bulan;
		// show_array($arr_bulan);
		$data['nama_bulan'] =$arr_bulan[$data['bulan']];
		$data['tahun'] = $post['tahun'];
		$data['jenis'] = $post['jenis'];
		$data['id_polres'] = $post['id_polres'];

		$data['arr_sebelum'] = 
						$this->lm->get_jml_sebelum($post['bulan'],
							$post['tahun'],
							$post['jenis'],
							$post['id_polres']
							);

		//show_array($data['arr_sebelum']);
		 

		$data['rec_golongan'] = $this->lm->get_data_mingguan();
		// $data['rec_golongan'] = $this->lm->get_data_mingguan();

		// $data['rec_golongan2'] = $this->lm->get_data_mingguan2();
		//$data['rec_golongan_4'] = $this->lm->get_data_mingguan4();
		$html = $this->load->view("pdf/laporan_bulanan_pdf_view",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('format_gk_bulanan.pdf', 'I');

	}


function get_laporan(){
	$data = $this->input->post();


	$dp = $this->db->get("m_setting_polda")->row();
		//$dp = $res->row();
		$data['nama_polda'] = $dp->nama_polda;

		if($data['jenis']=="polres") {
			$this->db->where("id_polres",$data['id_polres']);
			$ds = $this->db->get("m_polres")->row();
			$this->db->last_query();
			$data['nama_polres'] = $ds->nama_polres;
		}
		else {
			$data['nama_polres'] = '';
		}


	// show_array($data);
		$data['rec_kejahatan'] = $this->lm->get_data_gol_kejahatan2(
		$data['bulan'],
		$data['tahun'],
		$data['jenis'],
		$data['id_polres']);

	$data['arr_sebelum'] = 
						$this->lm->get_jml_sebelum($post['bulan'],
							$post['tahun'],
							$post['jenis'],
							$post['id_polres']
							);


	$this->load->view("laporan_bulanan_result_view",$data);
}
 
}
?>