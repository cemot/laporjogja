<div class="modal fade" id="pengguna_modal" tabindex="-1" role="dialog" aria-labelledby="saksiModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titleModal">Tambah Kelompok</h4>
      </div>
      <div class="modal-body">
        
<form action="" id="formulir" method="post">
            <table width="100%"  class='table table-bordered'>

               <tr>               
              <tr><td width="30%" >Tingkat  </td>
              <TD>
              <?php 
                 $arr = array("x"=>"==PILIH JENIS ==","polda"=>"POLDA","polrespolsek"=>"POLRES/POLSEK");
                 echo form_dropdown("jenis",$arr,'','id="jenis" class="form-control"');
              ?>

              </TD></tr>

              <tr>               
              <tr><td width="30%" >Direktorat / Satuan </td>
              <TD>
                  <?php 
                  echo form_dropdown("id_kesatuan",array(),'','id="id_kesatuan" class="form-control"'); 
                  ?>
              </TD>

            </tr>


            <tr><td width="30%" >Subdit / Unit </td>
              <TD>
                  <?php 
                  echo form_dropdown("id_subdit",array(),'','id="id_subdit" class="form-control"'); 
                  ?>

              </TD>

            </tr>


             <tr><td width="30%" >Unit / Panit</td>
              <TD>
                 <input type="text" name="unit" class="form-control" id="unit" />
              </TD>

            </tr>
             </table>
            <input type="hidden" name="id_unit" value=""  id="id_unit"  />
       
            
             </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>
