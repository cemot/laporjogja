<div class="row">
  <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <tr>
              <th  align="center">NO. </th>
              <th  align="center">NAMA </th>
              <th  align="center" width="10%" style="text-align: center;">P21 </th>
              <th  align="center" width="10%" style="text-align: center;">PENYELIDIKAN</th>
              <th  align="center" width="10%" style="text-align: center;">PENYIDIKAN  </th>
              <th  align="center" width="10%" style="text-align: center;">SP3  </th>
              <th  align="center" width="10%" style="text-align: center;">TOTAL </th>
            </tr>

            <?php 
                $n=0;
                foreach($rec_penyidik->result() as $row) : 
                $n++;

            ?>
            <tr>
              <td ><?php echo $n; ?> </td>

<!-- $table_penyidik 
$table_utama
$id -->
              
              <td ><a href="#bawah" 
                onclick="detailkasus('<?php echo $row->id ?>','<?php echo $tahun ?>','<?php echo $table_utama ?>','<?php echo $table_penyidik ?>','<?php echo $id ?>')" > <?php echo $row->nama; ?> </a> </td>
              <td align="center"><?php echo $row->p21; ?> </td>
              <td align="center"><?php echo $row->sidik; ?> </td>
              <td align="center"><?php echo $row->lidik; ?> </td>
              <td align="center"><?php echo $row->sp3; ?> </td>
              <td align="center"><?php echo $row->total; ?>  </td>
            </tr>

            <?php  endforeach; ?>

        </table>

  </div>

</div>


