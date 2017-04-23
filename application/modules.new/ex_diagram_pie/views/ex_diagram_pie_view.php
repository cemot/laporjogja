<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">
<script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>"></script>

<div class="col-md-7">
	<div id="container">
		
	</div>
</div>
<div class="col-md-5">
	<table width="100%" border="0" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid">
	<thead>
  <tr> 
        <th width="10%" >No.</th>
        <th width="70%" >UPT</th>
        <th width="20%" >Jumlah</th>
        <th width="20%" >Kapasitas</th>
        <th width="20%" >Sisa</th>
    </tr>
  
</thead>
<tbody>
	<?php 
	// show_array($arr_lapas);
	$i = 1;
	foreach ($jml as $row ) :

	$index= strtolower(str_replace(" ","",($row['asal_upt'])));
	//echo "index $index <br />";
	$sisa = ($arr_lapas[$index] - $row['jumlah']);
	?>
		<tr>
			<td><?php echo $i?></td>
			<td><?php echo $row['asal_upt']; ?></td>
			<td><?php echo $row['jumlah']; ?></td>
			<td><?php echo $arr_lapas[$index]; ?></td>
			<td><?php echo ($sisa<0)?"<font color=red>$sisa</font>":$sisa ; ?></td>
		</tr>

	<?php 
	$i++;	
	endforeach;
	?>
</tbody>
</table>
</div>

&nbsp;<br/>
&nbsp;<br/>
&nbsp;<br/>
&nbsp;<br/>
&nbsp;<br/>






<?php
 	$this->load->view($this->controller."_view_js");
  ?>