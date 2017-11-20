<script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>"></script>

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

    <div class="card">
                <div class="card-header"><b>PENCARIAN</b></div>
                <div class="card-body">
                  <div>
                  <form id="frmcari" method="post" class="form-inline">
                  <div class="form-group">
                         
                  <select class="form-control mb-2 mr-sm-2 mb-sm-0 mt-2" name="tahun" id="tahun">
                    <option value="">- Pilih Tahun -</option>
                    <?php
                      $tahun = date("Y");

                      for($x = date('Y'); $x >= 2000; $x--) {
                          $sel = ($x==$tahun)?"selected":"";
                          echo "<option $sel value='".$x."'>".$x."</option>";
                        }
                    ?>
                  </select>
                  </div>

                   


                  <div class="form-group">
                      <?php    
                     //$arr_bulan=array("x"=>"== SEMUA BULAN == ");
                      
                      $arr_jenis = $this->cm->get_arr_dropdown("m_kelompok_kejahatan","id_kelompok","kelompok","kelompok");
                      // $arr_jenis = $this->cm->add_arr_head($arr_jenis,"x","== SEMUA BULAN ==");

                      echo form_dropdown("id_kelompok",$arr_jenis,'','id="id_kelompok" class="form-control mb-2 mr-sm-2 mb-sm-0 mt-2 ds2" ');
                     ?>
                   
                  </div>



                  <div class="form-group">
                         <?php
                          $arr = array("x"=>"POLDA KESELURUHAN ",
                                      "polda"=>"POLDA",
                                      "polres"=>"POLRES",
                                      "polresall"=>"POLRES KESELURUHAN",
                                      "polsek"=>"POLSEK"
                                      
                                      );
                         echo form_dropdown("jenis",$arr,"",'id="jenis" class="form-control mb-2 mr-sm-2 mb-sm-0 mt-2"');

                         ?>
                         
                      </div>


                      <div class="form-group" id="search_polres">
                         <?php
                          
                         $arr_polres = $this->cm->get_arr_dropdown("m_polres","id_polres","nama_polres","nama_polres");

                         $arr_polres = $this->cm->add_arr_head($arr_polres,"x","=  PILIH POLRES =");


                         echo form_dropdown("id_polres",$arr_polres,"",'id="id_polres" class="form-control mb-2 mr-sm-2 mb-sm-0 mt-2" onchange="get_data_polres(this,\'#id_polsek\',1)"');

                         ?>
                         
                      </div>


                       <div class="form-group" id="search_polsek">
                         <?php
                         echo form_dropdown("id_polsek",array(),"",'id="id_polsek" class="form-control mb-2 mr-sm-2 mb-sm-0 mt-2"');

                         ?>                         
                      </div>

                      <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> Cari</button>
                     </form>
               
                  </div>
                </div>
    </div>


  </div>
</div>

<div class="col-md-12">
<!-- 
<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">Tambah Baru </a> <a href="<?php echo site_url("$controller"); ?>" class="btn btn-primary">Lihat Data </a><br><br> -->

<div id="grafik" style="min-height: 250px;">

  <div id="hasil"></div>

</div>

</div>



<?php 
$this->load->view($this->controller."_view_js") ;
$this->load->view("js/general_js"); 
?>
