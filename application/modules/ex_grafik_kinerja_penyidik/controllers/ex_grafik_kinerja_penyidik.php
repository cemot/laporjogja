<?php
class ex_grafik_kinerja_penyidik extends super_controller  {
	function ex_grafik_kinerja_penyidik(){
		parent::__construct();
		$this->load->model("coremodel","cm");
		 
		$this->load->helper("tanggal");
		$this->controller = get_class($this);
	}
	
	
	function index(){

		$title = "GRAFIK KINERJA PENYIDIK";
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

		$sql = "select *  from (select 
			x.id, x.nama, 
			sum(p21) as p21, 
			sum(sidik) as sidik,
			sum(lidik) as lidik, 
			count(*) as total


			from (select 'a' as tb, 
			p.id ,
			p.nama, 
			lp.lap_a_id  as lap_id , 
			a.penyelesaian , 
			if(a.penyelesaian = 'p21',1,0) as p21, 
			if(a.penyelesaian = 'sidik',1,0) as sidik, 
			if(a.penyelesaian = 'lidik',1,0) as lidik, 
			op.jenis,a.user_id 	 
			from pengguna  p 
			join lap_a_penyidik lp on   lp.id_penyidik = p.id 
			join lap_a a on lp.lap_a_id =  a.lap_a_id 

			join pengguna op on a.user_id = op.id ";

			if($jenis=="polresall") {
			$sql .= " left join m_polsek sek on sek.id_polsek = op.id_polsek ";
			$sql .= " left join m_polres res on res.id_polres = sek.id_polsek ";
			}


			$sql.= " where p.level='2' ";

			if($jenis<>'x') {
				//$sql.= " and u.jenis ='$jenis' "
				if($jenis == "polres") {
					$sql .=" and op.jenis='$jenis' and op.id_polres = '$id_polres' ";
				}
				else if ($jenis=="polsek") {
					$sql .=" and op.jenis='$jenis' and op.id_polsek = '$id_polsek' ";
				}
				else if ($jenis=="polda") {
					$sql .=" and op.jenis='$jenis' ";
				}
				else {
					$sql .= " and op.id_polres = '$id_polres' ";
				}
			}


			$sql .=" union 
			select 'b' as tb,
			p.id ,
			p.nama, 
			lp.lap_b_id  as lap_id  , 
			a.penyelesaian , 
			if(a.penyelesaian = 'p21',1,0) as p21, 
			if(a.penyelesaian = 'sidik',1,0) as sidik, 
			if(a.penyelesaian = 'lidik',1,0) as lidik, 
			op.jenis, a.user_id 
			from pengguna  p 
			join lap_b_penyidik lp on   lp.id_penyidik = p.id 
			join lap_b a on lp.lap_b_id =  a.lap_b_id 

			join pengguna op on a.user_id = op.id ";

			if($jenis=="polresall") {
			$sql .= " left join m_polsek sek on sek.id_polsek = op.id_polsek ";
			$sql .= " left join m_polres res on res.id_polres = sek.id_polsek ";
			}

			$sql .= "where p.level='2' ";

			if($jenis<>'x') {
				if($jenis == "polres") {
					$sql .=" and op.jenis='$jenis' and op.id_polres = '$id_polres' ";
				}
				else if ($jenis=="polsek") {
					$sql .=" and op.jenis='$jenis' and op.id_polsek = '$id_polsek' ";
				}
				else if ($jenis=="polda") {
					$sql .=" and op.jenis='$jenis' ";
				}
				else {
					$sql .= " and op.id_polres = '$id_polres' ";
				}
			}


			$sql .= " ) x group by x.id) y 

			 order by y.p21 desc limit 10";




 
 
		$res = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$arr = array();

		$n=1;
		foreach($res->result() as $row ) : 
			 
			 $arr['P21'][$n]=$row->p21; 
			 $arr['Penyelidikan'][$n]=$row->sidik; 
			 $arr['Penyidikan'][$n]=$row->lidik; 
			 $arr['Total'][$n]= $row->p21+$row->sidik + $row->lidik; 

		$n++;	  
		endforeach;



		$data['data'] = $res;
		$data['arr'] = $arr;
		// show_array($data['arr']); exit;
		 
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