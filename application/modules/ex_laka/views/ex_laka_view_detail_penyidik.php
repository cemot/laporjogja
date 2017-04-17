<p>
</p>
 

<table width="100%"  border="0" class="table table-striped">
<thead>
  <tr >

        <th width="15%">NRP</th>
        <th width="19%">NAMA</th>
        <th width="19%">PANGKAT</th>
        <th width="19%">POLSEK/POLRES</th>
        <!-- <th width="18%">ALAMAT</th> -->
        <th width="12%">NO. HP</th>
        <th width="22%">EMAIL</th>
         
       
    </tr>
   <?php 
        foreach($rec_penyidik->result() as $row ) : 

    ?>
      <tr>
      <td><?php echo $row->user_id ?></td>
      <td><?php echo $row->nama ?></td>
      <td><?php echo $row->pangkat ?></td>
      <td><?php echo $row->polres_polsek ?></td>
      <td><?php echo $row->nomor_hp ?></td>
      <td><?php echo $row->email ?></td>
      </tr>

    <?php endforeach; ?>
</thead>
</table>

