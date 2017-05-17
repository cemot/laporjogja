<div class="row">
<div class="col-md-6">
<h3>JUMLAH KASUS <?php echo number_format($kasus_jumlah,0); ?> </h3>

<b> Data berdasarkan golongan kejahatan </b>
<table class="table" width="100%">
<tr>
<th>Golongan Kejahatan </th>
<th> Jumlah </th>
</tr>

<?php 
foreach($kasus_record->result() as $row) :  
// show_array($row);
 
    ?>
<tr>
<td><?php echo $row->golongan_kejahatan; ?></td>
<td><?php echo $row->jumlah; ?></td>
</tr>

<?php endforeach; ?>
</table>
</div>


<div class="col-md-6">
<div class="row">
 <div class="col-md-7">
 <h3>JUMLAH KASUS <?php echo number_format($kasus_jumlah2,0); ?> </h3>

 </div>

 <div class="col-md-5">
 <div class="alert alert-info" role="alert">
 <?php 
 	$selisih = $kasus_jumlah2 - $kasus_jumlah; 

 	if($kasus_jumlah2 > $kasus_jumlah )
 	{
 		$beda = $kasus_jumlah2 - $kasus_jumlah;
 		$beda = abs($beda);
 		$persen = ($beda / $kasus_jumlah2) * 100;
 		// echo "nomor 2<br />";
 	}
 	else {
 		// echo "nomor 1<br />";
 		$beda = $kasus_jumlah - $kasus_jumlah2;
 		$beda = abs($beda);
 		// echo "beda berapa $beda ";
 		$persen = ($beda / $kasus_jumlah) * 100;
 		// echo " $persen ($beda / $kasus_jumlah) * 100 ";
 	}

 	//echo "<br /> atau $persentase". number_format($persentase,2,0);

 	$tanda = ($selisih > 0 ) ? "+":"-";
 	$persen = number_format($persen,2);
 	
 	echo $tanda.$beda. "<br >";
 	echo $tanda. $persen. " %<br >";

 ?>
 </div>
 </div>
</div>

<b> Data berdasarkan golongan kejahatan </b>
<table class="table" width="100%">
<tr>
<th>Golongan Kejahatan </th>
<th> Jumlah </th>
</tr>

<?php 
foreach($kasus_record2->result() as $row) :  
// show_array($row);
 
    ?>
<tr>
<td><?php echo $row->golongan_kejahatan; ?></td>
<td><?php echo $row->jumlah; ?></td>
</tr>

<?php endforeach; ?>
</table>
</div>

</div> <!-- row -->
<hr />



<br />


<div class="row">
<div class="col-md-6">

<b> Data berdasarkan lokasi kejahatan </b>
<hr />
<table class="table" width="100%">
<tr>
<th>Lokasi Kejahatan </th>
<th> Jumlah </th>
</tr>

<?php 
foreach($lokasi_record->result() as $row) :  
// show_array($row);
 
    ?>
<tr>
<td><?php echo $row->jenis_lokasi; ?></td>
<td><?php echo $row->jumlah; ?></td>
</tr>

<?php endforeach; ?>
</table>
</div>


<div class="col-md-6">

<b> Data berdasarkan lokasi kejahatan </b>
<hr />
<table class="table" width="100%">
<tr>
<th>Lokasi Kejahatan </th>
<th> Jumlah </th>
</tr>

<?php 
foreach($lokasi_record2->result() as $row) :  
// show_array($row);
 
    ?>
<tr>
<td><?php echo $row->jenis_lokasi; ?></td>
<td><?php echo $row->jumlah; ?></td>
</tr>

<?php endforeach; ?>
</table>
</div>

</div> <!-- row -->
<hr />


<div class="row">
<div class="col-md-6">


<b> DATA BERDASARKAN HARI KEJADIAN </b>
<hr />
<table class="table" width="100%">
<tr>
<th>HARI</th>
<th> JUMLAH </th>
</tr>

 
<tr>
<td>SENIN </td>
<td><?php echo $hari_record->senin; ?></td>
</tr>

<tr>
<td>SELASA </td>
<td><?php echo $hari_record->selasa; ?></td>
</tr>

<tr>
<td>RABU </td>
<td><?php echo $hari_record->rabu; ?></td>
</tr>

<tr>
<td>KAMIS </td>
<td><?php echo $hari_record->kamis; ?></td>
</tr>

<tr>
<td>JUMAT </td>
<td><?php echo $hari_record->jumat; ?></td>
</tr>

<tr>
<td>SABTU </td>
<td><?php echo $hari_record->sabtu; ?></td>
</tr>

<tr>
<td>MINGGU </td>
<td><?php echo $hari_record->minggu; ?></td>
</tr>


 
</table>

