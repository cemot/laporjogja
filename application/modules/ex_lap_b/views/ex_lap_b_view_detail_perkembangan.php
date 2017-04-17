<p></p>

<table width="100%"  border="0" class='table table-bordered'>
<thead>
  <tr style="background-color:#CCC">

        <th width="15%">LIDIK/SIDIK</th>
        <th width="19%">TAHAP</th>
        <th width="19%">NO DOKUMEN</th>
        <th width="19%">TANGGAL</th>
        
        <th width="22%">KETERANGAN</th>
        <th width="5%">#</th>
         
       
    </tr>

     <?php 
  foreach($rec_perkembangan->result() as $row) : 


   
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

