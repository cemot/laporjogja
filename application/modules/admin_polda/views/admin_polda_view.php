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
                <label for="nama_polda">NAMA POLDA </label>
                <input name="nama_polda" type="text" class="form-control" id="nama_polda" placeholder="Nama Polda" value="<?php echo $nama_polda; ?>">
              </div>

              <div class="form-group">
                <label for="tempat">Tempat  </label>
                <input name="tempat" type="text" class="form-control" id="tempat" placeholder="Tempat Kedudukan" value="<?php echo $tempat; ?>">
              </div>


 
              <div class="form-group">
                <label for="ttd_nama">PENANDATANGAN</label>
                <input name="ttd_nama" type="text" class="form-control" id="ttd_nama" placeholder="PENANDATANGAN"  value="<?php echo $ttd_nama; ?>">
              </div>

              <div class="form-group">
                <label for="ttd_nama">NRP </label>
                <input name="ttd_nrp" type="text" class="form-control" id="ttd_nrp" placeholder="NRP"  value="<?php echo $ttd_nrp; ?>">
              </div>


              <div class="form-group">
                <label for="ttd_nama">PANGKAT  </label>
                <!-- <input name="ttd_pangkat" type="text" class="form-control" id="ttd_pangkat" placeholder="Pangkat"  value="<?php echo $ttd_pangkat; ?>"> -->

                <?php 
                $arr_pangkat = $this->cm->arr_dropdown("m_pangkat","id_pangkat","pangkat","pangkat");
                echo form_dropdown("ttd_id_pangkat",$arr_pangkat,$ttd_id_pangkat,'class="form-control" id="ttd_id_pangkat"');
                ?>

              </div>

               <div class="form-group">
                <label for="ttd_nama">JABATAN  </label>
                <input name="ttd_jabatan" type="text" class="form-control" id="ttd_jabatan" placeholder="Jabatan"  value="<?php echo $ttd_jabatan; ?>">
              </div>

              <button type="submit" class="btn btn-primary">SIMPAN</button>
              </form>
 


                 
 
</div>

<?php $this->load->view($this->controller."_view_js"); ?>
