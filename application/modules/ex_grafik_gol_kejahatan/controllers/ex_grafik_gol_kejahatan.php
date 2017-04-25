<?php
class ex_grafik_gol_kejahatan extends super_controller  {
	function ex_grafik_gol_kejahatan(){
		parent::__construct();
		$this->load->model("coremodel","cm");
		 
		$this->load->helper("tanggal");
		$this->controller = get_class($this);
	}
	
	
	function index(){

		$title = "GRAFIK DATA GOLONGAN KEJAHATAN	";
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
		$sql="select mk.id_kelompok, mk.kelompok,count(x.id_gol_kejahatan) as jumlah  from 
		m_kelompok_kejahatan mk 
		left join 
		m_golongan_kejahatan a on mk.id_kelompok = a.id_kelompok
		join ( 
		select 'a' as tb, lap_a_id, kp_tanggal as tanggal , id_gol_kejahatan, user_id  from lap_a
		union 
		select 'b' as tb, lap_b_id, kejadian_tanggal as tanggal , id_gol_kejahatan, user_id  from lap_b ) x
		on a.id = x.id_gol_kejahatan 
		join pengguna u on u.id = x.user_id 

		";

		if($jenis=="polresall") {
			$sql .= " left join m_polsek sek on sek.id_polsek = u.id_polsek ";
			$sql .= " left join m_polres res on res.id_polres = sek.id_polsek ";
		}


		$sql .= " where year(tanggal) = '$tahun' 
			and mk.id_kelompok in (1,2,3,4,5)
		";


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

		if($bulan <> 'x') {
		$sql .=" and month(tanggal) = '$bulan' ";
		}

		$sql .= " group by mk.id_kelompok
		order by count(x.id_gol_kejahatan) desc";

		// echo $sql; exit; 

		$res = $this->db->query($sql);

		// foreach($res->result() as $row) : 
		// 	endforeach;

		$data['data'] = $res;
		$data['title'] = "GRAFIK GOLONGAN KEJAHATAN ";

		 
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