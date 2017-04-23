<style>
* {
font-size : 9px;
}

.garisbawah {
	border-bottom : #000 solid 2px;
}

</style>
<?php 
$setting = $this->cm->get_setting();
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
    <td width="49%" align="center">KEPOLISIAN NEGARA REPUBLIK INDONESIA<br />
        <?php echo $ttd['nama_polda']. "<br />"; 
	echo $ttd['instansi'].'<br />'; 
	echo $ttd['alamat']; 
	
	?>
        <hr></td>
    <td width="24%">&nbsp;</td>
    <td width="27%">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&quot;PROJUSTITIA&quot;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="3" align="center"><img width="30px" height="30px" src="<?php  echo FCPATH; ?>/assets/images/logo.png>" /></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><b><u>LAPORAN POLISI</u></b> <br />
    NOMOR : <?php echo $nomor; ?></td>
  </tr>
  <tr>
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><hr />
      <u>PERISTIWA YANG DILAPORKAN : </u></td>
  </tr>
  
  <tr>
    <td width="25%">1. Waktu kejadian</td>
    <td width="1%">:</td>
    <td width="74%">Mulai tanggal <?php echo  ucwords(strtolower(tgl_indo(flipdate($kp_tanggal)))); ?></td>
  </tr>
  <tr>
    <td>2. Tempat kejadian</td>
    <td>:</td>
    <td><?php echo $kp_tempat_kejadian; ?></td>
  </tr>
  <tr>
    <td>3. Apa yang terjadi </td>
    <td>:</td>
    <td><?php echo $kp_apa_yang_terjadi; ?></td>
  </tr>
  <tr>
    <td>4. Siapa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Pelaku</td>
    <td>:</td>
    <td><?php 
			$n=0; 
			foreach($tersangka->result() as $row) :  
			$n++;
			?>  
    		<b><?php 
			$break = ($n>1)?"<br />":"";
			echo  $break . $n. ". ". $row->tersangka_nama; ?></b>, 
			<?php echo umur($row->tersangka_tgl_lahir); ?> Th,
			<?php echo ($tersangka_jk=="P")?" PEREMPUAN ":"LAKI - LAKI "; ?>, 
			<?php echo $row->pekerjaan; ?> d/a  
 
    	    <?php echo $row->tersangka_alamat; ?> - <?php echo $row->desa ?> - <?php echo $row->kecamatan; ?> - <?php echo $row->kota; ?> - <?php echo $row->provinsi; ?>
   	     <?php endforeach; ?>    </td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Korban </td>
    <td>: </td>
    <td><?php 
			$n=0;
			foreach($korban->result() as $row) : 
			$break = ($n>1)?"<br />":"";
			$n++;
			//echo $row->korban_nama; 
			echo  $break . '<b> '. $n. ". ". $row->korban_nama." </b> ";
			
			if($row->jenis_korban=="o") { 
			echo ', '.umur($row->korban_tgl_lahir)." Th , ";
			echo ($korban_jk=="P")?" PEREMPUAN, ":"LAKI - LAKI, ";
			echo $row->pekerjaan.' ';
			}
			echo ' , d/a '.$row->korban_alamat.' ';
			if($row->desa<>'') {
				echo "$row->desa - $row->kecamatan - $row->kota -  $row->provinsi ";
			}
			
			
			
			endforeach;
	?> </td>
  </tr>
  <tr>
    <td>5. Bagaimana terjadi </td>
    <td>: </td>
    <td align="justify"><?php echo $kp_bagaimana_terjadi; ?></td>
  </tr>
  <tr>
    <td>6. Dilaporkan pada </td>
    <td>:</td>
    <td><?php echo flipdate($kp_dilaporkan_pada).' '.$kp_jam_dilaporkan; ?> </td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td><U>TIDAK PIDANA APA </U> </td>
    <td>:</td>
    <td align="center"><U>NAMA DAN ALAMAT SAKSI - SAKSI</U></td>
  </tr>
  <tr>
    <td><?php echo $tindak_pidana; ?></td>
    <td>&nbsp;</td>
    <td align="left">

  
    
  
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <?php echo $no; 
  $no = 0;
  foreach($saksi->result() as $row) :  
  $no++; 
  $break = ($n>1)?"<br />":"";
  ?>
    <tr>
      <td width="6%"><?php echo $no ?>. </td>
      <td width="94%"><?php echo $row->saksi_nama; ?>, <?php echo umur($row->saksi_tgl_lahir); ?> Th, <?php echo ($row->saksi_jk=="P")?"Perempuan":"Laki-laki"; ?>,  <?php echo $row->saksi_agama; ?>,<?php echo $row->pekerjaan; ?>, <?php echo $row->saksi_alamat; ?> - <?php echo $row->desa ?> - <?php echo $row->kecamatan; ?> - <?php echo $row->kota; ?> - <?php echo $row->provinsi; ?> </td>
    </tr>
      <?php endforeach; ?>  
  </table></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td width="17%"><U>BARANG BUKTI :</U> </td>
    <td width="2%">&nbsp;</td>
    <td width="81%" align="center"><U>URAIAN SINGKAT KEJADIAN</U></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <?php 
	$no = 0;
  	foreach($barbuk->result() as $row) : 
	$no++;
	?>
      <tr>
        <td width="13%"><?php echo $no; ?>. </td>
        <td width="87%"><?php echo $row->barbuk_nama. " ( $row->barbuk_jumlah $row->barbuk_satuan )"; ?></td>
      </tr>
    <?php 
	endforeach;
	?>
    </table></td>
    <td>&nbsp;</td>
    <td><?php echo $kejadian_uraian; ?></td>
  </tr>
  <tr>
    <td colspan="3"><hr />
    TINDAKAN YANG DIAMBIL : Menerima laporan, Membuat LP, Membuat Surat Tanda Terima Laporan Polisi </td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="0" cellpadding="0">
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">PELAPOR</td>
    <td align="center"><?php echo $ttd['tempat'] ?>, <?php echo tgl_indo(flipdate($tanggal)) ?> </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">Yang Menerima Laporan </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><b>( <?php echo $pelapor_nama; ?> )</b></td>
    <td align="center"><strong><u><?php echo $pen_lapor_nama; ?></u></strong></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center"><strong><?php echo $penerima_pangkat; ?> NRP. 
      <?php  echo $pen_lapor_nrp; ?> 
    </strong></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">Mengetahui <br />
      a.n KEPALA KEPOLISIAN <?php echo $ttd['instansi'];  ?><br />
      <?php echo $mengetahui_jabatan;  ?><br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <b><u><?php echo $mengetahui_nama; ?></u><br />
      <?php echo $mengetahui_pangkat; ?> NRP. <?php echo $mengetahui_nrp; ?></b><br /></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
