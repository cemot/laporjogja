<h4>LAPORAN KEJAHATAN PERIODE TANGGAL TANGGAL <?php echo $tanggal; ?>  s.d <?php echo $tanggal2; ?></h4>
<hr />

<table class="table table-bordered">
  <thead>
  <tr>
	  <th>Golongan
	  </th>
	  <th>Kelompok 
	  </th>
	  <th>Kejahatan 
	  </th>
	  <th>Jumlah 
	  </th>
    <th>Selesai 
    </th>
  </tr>
  </thead>

  <tbody>
  	
  <?php 
  $tmp_gol = "";
  $tmp_kel = "";
  foreach($rec->result() as $row) : 

  	//$golongan = ($row->golongan <> $golongan) ? $row->golongan : "";
  	//$tmp_gol = $row->golongan; 

  	if($tmp_gol<>$row->golongan) {
  		$golongan = $row->golongan;
  		$tmp_gol = $row->golongan;

  	}
  	else {
  		$golongan = "";
  	}

  	if($tmp_kel<>$row->kelompok) {
  		$kelompok = $row->kelompok;
  		$tmp_kel = $row->kelompok;

  	}
  	else {
  		$kelompok = "";
  	}



  ?>
	<tr>
	<td><?php echo $golongan ?> </td>
	<td><?php echo $kelompok ?> </td>
	<td><?php echo $row->golongan_kejahatan ?> </td>
	<td><?php echo $row->total; ?> </td>
  <td><?php echo $row->selesai; ?> </td>
	</tr>
  <?php endforeach; ?>

  </tbody>


</table>


<table class="table table-bordered">
  <thead>
  <tr>
    <th>Golongan
    </th>
    <th>Kelompok 
    </th>
    <th>Kejahatan 
    </th>     
    <th>MD 
    </th>
    <th>LB 
    </th>
    <th>LR 
    </th>
  </tr>
  </thead>

  <tbody>
    
  <?php 
  $tmp_gol = "";
  $tmp_kel = "";
  foreach($rec_bencana->result() as $row) : 

    //$golongan = ($row->golongan <> $golongan) ? $row->golongan : "";
    //$tmp_gol = $row->golongan; 

    if($tmp_gol<>$row->golongan) {
      $golongan = $row->golongan;
      $tmp_gol = $row->golongan;

    }
    else {
      $golongan = "";
    }

    if($tmp_kel<>$row->kelompok) {
      $kelompok = $row->kelompok;
      $tmp_kel = $row->kelompok;

    }
    else {
      $kelompok = "";
    }



  ?>
  <tr>
  <td><?php echo $golongan ?> </td>
  <td><?php echo $kelompok ?> </td>
  <td><?php echo $row->golongan_kejahatan ?> </td>
  <td><?php echo $row->md; ?> </td>
  <td><?php echo $row->lb; ?> </td>
  <td><?php echo $row->lr; ?> </td>
  </tr>
  <?php endforeach; ?>

  </tbody>


</table>