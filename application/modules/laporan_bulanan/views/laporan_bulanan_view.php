<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">
<!-- <script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>"></script> -->


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

    <div class="panel panel-default">
    <div class="panel-heading"><b>PENCARIAN</b></div>
    <div class="panel-body">
      
      <form id="frmlaporan" action="<?php echo site_url("$this->controller/pdf") ?>" target="blank">
              <div class="form-group">
                <label for="jenis">PILIHAN INSTANSI </label>
               <?php
                  $arr = array("polda"=>"POLDA",
                               "polres"=>"POLRES" 
                    ); 
                 echo form_dropdown("jenis",$arr,'','id="jenis" class="form-control" ' )
               ?>
              </div>




 
              <div class="form-group" id="txt_polres">
                <label for="id_polres">POLRES</label>
                <?php
                   
              $arr_polres = $this->cm->arr_dropdown("m_polres","id_polres","nama_polres","nama_polres");

                 echo form_dropdown("id_polres",$arr_polres,'','id="id_polres" class="form-control"  onchange="get_data_polres(this,\'#id_polsek\',1)" ' )
               ?>
              </div>


            <!--   <div class="form-group" id="txt_polsek">
                <label for="id_polsek">POLSEK</label>
                <?php
                   
              

                 echo form_dropdown("id_polsek",array(),'','id="id_polsek" class="form-control"' );
               ?>
              </div> -->


              <div class="row">
                <div class="col-md-6">

              <div class="form-group" >
                <label for="bulan">BULAN</label>
                
                <?php
                   
                $arr_bulan = $this->cm->arr_bulan;
                $bln = date('m');

                 echo form_dropdown("bulan",$arr_bulan,$bln,'id="bulan" class="form-control"' );
               ?></div>

                
               </div>
               

              


               <div class="col-md-6">
              <div class="form-group">
                <label for="tahun">TAHUN </label>

                <input name="tahun" type="text" class="form-control" id="tahun" placeholder="Tahun" value="<?php echo date("Y"); ?>"   >
              </div></div>

           </div>

             <a id="query_button" class="btn btn-primary" type="submit" onclick="tampildata()"><i class="fa fa-eye"></i> Tampilkan</a>

             <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-print"></i> Cetak</button>
              </form>




    </div>


  </div>
</div>

</div> 

<div class="row">
<div class="col-md-12" style="min-height: 300px;"> 
  <div id="hasil"> </div>
</div>
</div>
<?php $this->load->view("laporan_bulanan_view_js") ?>
<?php $this->load->view("js/general_js") ?>
