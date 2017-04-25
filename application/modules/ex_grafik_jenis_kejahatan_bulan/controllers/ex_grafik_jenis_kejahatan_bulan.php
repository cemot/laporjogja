<?php
class ex_grafik_jenis_kejahatan_bulan extends super_controller  {
	function ex_grafik_jenis_kejahatan_bulan(){
		parent::__construct();
		$this->load->model("coremodel","cm");
		 
		$this->load->helper("tanggal");
		$this->controller = get_class($this);
	}
	
	
	function index(){

		$title = "GRAFIK DATA JENIS KEJAHATAN KEJAHATAN	PER BULAN ";
		$data_array['controller'] = $controller;
		$content = $this->load->view($this->controller."_view",$data_array,true);
		// echo $table;
		// exit;
		$this->set_subtitle($title);
		$this->set_title($title);
		$this->set_content($content);
		$this->render();
	}

	 

	function get_grafik() {
		$post = $this->input->post();

		$data = $post;
		extract($post);
		$sql="select 
			mk.id_kelompok, 
			mk.kelompok, 
			sum(if(month(x.tanggal)=1,1,0)) jan,
			sum(if(month(x.tanggal)=2,1,0)) feb,
			sum(if(month(x.tanggal)=3,1,0)) mar,
			sum(if(month(x.tanggal)=4,1,0)) apr,
			sum(if(month(x.tanggal)=5,1,0)) mei,
			sum(if(month(x.tanggal)=6,1,0)) jun,
			sum(if(month(x.tanggal)=7,1,0)) jul,
			sum(if(month(x.tanggal)=8,1,0)) agu,
			sum(if(month(x.tanggal)=9,1,0)) sep,
			sum(if(month(x.tanggal)=10,1,0)) okt,
			sum(if(month(x.tanggal)=11,1,0)) nov,
			sum(if(month(x.tanggal)=12,1,0)) des

		from 
			m_kelompok_kejahatan mk 
			left join m_golongan_kejahatan a on mk.id_kelompok = a.id_kelompok 
			join (
				select 
					'a' as tb, 
					lap_a_id, 
					kp_tanggal as tanggal, 
					id_gol_kejahatan, 
					user_id 
				from 
					lap_a 
				union 
				select 
					'b' as tb, 
					lap_b_id, 
					kejadian_tanggal as tanggal, 
					id_gol_kejahatan, 
					user_id 
				from 
					lap_b
			) x on a.id = x.id_gol_kejahatan 
			join pengguna u on u.id = x.user_id 

		";

		if($jenis=="polresall") {
			$sql .= " left join m_polsek sek on sek.id_polsek = u.id_polsek ";
			$sql .= " left join m_polres res on res.id_polres = sek.id_polsek ";
		}


		$sql .= " where 

		mk.id_kelompok = '$id_kelompok' 
		and year(tanggal) = '$tahun' ";


		if($jenis<>'x') {
			//$sql.= " and u.jenis ='$jenis' "
			if($jenis == "polres") {
				$sql .=" and u.jenis='$jenis' and u.id_polres = '$id_polres' ";
			}
			else if ($jenis=="polsek") {
				$sql .=" and u.jenis='$jenis' and u.id_polsek = '$id_polsek' ";
			}
			else if ($jenis=="polda") {
				$sql .=" and u.jenis='$jenis' ";
			}
			else {
				$sql .= " and u.id_polres = '$id_polres' ";
			}
		}

		 

		$sql .= " group by mk.id_kelompok ";

		// echo $sql; 
		// exit; 

		$res = $this->db->query($sql);
		// echo " sql ". $this->db->last_query(); exit;

		$data['data'] = $res->row();
		// show_array($data['data']); exit;
		 
		$this->load->view($this->controller."_view_graph",$data);

	}

function get_polsek(){
    $data = $this->input->post();

    
    $id_polres = $data['id_polres'];

    $this->db->where("id_polres",$id_polres);
    $this->db->order_by("nama_polsek");
    $rs = $this->db->get("m_polsek");
    echo "<option value=''>- Semua Polsek -</option>";
    foreach($rs->result() as $row ) :
        echo "<option value=$row->id_polsek>$row->nama_polsek </option>";
    endforeach;


}
}
?>