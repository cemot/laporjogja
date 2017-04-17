<div class="modal fade" id="pengguna_modal" tabindex="-1" role="dialog" aria-labelledby="saksiModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titleModal">Tambah Pengguna Baru</h4>
      </div>
      <div class="modal-body">
        
<form action="" id="formulir" method="post">
            <table width="100%"  class='table table-bordered'>
               
               
              <tr><td width="30%" >Nama Polres </td>
              <TD><input type="text" class="form-control" name="nama_polres" id="nama_polres" placeholder="Nama Polres" /> </TD></tr>

              <tr><td width="30%" >Tempat kedudukan </td>
              <TD><input type="text" class="form-control" name="tempat" id="tempat" placeholder="Tempat kedudukan" /> </TD></tr>


              <tr><td >Nama Penandatangan </td>
              <TD><input type="text" class="form-control" name="ttd_nama" id="ttd_nama" placeholder="Nama Penandatangan" /> </TD></tr>

              <tr><td >NRP Penandatangan </td>
              <TD><input type="text" class="form-control" name="ttd_nrp" id="ttd_nrp" placeholder="NRP Penandatangan" /> </TD></tr>

              <tr><td >Jabatan Penandatangan </td>
              <TD><input type="text" class="form-control" name="ttd_jabatan" id="ttd_jabatan" placeholder="Jabatan Penandatangan" /> </TD></tr>

              <tr><td >Pangkat Penandatangan </td>
              <TD><input type="text" class="form-control" name="ttd_pangkat" id="ttd_pangkat" placeholder="Pangkat Penandatangan" /> </TD></tr> </table>
            <input type="hidden" name="id_polres" value=""  id="id_polres"  />
       
            
             </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return pengguna_simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>
