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
 <!-- 



<div class="row">
<div class="col-md-9">
    <div class="card">
            <div class="card-header">PENCARIAN</div>
            <div class="card-body">
            
              
                <form class="form-inline" id="fuckyouform">
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_awal" placeholder="Tangal Awal" 
                        data-date-format="dd-mm-yyyy" value="<?php echo $tanggal_awal ?>" 
                        name="tanggal_awal" style="width:100px">
                      </div>
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_akhir" placeholder="Tanggal Akhir"
                        data-date-format="dd-mm-yyyy" style="width:100px"
                        name="tanggal_akhir" value="<?php echo $tanggal_akhir ?>" >
                      </div>
                      
                      <div class="form-group">
                         
                        <input type="text" class="form-control" style="width:200px"
                        id="no_rangka" placeholder="NOMOR RANGKA / BPKB"
                        name="no_rangka">
                      </div>
                      <div class="form-group">
                       <?php 
              $arr_status = $this->cm->arr_status;
            echo form_dropdown('',array(),'','id="arr_status" class="form-control mb-2 mr-1 mr-sm-2 mb-sm-0 mt-2"');
             ?>
                      </div>
                     
             
                      <a href="#"  id="btn_cari"   class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Cari</a>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
              </form>
                
                
                
            </div>
        </div>
</div>
 -->


<div class="row">
  <div class="col-md-12">

    <div class="card">
                <div class="card-header"><b>PENCARIAN</b></div>
                <div class="card-body">
                  <form class="form-inline" id="fuckyouform">

                  <div class="form-group">
                         
                        <input type="text" class="tanggal form-control mb-2 mr-1 mr-sm-2 mb-sm-0 mt-2" 
                        id="tanggal_awal" placeholder="Tangal Awal" 
                        data-date-format="dd-mm-yyyy"  
                        name="tanggal_awal" style="width:120px">
                      </div>
                      <div class="form-group">
                         
                        <input type="text" class="tanggal form-control mb-2 mr-1 mr-sm-2 mb-sm-0 mt-2" 
                        id="tanggal_akhir" placeholder="Tanggal Akhir"
                        data-date-format="dd-mm-yyyy" style="width:120px"
                        name="tanggal_akhir"  >
                      </div>


                      <div class="form-group">
                         <?php
                         $arr = array("x"=>"POLDA KESELURUHAN ",
                                      "polda"=>"POLDA",
                                      "polres"=>"POLRES",
                                      "polresall"=>"POLRES KESELURUHAN",
                                      "polsek"=>"POLSEK"
                                      
                                      );
                         echo form_dropdown("jenis",$arr,"",'id="jenis" class="form-control mb-2 mr-1 mr-sm-2 mb-sm-0 mt-2"');

                         ?>
                         
                      </div>


                      <div class="form-group" id="search_polres">
                         <?php
                          
                         $arr_polres = $this->cm->get_arr_dropdown("m_polres","id_polres","nama_polres","nama_polres");

                         $arr_polres = $this->cm->add_arr_head($arr_polres,"x","=  PILIH POLRES =");


                         echo form_dropdown("id_polres",$arr_polres,"",'id="id_polres" class="form-control mb-2 mr-1 mr-sm-2 mb-sm-0 mt-2" onchange="get_data_polres(this,\'#id_polsek\',1)"');

                         ?>
                         
                      </div>


                       <div class="form-group" id="search_polsek">
                         <?php
                          
                        

                         

                         echo form_dropdown("id_polsek",$arr_polres,"",'id="id_polsek" class="form-control mb-2 mr-1 mr-sm-2 mb-sm-0 mt-2"');

                         ?>
                         
                      </div>


                      <div class="form-group" id="search_polres">
                         <?php
                          
                          $arr_status = $this->cm->arr_status_kasus;
                          $arr_status = $this->cm->add_arr_head($arr_status,"x","== SEMUA  == ");

                          echo form_dropdown("penyelesaian",$arr_status,'','id="penyelesaian" class="form-control mb-2 mr-1 mr-sm-2 mb-sm-0 mt-2"');
                          

                         ?>
                         
                      </div>
                        

                      <div class="form-group">
                     <button id="cari_button" class="btn btn-primary mb-2 mr-1 mr-sm-2 mb-sm-0 mt-2" type="submit"><i class="glyphicon glyphicon-search" id='btn_cari'></i> Cari</button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger mb-2 mr-1 mr-sm-2 mb-sm-0 mt-2"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
                      </div>
                  </form>
                </div>
    </div>


  </div>
</div>

<div class="row">
<div class="col-md-12">

<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success mt-2">Tambah Baru </a> 
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
        <th width="66%">TINDAK PIDANA</th>
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
