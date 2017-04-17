<html>
<head>
<style>
* {
	font-size:9px;
}

.tabel td, .tabel th {
	border:#000000 2px solid;
}

</style>
</head>
<body>
<p align="center"><h3>LAPORAN MINGGUAN GANGGUAN KAMTIBMAS (LMGK) </h3>
<H4> TANGGAL : <?php echo $tanggal  ?> s.d.  <?php echo $tanggal2  ?> </H4>
</p>


<?php 
foreach($rec_golongan->result() as $row) : 
 

 
echo "<b>".$row->golongan . "</b><br />";
$rc_kel = $this->lm->get_data_kelompok($row->id); 
	$kel_count = 0; 
  foreach($rc_kel->result() as $row_kel) : 
  	$kel_count++;
	echo "<br /> <br /><b>". $kel_count.". &nbsp; &nbsp; ".$row_kel->kelompok."</b><br />";
		?>
  
  		
        <table   width="100%" cellpadding="3" class="tabel">
        <tr>
        	<th width="13%" align="center"><b> NOMOR </b> </th>
            <th  width="67%" align="center"><b> <?php echo $row_kel->kelompok ?></b></th>
          <th  width="9%" align="center"><B>LAPOR</B></th>
            <th  width="11%" align="center"><b> SELESAI</b></th>
        </tr>
         <tr>
        	<th align="center"> <b> 1</b> </th><th align="center"><b> 2</b></th>
        	<th align="center"><b>3</b></th>
        	<th align="center"><b> 4</b></th>
        </tr>
        <?php 

			$rec_gol = $this->lm->get_data_gol_kejahatan($row_kel->id_kelompok,flipdate($tanggal),flipdate($tanggal2));
			foreach($rec_gol->result() as $row_gol) : 
			//$jumlah = $this->lm->get_jumlah_kejahatan($tanggal, $row_gol->id);
		?>
        <tr><td></td><td><?php echo $row_gol->golongan_kejahatan; ?></td>
          <td align="center"><?php echo $row_gol->total ?></td>
          <td align="center"> <?php echo $row_gol->selesai; ?> </td></tr>
        <?php endforeach; ?>
        </table>
<br /><br />
  		
  <?php
  endforeach;
  echo "<br />";

endforeach; ?>


<?php 
foreach($rec_golongan2->result() as $row) : 
 

 
echo "<b>".$row->golongan . "</b><br />";
$rc_kel = $this->lm->get_data_kelompok($row->id); 
	$kel_count = 0; 
  foreach($rc_kel->result() as $row_kel) : 
  	$kel_count++;
	echo "<br /> <br /><b>". $kel_count.". &nbsp; &nbsp; ".$row_kel->kelompok."</b><br />";
		?>
  
  		
        <table   width="100%" cellpadding="3" class="tabel">
        <tr>
        	<th width="10%" rowspan="2" align="center"><b> NOMOR </b> </th>
            <th  width="45%" rowspan="2" align="center"><b> <?php echo $row_kel->kelompok ?></b></th>
            <th  width="11%" rowspan="2" align="center"><strong>KEJADIAN</strong></th>
          <th  width="12%" rowspan="2" align="center"><B>KERUGIAN</B></th>
            <th colspan="3" align="center" width="21%"><strong>KORBAN</strong></th>
          </tr>
         <tr>
           <th width="7%" align="center"><strong>MD</strong></th>
           <th width="7%" align="center"><strong>LB</strong></th>
           <th width="7%" align="center"><strong>LR</strong></th>
          </tr>
         <tr>
        	<th align="center"> <b> 1</b> </th><th align="center"><strong> 2</strong></th>
        	<th align="center"><strong>3</strong></th>
        	<th align="center"><b>4</b></th>
        	<th align="center"><strong>5</strong></th>
        	<th align="center"><strong>6</strong></th>
        	<th align="center"><strong>7</strong></th>
       	  </tr>
        <?php 

			$rec_gol = $this->lm->get_data_gol_kejahatan2($row_kel->id_kelompok,flipdate($tanggal),flipdate($tanggal2));
			foreach($rec_gol->result() as $row_gol) : 
			//$jumlah = $this->lm->get_jumlah_kejahatan($tanggal, $row_gol->id);
		?>
        <tr><td></td><td><?php echo $row_gol->golongan_kejahatan; ?></td>
          <td align="center"><?php echo $row_gol->kejadian; ?></td>
          <td align="center"><?php echo $row_gol->kerugian; ?></td>
          <td align="center"><?php echo $row_gol->md; ?></td>
          <td align="center"><?php echo $row_gol->lb; ?></td>
          <td align="center"><?php echo $row_gol->lr; ?></td>
          </tr>
        <?php endforeach; ?>
        </table>
<br /><br />
  		
  <?php
  endforeach;
  echo "<br />";

endforeach; ?>
</body>
</html>