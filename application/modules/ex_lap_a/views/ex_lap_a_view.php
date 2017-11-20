  

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

    <div class="card panel-default">
                <div class="card-header"><b>PENCARIAN</b></div>
                <div class="card-block">
                  <form class="form-inline" id="fuckyouform">

                  <div class="input-group">
                         
                        <input type="text" class="tanggal form-control" 
                        id="tanggal_awal" placeholder="Tangal Awal" 
                        data-date-format="dd-mm-yyyy"  
                        name="tanggal_awal" style="width:120px">
                      </div>
                      <div class="input-group">
                         
                        <input type="text" class="tanggal form-control" 
                        id="tanggal_akhir" placeholder="Tanggal Akhir"
                        data-date-format="dd-mm-yyyy" style="width:120px"
                        name="tanggal_akhir"  >
                      </div>


                      <div class="input-group">
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


                      <div class="input-group" id="search_polres">
                         <?php
                          
                         $arr_polres = $this->cm->get_arr_dropdown("m_polres","id_polres","nama_polres","nama_polres");

                         $arr_polres = $this->cm->add_arr_head($arr_polres,"x","=  PILIH POLRES =");


                         echo form_dropdown("id_polres",$arr_polres,"",'id="id_polres" class="form-control" onchange="get_data_polres(this,\'#id_polsek\',1)"');

                         ?>
                         
                      </div>


                       <div class="input-group" id="search_polsek">
                         <?php
                          
                        

                         

                         echo form_dropdown("id_polsek",$arr_polres,"",'id="id_polsek" class="form-control"');

                         ?>
                         
                      </div>



                      <div class="input-group" id="search_polres">
                         <?php
                          
                          $arr_status = $this->cm->arr_status_kasus;
                          $arr_status = $this->cm->add_arr_head($arr_status,"x","== SEMUA  == ");

                          echo form_dropdown("penyelesaian",$arr_status,'','id="penyelesaian" class="form-control"');
                          

                         ?>
                         
                      </div>

                     <!--  <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="pelapor_nama" placeholder="Nama pelapor"
                        style="width:150px"
                        name="pelapor_nama"  >
                      </div>

                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="nomor" placeholder="Nomor LP"
                        style="width:150px"
                        name="nomor"  >
                      </div> -->
                      

                     <!--  <div class="form-group">
                       <?php 

            $arr_fungsi = $this->cm->get_arr_dropdown("m_fungsi", 
                    "id_fungsi","fungsi",'fungsi');
            array_unshift($arr_fungsi, "- Semua Fungsi Terkait -");
            echo form_dropdown('',$arr_fungsi,'','id="id_fungsi" class="form-control"');
             ?>
                      </div> -->
                     <!--  <a href="#" class="btn btn-success"><i class="glyphicon glyphicon-search" id='btn_cari'></i>Cari</a> -->


                     <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search" id='btn_cari'></i> Cari</button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
                     <!-- 
                      <button id="cari_button" class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search" id='btn_reset' onclick="return reset_cari();"></i> Reset</button>
 -->

                  </form>
                </div>
    </div>


  </div>
</div>

<div class="row">
<div class="col-md-12">

<p></p>



<div id="" style="overflow-y: scroll; min-height:400px;">

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="leasing" role="grid">
<thead>
	<tr style="background-color:#CCC">

        <th width="16%">NOMOR</th>
        <th width="10%">TANGGAL</th>
        <th width="15%">PELAPOR</th>
        <th width="15%">TERLAPOR</th>
        <th width="56%">TINDAK PIDANA</th>
        <th width="10%">OPERATOR ENTRY</th>
        <th width="10%">PENYIDIK</th>
      <th width="16%">PROSES</th>
    </tr>
	
</thead>
</table>
</div>
</div>    
     


 



<?php $this->load->view($controller."_view_js") ?>
<?php $this->load->view("js/general_js") ?>