</div>

<div class="col-md-6">


<b> DATA BERDASARKAN HARI KEJADIAN </b>
<hr />
<table class="table" width="100%">
<tr>
<th>HARI</th>
<th> JUMLAH </th>
</tr>

 
<tr>
<td>SENIN </td>
<td><?php echo $hari_record2->senin; ?></td>
</tr>

<tr>
<td>SELASA </td>
<td><?php echo $hari_record2->selasa; ?></td>
</tr>

<tr>
<td>RABU </td>
<td><?php echo $hari_record2->rabu; ?></td>
</tr>

<tr>
<td>KAMIS </td>
<td><?php echo $hari_record2->kamis; ?></td>
</tr>

<tr>
<td>JUMAT </td>
<td><?php echo $hari_record2->jumat; ?></td>
</tr>

<tr>
<td>SABTU </td>
<td><?php echo $hari_record2->sabtu; ?></td>
</tr>

<tr>
<td>MINGGU </td>
<td><?php echo $hari_record2->minggu; ?></td>
</tr>


 
</table>

</div>

</div> <!-- row -->
<hr />



<div class="row">
<div class="col-md-6">


<b> DATA BERDASARKAN JAM KEJADIAN </b>
<hr />
<table class="table" width="100%">
<tr>
<th>JAM</th>
<th> JUMLAH </th>
</tr>

 
<tr>
<td>00.00 s/d  02.00 </td>
<td><?php echo $jam_record->a; ?></td>
</tr>

<tr>
<td>02.00 s/d  04.00 </td>
<td><?php echo $jam_record->b; ?></td>
</tr>

<tr>
<td>04.00 s/d  06.00 </td>
<td><?php echo $jam_record->c; ?></td>
</tr>

<tr>
<td>06.00 s/d  08.00 </td>
<td><?php echo $jam_record->d; ?></td>
</tr>

<tr>
<td>08.00 s/d  10.00 </td>
<td><?php echo $jam_record->e; ?></td>
</tr>

<tr>
<td>10.00 s/d  12.00 </td>
<td><?php echo $jam_record->f; ?></td>
</tr>

<tr>
<td>12.00 s/d  14.00 </td>
<td><?php echo $jam_record->g; ?></td>
</tr>

<tr>
<td>14.00 s/d  16.00 </td>
<td><?php echo $jam_record->h; ?></td>
</tr>

<tr>
<td>16.00 s/d  18.00 </td>
<td><?php echo $jam_record->i; ?></td>
</tr>

<tr>
<td>18.00 s/d  20.00 </td>
<td><?php echo $jam_record->j; ?></td>
</tr>

<tr>
<td>20.00 s/d  22.00 </td>
<td><?php echo $jam_record->k; ?></td>
</tr>

<tr>
<td>22.00 s/d  24.00 </td>
<td><?php echo $jam_record->l; ?></td>
</tr>
 
</table>

</div>


<div class="col-md-6">


<b> DATA BERDASARKAN JAM KEJADIAN </b>
<hr />
<table class="table" width="100%">
<tr>
<th>JAM</th>
<th> JUMLAH </th>
</tr>

 
<tr>
<td>00.00 s/d  02.00 </td>
<td><?php echo $jam_record2->a; ?></td>
</tr>

<tr>
<td>02.00 s/d  04.00 </td>
<td><?php echo $jam_record2->b; ?></td>
</tr>

<tr>
<td>04.00 s/d  06.00 </td>
<td><?php echo $jam_record2->c; ?></td>
</tr>

<tr>
<td>06.00 s/d  08.00 </td>
<td><?php echo $jam_record2->d; ?></td>
</tr>

<tr>
<td>08.00 s/d  10.00 </td>
<td><?php echo $jam_record2->e; ?></td>
</tr>

<tr>
<td>10.00 s/d  12.00 </td>
<td><?php echo $jam_record2->f; ?></td>
</tr>

<tr>
<td>12.00 s/d  14.00 </td>
<td><?php echo $jam_record2->g; ?></td>
</tr>

<tr>
<td>14.00 s/d  16.00 </td>
<td><?php echo $jam_record2->h; ?></td>
</tr>

<tr>
<td>16.00 s/d  18.00 </td>
<td><?php echo $jam_record2->i; ?></td>
</tr>

<tr>
<td>18.00 s/d  20.00 </td>
<td><?php echo $jam_record2->j; ?></td>
</tr>

<tr>
<td>20.00 s/d  22.00 </td>
<td><?php echo $jam_record2->k; ?></td>
</tr>

<tr>
<td>22.00 s/d  24.00 </td>
<td><?php echo $jam_record2->l; ?></td>
</tr>
 
</table>

</div>

</div>
