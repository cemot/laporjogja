 
        <!-- Content Header (Page header) -->
        

          <!-- Default box -->
          

            

            <form role="form" action="" id="btn-cari" >
            <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="Tanggal">Tanggal Masuk</label>
                <input name="tgl_masuk" id="tgl_masuk" type="text" class="form-control tanggal" placeholder="Tanggal Masuk" data-date-format="dd-mm-yyyy"></input>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="Tanggal">Tanggal Ekspirasi</label>
                <input name="tgl_ekspirasi" id="tgl_ekspirasi" type="text" class="form-control tanggal" placeholder="Tanggal Ekspirasi" data-date-format="dd-mm-yyyy"></input>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="Tanggal">Lokasi Lapas</label>
                <input name="asal_upt" id="asal_upt" type="text" class="form-control" placeholder="Lokasi Lapas"></input>
              </div>
            </div>

            
            <div class="col-md-3">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama"></input>
              </div>
            </div>
            </div>
             <div class="row">
            <div class="col-md-1">
              <div class="form-group">
                <label></label>
                <button type="submit" class="btn btn-primary form-control" id="btn_submit"><i class="fa">Cari</i></button>
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label></label>
                <button type="reset" class="btn btn-danger form-control" id="btn_reset"><i class="fa">Reset</i></button>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label></label>
                <a href="<?php echo site_url('ex_import_data'); ?>" class="btn btn-success form-control" ><i class="fa">Import Data</i></a>
              </div>
            </div>
            </div>
            </form>
            

<div id="" style="overflow-y: scroll; min-height:400px;">
<table width="100%" border="0" id="biro_jasa" class="table table-striped 
             table-bordered table-hover dataTable no-footer" role="grid">
<thead>
  <tr  > 
        <th width="5%" >NO.REG</th>
        <th width="15%" >NAMA</th>
         <th width="5%" >VONIS</th>
        <th width="5%" >MASUK</th>
        <th width="5%" >EKSPIRASI</th>
       
        <th width="10%" >LAPAS/RUTAN</th>
        <th width="15%" >PASAL</th>
    </tr>
  
</thead>
</table>
            
</div>


<?php 
$this->load->view($this->controller."_view_js");
?>