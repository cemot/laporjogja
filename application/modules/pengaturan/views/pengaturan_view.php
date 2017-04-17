<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">
<!-- <script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>"></script> -->
<script type="text/javascript">
   $(document).ready(function(){
    $(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });
   });


function reset_cari() {
  $("#tanggal").val('');
}
</script>


<div class="row">
  <div id="salah" class="col-lg-12" style="display:none">
            <div class="alert alert-danger" role="alert" id="message">
            	
            </div>
        </div>
    </div>
    
  <div class="row">
  <div id="benar" class="col-lg-12" style="display:none">
            <div class="alert alert-success" role="alert" id="message2">
            	
            </div>
        </div>
    </div> 

<div class="row">
  <div class="col-md-12">

 
                   
                  <!-- <div class="form-group">
                     <form method="get" action="<?php echo site_url("$this->controller/pdf") ?>" target="blank" >    
                   <input type="text" placeholder="Tanggal"  name="tanggal" class="tanggal form-control" data-date-format="dd-mm-yyyy" id="tanggal" >

                     <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-print"></i> Cetak</button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset</a>
                    </form>
                    </div> -->
              <form id="frm_setting_polda">
              <div class="form-group">
                <label for="nama_polda">NAMA <?php echo strtoupper($userdata['jenis']) ?> </label>
                <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Polres/Polsek" value="<?php echo $nama; ?>">
              </div>

              <div class="form-group">
                <label for="tempat">Tempat kedudukan  </label>
                <input name="tempat" type="text" class="form-control" id="tempat" placeholder="Tempat Kedudukan" value="<?php echo $tempat; ?>">
              </div>


 
              <div class="form-group">
                <label for="ttd_nama">ALAMAT</label>
                <input name="alamat" type="text" class="form-control" id="alamat" placeholder="ALAMAT"  value="<?php echo $alamat; ?>">
              </div>

               

              <button type="submit" class="btn btn-primary">SIMPAN</button>
              </form>
 


                 
 
</div>

<?php $this->load->view($this->controller."_view_js"); ?>
