<h5> <strong>DATA PENYIDIK </strong></h5>
<div class="row">
	<div class="col-md-2"> NRP 
	</div>
	<div class="col-md-6"> : <?php echo $datauser['user_id']; ?>
	</div>
</div>

<div class="row">
	<div class="col-md-2"> NAMA 
	</div>
	<div class="col-md-6"> : <?php echo $datauser['nama']; ?>
	</div>
</div>

<div class="row">
	<div class="col-md-2"> SATUAN 
	</div>
	<div class="col-md-6"> : <?php echo strtoupper($datauser['jenis']); ?>
	</div>
</div>

<?php 
if($datauser['jenis'] == "polda") { 
?>
<div class="row">
	<div class="col-md-2"> POLDA 
	 
	</div>
	<div class="col-md-6"> : D.I.Y
	</div>
</div>

<?php 
	}
if ($datauser['jenis'] == "polres" or $datauser['jenis'] =="polsek") {

 
?>

<div class="row">
	<div class="col-md-2"> POLRES 
	 
	</div>
	<div class="col-md-6"> : <?php echo strtoupper($datauser['nama_polres']); ?>
	</div>
</div>

<?php } ?>

<?php 
	 
if ($datauser['jenis'] =="polsek") {

 
?>

<div class="row">
	<div class="col-md-2"> POLSEK 
	 
	</div>
	<div class="col-md-6"> : <?php echo strtoupper($datauser['nama_polsek']); ?>
	</div>
</div>

<?php } ?>



<hr /> 
<h5> DATA KASUS </h5>

<table class="table table-bordered table-hover">
            <tr>
            	<th> NO. </th>
              <th  align="center">NOMOR LP </th>
              <th  align="center">TANGGAL </th>
              <th  align="center">TINDAK PIDANA </th>               
            </tr>


<?php 
$no = 0; 
foreach($dataKasus->result() as $row) : 
$no++;
?>
<tr>
	<td><?php echo $no; ?></td>
	<td><?php echo $row->nomor; ?></td>
	<td><?php echo $row->tanggal; ?></td>
	<td><?php echo $row->tindak_pidana; ?></td>
</tr>

<?php endforeach; ?>

</table>