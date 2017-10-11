<p>
</p>
<table width="100%" class="table table-striped">
<thead>
  <tr>

        <th width="5%">NO.</th>
        <th width="10%">TANGGAL</th>
        <th width="10%">LIDIK/SIDIK</th>
        <th width="10%">TAHAP</th>
        <th width="19%">NO DOKUMEN</th>
        <th width="22%">KETERANGAN</th>
         
         
       
    </tr>
  
</thead>

<?php 
$n=0;
foreach ($rec_perkembangan->result() as  $value)  : 
     $n++;


      
    $filename = $value->file_dokumen; 

    if(empty($value->file_dokumen) or !file_exists("./documents/".$value->file_dokumen) ) {
                $filelink = "-";
            } 
    else {
       
        $filelink =  '<a target="_blank" href="'.
        base_url("documents/$filename").'"> '.$value->file_dokumen.' </a> ';
    }

 
?>
<tr >
        <TD><?php echo $n; ?></TD>
        <td><?php echo flipdate($value->tanggal); ?></td>
        <td><?php echo ($value->lidik=="1")?"Penyidikan":"Penyelidikan"; ?></td>
        
        <td><?php echo $value->tahap; ?></td>
        <td><?php echo  $filelink;        ?></td>
        
        
        <td><?php echo $value->keterangan; ?></td>
         
         
       
    </tr>



<?php endforeach; ?>
</table>
