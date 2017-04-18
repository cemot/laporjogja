<p>
</p>
<table width="100%" class="table table-striped">
<thead>
  <tr>

        <th width="3%">NO.</th>
        <th width="7%">TANGGAL</th>
        <th width="10%">LIDIK/SIDIK</th>
        <th width="30%">TAHAP</th>
        <th width="19%">NO DOKUMEN</th>
        <th width="22%">KETERANGAN</th>
         <th width="10%">FILE DOKUMEN</th>
         
         
       
    </tr>
  
</thead>

<?php 
$n=0;
foreach ($rec_perkembangan->result() as  $value)  : 
     $n++;
 
?>
<tr >
        <TD><?php echo $n; ?></TD>
        <td><?php echo flipdate($value->tanggal); ?></td>
        <td><?php echo ($value->lidik=="1")?"Penyidikan":"Penyelidikan"; ?></td>
        
        <td><?php echo $value->tahap; ?></td>
        <td><?php echo $value->no_dokumen; ?></td>
        
        
        <td><?php echo $value->keterangan; ?></td>

        <td><?php echo (empty($row['file_dokumen']))?"-":anchor("general/getdokumen/".$row['file_dokumen'],$row['file_dokumen']); ?></td>

        
         
         
       
    </tr>



<?php endforeach; ?>
</table>
