<script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>"></script>



<style id="jsbin-css">
    @media (min-width: 768px) {
      .modal-xl {
        width: 90%;
       max-width:1200px;
       margin: 0 auto;
      }
    }

</style>


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


<form class="form-horizontal" id="frmcari">
<div class="row">
  <div class="col-md-6">

  <div class="form-group">
    <label for="tahun" class="col-sm-4 control-label">Tahun</label>
    <div class="col-sm-8">
       <select class="form-control" name="tahun" id="tahun">
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
  </div>
  <div class="form-group">
    <label for="jenis" class="col-sm-4 control-label">POLRES / POLSEK</label>
    <div class="col-sm-8">
      <?php
                          $arr = array("x"=>"POLDA KESELURUHAN ",
                                      "polda"=>"POLDA",
                                      "polres"=>"POLRES",
                                      "polresall"=>"POLRES KESELURUHAN",
                                      "polsek"=>"POLSEK"
                                      
                                      );
                         echo form_dropdown("jenis",$arr,"",'id="jenis" class="form-control"');

                         ?>
    </div>
  </div>


    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">POLRES</label>
    <div class="col-sm-8">
     <?php
                          
                         $arr_polres = $this->cm->get_arr_dropdown("m_polres","id_polres","nama_polres","nama_polres");

                         $arr_polres = $this->cm->add_arr_head($arr_polres,"x","=  PILIH POLRES =");


                         echo form_dropdown("id_polres",$arr_polres,"",'id="id_polres" class="form-control" onchange="get_data_polres(this,\'#id_polsek\',1)"');

                         ?>
    </div>
  </div>




    <div class="form-group" id="search_polsek">
    <label for="id_polres" class="col-sm-4 control-label">POLSEK</label>
    <div class="col-sm-8">
    <?php
                         echo form_dropdown("id_polsek",array(),"",'id="id_polsek" class="form-control"');

                         ?>   
    </div>
  </div>



</div>

<div class="col-md-6">

  <div class="form-group">
    <label for="id_kesatuan" class="col-sm-4 control-label">DIR/KESATUAN</label>
    <div class="col-sm-8">
    <?php
                         echo form_dropdown("id_kesatuan",array(),"",'id="id_kesatuan" class="form-control"');

                         ?>   
    </div>
  </div>


  <div class="form-group">
    <label for="id_subdit" class="col-sm-4 control-label">SUBDIT/UNIT</label>
    <div class="col-sm-8">
    <?php
                         echo form_dropdown("id_subdit",array(),"",'id="id_subdit" class="form-control"');

                         ?>   
    </div>
  </div>

  <div class="form-group">
    <label for="id_unit" class="col-sm-4 control-label">UNIT / PANIT</label>
    <div class="col-sm-8">
    <?php
                         echo form_dropdown("id_unit",array(),"",'id="id_unit" class="form-control"');

                         ?>   
    </div>
  </div>


</div>



</div>

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
     <button id="cari_button" class="btn btn-primary btn-block" type="submit"><i class="glyphicon glyphicon-search"></i> Tampilkan</button>
  </div>
  <div class="col-md-4"></div>
</div>

</div>


</form>


 


                </div>
    </div>
  </div>
</div>


<!-- 
<div class="row">
  <div class="col-md-12">

    <div class="panel panel-default">
                <div class="panel-heading"><b>PENCARIAN</b></div>
                <div class="panel-body">
                  <div class="form-inline">
                  <form id="frmcari" method="post">
                  <div class="form-group">
                         
                  <select class="form-control" name="tahun" id="tahun">
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
                          $arr = array("x"=>"POLDA KESELURUHAN ",
                                      "polda"=>"POLDA",
                                      "polres"=>"POLRES",
                                      "polresall"=>"POLRES KESELURUHAN",
                                      "polsek"=>"POLSEK"
                                      
                                      );
                         echo form_dropdown("jenis",$arr,"",'id="jenis" class="form-control"');

                         ?>
                         
                      </div>


                      <div class="form-group" id="search_polres">
                         <?php
                          
                         $arr_polres = $this->cm->get_arr_dropdown("m_polres","id_polres","nama_polres","nama_polres");

                         $arr_polres = $this->cm->add_arr_head($arr_polres,"x","=  PILIH POLRES =");


                         echo form_dropdown("id_polres",$arr_polres,"",'id="id_polres" class="form-control" onchange="get_data_polres(this,\'#id_polsek\',1)"');

                         ?>
                         
                      </div>


                       <div class="form-group" id="search_polsek">
                         <?php
                         echo form_dropdown("id_polsek",array(),"",'id="id_polsek" class="form-control"');

                         ?>                         
                      </div>

                     <div class="form-group">
                         
                         <?php
                         $arr_fungsi = $this->cm->get_arr_function('polda');
                         $arr_fungsi = $this->cm->add_arr_head($arr_fungsi,"x"," = SEMUA =");
                         echo form_dropdown("id_fungsi",$arr_fungsi,"",'id="id_fungsi" class="form-control"');

                         ?>                         
                      </div>  

                  

               



                     <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> Cari</button>
                     </form>
               
                  </div>
                </div>
    </div>


  </div>
</div> -->

<div class="col-md-12">
<!-- 
<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">Tambah Baru </a> <a href="<?php echo site_url("$controller"); ?>" class="btn btn-primary">Lihat Data </a><br><br> -->

<div id="grafik" style="min-height: 250px;">

  <div id="hasil"></div>

</div>

</div>


<!-- <div class="row">
  <div class="col-md-12" id="datakasus">

   
</div>
</div> -->



<!-- Modal -->
<div  class="modal fade modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">DETAIL KASUS PENYIDIK</h4>
      </div>
      <div class="modal-body" id="datakasus">
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>




<?php 
$this->load->view($controller."_view_js") ;
$this->load->view("js/general_js"); 
?>
