<html>
<head>
<style>
* {
	font-size:8px;
}

.tabel td, .tabel th {
	border:#000000 2px solid;
}

</style>
</head>
<body>
<p align="center"><h3>LAPORAN BULANAN GANGGUAN <br /> KAMTIBMAS ( FORMAT GK)</h3> </p>
 
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="16%" align="left"><strong>MABES POLRI</strong></td>
    <td width="25%"><strong>: REPUBLIK INDONESIA</strong></td>
    <td width="11%"><strong>BULAN</strong></td>
    <td width="28%"><strong>: <?php echo $nama_bulan. " " . $tahun; ?></strong></td>
    <td width="20%"></td>
  </tr>
  <tr>
    <td align="left"><strong>POLDA</strong></td>
    <td><strong>: <?php echo $nama_polda; ?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><strong>POLWIL / WIL TABES </strong></td>
    <td><strong>: </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><strong>POLRES / RESTA / TABES </strong></td>
    <td><strong>: <?php echo $nama_polres; ?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<p></p>

  <?php 
  
 // show_array($arr_sebelum); echo "<hr />";
 $n=0; 
foreach($rec_golongan->result() as $row) : 
 $n++;

//if($n>1) continue;
 
echo "<b>".$row->golongan . "</b><br />";
$rc_kel = $this->lm->get_data_kelompok($row->id); 
	$kel_count = 0; 
  foreach($rc_kel->result() as $row_kel) : 
  	$kel_count++;
	//if($kel_count>1) continue;
	echo "<br /> <br /><b>". $kel_count.". &nbsp; &nbsp; ".$row_kel->kelompok."</b><br />";
		?>
 
  <table width="100%" border="1" cellspacing="0" cellpadding="2">
    <tr>
      <td width="4%" rowspan="3" align="center"><br>
        <br>
        <br>
      No. </td>
      <td width="19%" rowspan="3" align="center"><br>
        <br>
        <br>
      JENIS KEJAHATAN </td>
      <td width="15%" colspan="3" align="center">LAPOR</td>
      <td colspan="9" align="center" width="45%">PENYELESAIAN</td>
      <td width="10%" colspan="2" align="center">SISA</td>
      <td width="5%" rowspan="3" align="center"><br>
        <br>
        <br>
        <br>
      JML</td>
    </tr>
    <tr>
      <td width="5%" rowspan="2" align="center">JML. PERKARA BLN INI</td>
      <td width="5%" rowspan="2" align="center">TUNG<br>
      GAKAN</td>
      <td width="5%" rowspan="2" align="center">JML</td>
      <td width="5%" rowspan="2" align="center">P21</td>
      <td  width="35%" colspan="7" align="center">PENYIDIKAN DIHENTIKAN</td>
      <td width="5%" rowspan="2" align="center">JML</td>
      <td width="5%" rowspan="2" align="center">DLM<br>
        PROSES<br>
        LIDIK</td>
      <td width="5%" rowspan="2" align="center">DLM<br>
        PROSES<br>
        SIDIK</td>
    </tr>
    <tr>
      <td width="5%" align="center">TDK<br>
        CKP<br>
        BKTI</td>
      <td width="5%" align="center">BKN<br>
        PKR<br>
        PIDANA</td>
      <td width="5%" align="center">ADUAN<br>
      DICABUT</td>
      <td width="5%" align="center">NEBIS<br>
        ID<br>
        IDEM</td>
      <td width="5%" align="center">TSK<br>
      MATI</td>
      <td width="5%" align="center">TSK<br>
      GILA</td>
      <td width="5%" align="center">KADA<br>
        LUARSA</td>
    </tr>
   
    <tr>
      <td align="center"><strong>1</strong></td>
      <td align="center"><strong>2</strong></td>
      <td width="5%" align="center"><strong>3</strong></td>
      <td width="5%" align="center"><strong>4</strong></td>
      <td width="5%" align="center"><strong>5</strong></td>
      <td width="5%" align="center"><strong>6</strong></td>
      <td width="5%" align="center"><strong>7</strong></td>
      <td width="5%" align="center"><strong>8</strong></td>
      <td width="5%" align="center"><strong>9</strong></td>
      <td width="5%" align="center"><strong>10</strong></td>
      <td width="5%" align="center"><strong>11</strong></td>
      <td width="5%" align="center"><strong>12</strong></td>
      <td width="5%" align="center"><strong>13</strong></td>
      <td width="5%" align="center"><strong>14</strong></td>
      <td width="5%" align="center"><strong>15</strong></td>
      <td width="5%" align="center"><strong>16</strong></td>
      <td width="5%" align="center"><strong>17</strong></td>
    </tr>
     <?php  
	 $xx=0;
	 $rec_kejahatan = $this->lm->get_data_gol_kejahatan($row_kel->id_kelompok,$bulan,$tahun,$jenis,$id_polres);
	 foreach($rec_kejahatan->result() as $rw) : 
	 $xx++;
	 
	 $tunggakan = $arr_sebelum[$rw->id];
	 $jumlah_semua =  $tunggakan + $rw->jumlah; 
	 
	?>
    <tr>
      <td align="center"><?php echo $xx;   ?></td>
      <td><?php echo $rw->golongan_kejahatan;  ?></td>
      <td align="center"><?php echo $rw->jumlah; ?></td>
      <td align="center"><?php echo $tunggakan; ?></td>
      <td align="center"><?php echo $jumlah_semua; ?></td>
      <td align="center"><?php echo $rw->p21; ?></td>
      <td align="center"><?php echo $rw->tcb; ?></td>
      <td align="center"><?php echo $rw->bpp; ?></td>
      <td align="center"><?php echo $rw->adc; ?></td>
      <td align="center"><?php echo $rw->nii; ?></td>
      <td align="center"><?php echo $rw->tm; ?></td>
      <td align="center"><?php echo $rw->tg; ?></td>
      <td align="center"><?php echo $rw->exp; ?></td>
      <td align="center"><?php echo $rw->jml_selesai; ?></td>
      <td align="center"><?php echo $rw->lidik; ?></td>
      <td align="center"><?php echo $rw->sidik; ?></td>
      <td align="center"><?php echo $rw->lidiksidik; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
 
<?php
  endforeach;
  echo "<br />";

endforeach; ?>
  
  
  
</p>
</body>
</html>