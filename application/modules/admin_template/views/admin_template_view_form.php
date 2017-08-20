<div class="modal fade" id="pengguna_modal" tabindex="-1" role="dialog" aria-labelledby="saksiModal">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titleModal">Tambah Kelompok</h4>
      </div>
      <div class="modal-body">
        
<form action="" id="formulir" method="post">
            
          <div class="form-group">
            <label for="nama">NAMA TEMPLATE : </label>
            <input type="email" class="form-control" id="nama" placeholder="Nama Template" name="nama">
          </div>



          <div class="form-group">
            <label for="isi">ISI TEMPLATE : </label>
            <TEXTAREA id="isi" name="isi" class="form-control"></TEXTAREA>
          </div>



            <input type="hidden" name="id" value=""  id="id"  />
       
            
             </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>
