<p>
</p>

<a href="javascript:penyidik_baru();" class="btn btn-success"><span class="glyphicon glyphicon-add"></span>Tambah Penyidik </a>
<p></p>

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="grid_penyidik" role="grid">
<thead>
  <tr style="background-color:#CCC">

        <th width="15%">NRP</th>
        <th width="19%">NAMA</th>
        <th width="19%">KOORDINATOR</th>
        <th width="19%">PANGKAT</th>

        <th width="19%">POLSEK/POLRES</th>
        <!-- <th width="18%">ALAMAT</th> -->
        <th width="12%">NO. HP</th>
        <th width="22%">EMAIL</th>
         
      <th width="14%">#</th>
    </tr>
  
</thead>
</table>



<div class="modal fade" id="peyidik_modal" tabindex="-1" role="dialog" aria-labelledby="peyidik_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titleModal">Tambah Penyidik <?php 
echo "lap b id".$lap_b_id;  
?></h4>
      </div>
      <div class="modal-body">
       
<form action="" id="formulir_penyidik" method="post">
            <table width="100%"  class='table table-bordered'>
              <tr>
               
              <tr><td width="30%" >Nama / NRP Penyidik </td>
              <TD>
              <?php 
                $arr_penyidik = $this->dm->get_arr_data_penyidik();
                echo form_dropdown("id_penyidik",$arr_penyidik,'','id="id_penyidik" class="form-control"');
              ?>

               </TD></tr>

                <tr><td width="30%" >Koordinator</td>
              <TD>
              <?php 
                $arr_koor = array(0=>"Tidak","Ya");
                echo form_dropdown("koordinator",$arr_koor,'','id="koordinator" class="form-control"');
              ?>

               </TD></tr>

             </table>
            <input type="hidden" name="id" value=""  id="id"  />   
            <input type="hidden" name="lap_b_id"   id="lap_b_id" value="<?php echo $lap_b_id; ?>"  /> 
            
             </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return penyidik_simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>