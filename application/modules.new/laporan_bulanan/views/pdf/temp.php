
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
