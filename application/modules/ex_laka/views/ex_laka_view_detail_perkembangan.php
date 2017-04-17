<p>
</p>

<table width="100%"  border="0" class="table table-striped">
<thead>
  <tr >

        <th width="15%">LIDIK/SIDIK</th>
        <th width="19%">TAHAP</th>
        <th width="19%">NO DOKUMEN</th>
        <th width="19%">TANGGAL</th>
        
        <th width="22%">KETERANGAN</th>
        <th width="5%">DOKUMEN</th>
         
       
    </tr>
  
  <?php 
  foreach($rec_perkembangan->result() as $row) : 


     // $row['lidik'], 
     //            $row['tahap'], 
     //            $row['no_dokumen'],            
     //            flipdate($row['tanggal']), 
     //            $row['keterangan'], 
    ?>
        <TR>
        <td><?php echo $row->lidik ?></td>
        <td><?php echo $row->tahap ?></td>
        <td><?php echo $row->no_dokumen ?></td>
        <td><?php echo flipdate($row->tanggal) ?></td>
        <td><?php echo $row->keterangan ?></td>
        <td><?php echo ""; ?></td>
        </TR>
  <?php
  endforeach;
  ?>


</thead>
</table>

