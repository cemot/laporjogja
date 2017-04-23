
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
                  <form class="form-inline" id="fuckyouform">

                  <div class="form-group">
                         
                        <input type="text" class="tanggal form-control" 
                        id="tanggal_awal" placeholder="Tangal Awal" 
                        data-date-format="dd-mm-yyyy"  
                        name="tanggal_awal" style="width:120px">
                      </div>
                      <div class="form-group">
                         
                        <input type="text" class="tanggal form-control" 
                        id="tanggal_akhir" placeholder="Tanggal Akhir"
                        data-date-format="dd-mm-yyyy" style="width:120px"
                        name="tanggal_akhir"  >
                      </div>

                      

                      <div class="form-group">
                         <?php
                         $arr = array("x"=>"= SEMUA = ",
                                      "polda"=>"POLDA",
                                      "polres"=>"POLRES",
                                      "polsek"=>"POLSEK"
                                      
                                      );
                         echo form_dropdown("jenis",$arr,"",'id="jenis" class="form-control"');

                         ?>
                         
                      </div>


                      <div class="form-group" id="search_polres">
                         <?php
                          
                         $arr_polres = $this->cm->get_arr_dropdown("m_polres","id_polres","nama_polres","nama_polres");

                         $arr_polres = $this->cm->add_arr_head($arr_polres,"x","=  PILIH POLRES =");


                         echo form_dropdown("id_pores",$arr_polres,"",'id="id_polres" class="form-control" onchange="get_data_polres(this,\'#id_polsek\',1)"');

                         ?>
                         
                      </div>


                       <div class="form-group" id="search_polsek">
                         <?php
                          
                        

                         

                         echo form_dropdown("id_polsek",$arr_polres,"",'id="id_polsek" class="form-control"');

                         ?>
                         
                      </div>



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

 
<div id="" style="overflow-y: scroll; min-height:400px;">
<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="leasing" role="grid">
<thead>
	<tr style="background-color:#CCC">

        <th width="16%">NOMOR</th>
        <th width="10%">TANGGAL</th>
        <th width="15%">TMP. KEJADIAN</th>
        <th width="15%">TGL. KEJADIAN</th>
        <th width="10%">PELAPOR</th>
        <th width="10%">PENYIDIK</th>
         
      <th width="10%">#</th>
    </tr>
	
</thead>
</table>
</div>
</div>    
     


 



<?php $this->load->view($controller."_view_js") ?>
<?php $this->load->view("js/general_js") ?>
