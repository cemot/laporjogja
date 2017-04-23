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
                <label for="jenis">TINDAK KEJAHATAN </label>
                <?php 
               $arr_polres = $this->cm->arr_dropdown("m_golongan_kejahatan","id","golongan_kejahatan","golongan_kejahatan");

                 echo form_dropdown("id_gol_kejahatan",$arr_polres,'','id="id_gol_kejahatan" class="form-control ds2"   ' )
               ?>
              </div>

              <div class="form-group">
                <label for="jenis">PILIH PERIODE </label>
                <?php 
                $arr_periode = array( "x" => " =PILIH PERIODE = ",
                                      "harian"=>"HARIAN",
                                      "periodik" =>"PERIODE TANGGAL",
                                      "bulanan" =>"BULANAN");

                 echo form_dropdown("jenis",$arr_periode,'','id="jenis" class="form-control"   ' )
               ?>
              </div>


              <div id="harian" class="form-group">
                <label for="tanggal">TANGGAL</label>
                 <input name="tanggal" type="text" class="form-control tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo date("d-m-Y"); ?>"     data-date-format="dd-mm-yyyy">
              </div>

 
            

              <div id="periodik" class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="tanggal1">TANGGAL AWAL </label>

                    <input name="tanggal1" type="text" class="form-control tanggal1" id="tanggal1" placeholder="Tanggal awal" value="<?php echo date("d-m-Y"); ?>"      data-date-format="dd-mm-yyyy" >
                  </div></div>
                   

                  


                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="tanggal2">TANGGAL AKHIR </label>

                    <input name="tanggal2" type="text" class="form-control tanggal" id="tanggal2" placeholder="Tanggal akhir" value="<?php echo date("d-m-Y"); ?>"     data-date-format="dd-mm-yyyy" >
                  </div></div>

            </div>
 


              <div id="bulanan" class="row">
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

           <!--   <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-print"></i> Cetak</button> -->
              </form>




    </div>


  </div>
</div>

</div> 
 
 

<div class="row">
<div class="col-md-12" style="min-height: 300px;"> 
  <div id="hasil" style="display: none;"> </div>
</div>
</div>

<?php $this->load->view($this->controller."_view_js") ?>
<?php $this->load->view("js/general_js") ?>
