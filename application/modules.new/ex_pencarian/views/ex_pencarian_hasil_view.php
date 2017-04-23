<?php echo ($jumlah==0)?"Data tidak ditemukan":"Ditemukan <b>$jumlah</b> data"; ?>

<br /><br />

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="hasil" role="grid">
<thead>
	<tr style="background-color:#CCC">

        <th width="3%">NO.</th>
        <th width="16%">NOMOR LP</th>
        <th width="10%">WAKTU KEJADIAN</th>
       <!--  <th width="10%">WAKTU</th> -->
        <th width="15%">GOL. KEJAHATAN</th>
        <th width="15%">LOKASI</th>
        <th width="76%">TINDAK PIDANA</th>
        <th width="10%">MOTIF</th>
        <th width="16%">FUNGSI TERKAIT</th>
        <th width="10%">DETAIL</th>
    </tr>
	
</thead>

<tbody>
<?php 
$n=0;
foreach($record->result() as $row) : 
$n++;
?>  
    <tr>
        <td ><?php echo $n; ?></td>
        <td ><?php echo $row->nomor; ?></td>
        <td ><?php echo flipdate($row->kp_tanggal). '<BR />'. $row->waktu; ?></td>
        <!-- <td ><?php echo $row->waktu; ?></td> -->
        <td ><?php echo $row->golongan_kejahatan; ?></td>
        <td ><?php echo $row->jenis_lokasi; ?></td>
        <td ><?php echo $row->tindak_pidana; ?></td>
        <td ><?php echo $row->motif; ?></td>
        <td ><?php echo $row->fungsi; ?></td>
        <td ><a target="blank" href="<?php  echo site_url("ex_"."$row->laporan/detail/$row->id") ?>">Detail</a></td>
        </tr>
<?php 
endforeach;
?>

</tbody>
</table>