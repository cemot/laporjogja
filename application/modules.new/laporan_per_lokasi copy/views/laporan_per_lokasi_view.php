<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/select2/dist/css/select2.min.css" rel="stylesheet">
<!--   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 -->


<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<script src="<?php echo base_url("assets") ?>/select2/dist/js/select2.full.min.js"></script>

<!--  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script src="<?php echo base_url("assets") ?>/js/jquery.maphilight.min.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.imagemapster.js"></script>

 
 


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

             <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-print"></i> Cetak</button>
              </form>




    </div>


  </div>
</div>

</div> 

<style type="text/css">
  #sleman {
    background-color: green;
  }
</style>

<div id="peta" class="row">


<div class="col-md-6">

<table class="table table-condensed">
<tr>
  <th>NO.</th>
  <th>WILAYAH</th>
  <th>JUMLAH</th>
</tr>
<tr>
  <td> 1 </td> <td>RESORT KOTA JOGJA </td><td id="td_jogja"></td>
</tr>
<tr>
  <td> 2 </td> <td>RESORT BANTUL </td><td id="td_bantul"></td>
</tr>
<tr>
  <td> 3 </td> <td>RESORT SLEMAN</td><td id="td_sleman"></td>
</tr>
<tr>
  <td> 4 </td> <td>RESORT GUNUNG KIDUL </td><td id="td_gunung_kidul"></td>
</tr>
<tr>
  <td> 5 </td> <td>RESORT KULON PROGO </td><td id="td_kulon_progo"></td>
</tr>
</table>
</div>

<div class="col-md-6">

<img id="petajogja" class="petajogja" src="<?php echo base_url(); ?>/assets/peta-jogja.gif" width="574" height="451" border="0" usemap="#Map2" />
<div>
<map name="Map2" id="Map2">
<area  class="ma" shape="poly" coords="204,90,215,83,218,79,219,69,228,61,238,61,244,56,258,50,264,41,266,34,274,27,281,23,287,23,293,29,298,34,301,43,305,55,305,64,308,76,309,88,312,98,319,109,322,120,322,132,331,141,330,151,339,158,351,165,365,165,373,168,366,175,362,183,351,186,336,189,336,194,328,189,318,191,307,192,297,197,293,204,286,212,287,219,281,226,280,227,275,227,270,220,270,200,270,190,269,183,263,179,252,176,243,173,237,176,230,178,222,183,214,183,205,183,195,183,191,185,188,188,184,183,180,176,177,170,177,165,179,159,185,142,190,134,196,124,198,115,196,109" title="" format="34_4"   id="sleman" href="#bawah" name="sleman" />
<area class="ma" shape="poly" coords="375,167,390,171,404,168,415,165,426,166,440,169,449,169,460,168,469,168,480,169,483,174,492,177,499,183,507,191,507,198,507,212,504,224,500,235,492,250,495,266,498,278,498,294,498,306,491,314,488,327,492,331,492,347,504,361,502,385,506,400,506,410,514,407,528,400,532,398,536,408,529,414,520,419,514,422,504,424,494,421,491,414,482,421,478,426,466,420,457,413,444,408,436,412,433,403,423,401,417,392,411,389,403,389,396,390,390,386,380,379,374,378,372,382,360,377,349,373,330,368,314,366,305,360,287,350,285,341,267,336,260,338,256,332,252,326,251,317,257,297,262,290,266,283,274,276,287,276,299,279,311,282,323,282,330,272,337,260,343,252,343,241,341,231,334,220,330,213,331,204,338,194" href="#bawah" alt="test" name="wonosari" id="wonosari" title="" data="34_3"  />
<area class="ma" shape="poly" coords="239,182,246,177,252,176,255,177,262,178,267,183,267,189,268,194,268,201,268,207,268,211,265,215,264,217,261,213,253,213,248,212,245,211,244,207,241,206,239,205" href="#bawah" alt="test" id="jogja" title=""/>
<area class="ma" shape="poly" coords="182,193,192,187,199,186,208,185,220,183,230,183,234,179,240,177,236,184,236,191,236,199,236,204,238,208,243,212,253,215,260,215,264,219,267,217,268,223,275,227,282,227,287,221,287,211,292,207,297,203,301,198,311,195,319,193,330,192,331,197,331,203,328,212,330,219,331,225,338,231,339,235,340,243,340,251,338,257,334,265,329,274,321,277,316,282,295,277,279,274,270,277,263,285,256,293,254,299,253,308,250,315,246,319,245,315,237,308,228,301,221,301,213,299,206,297,194,291,186,290,178,287,171,285,171,280,180,269,187,267,194,259,198,256,204,254,206,247,209,244,200,233,200,223,193,219,188,213,183,209,182,202" href="#bawah" alt="test" id="bantul" title=""/>
<area class="ma" shape="poly" coords="202,91,194,91,188,87,184,81,183,78,175,75,162,75,150,75,139,73,130,70,120,70,110,70,104,76,101,84,102,91,102,101,102,113,98,123,96,135,93,143,86,149,75,155,69,161,59,174,52,184,44,198,42,207,45,221,52,230,60,237,76,238,80,244,88,252,102,254,114,262,122,264,130,265,134,271,146,275,157,281,164,289,172,289,172,281,176,274,184,267,190,263,197,258,201,253,204,245,200,237,198,229,195,221,186,214,183,209,179,204,184,190,188,187,180,176,176,170,173,162,181,155,190,137,197,120" href="#bawah" alt="Test" id="wates" title=""/>
</map>

</div>

</div>

<a id="#bawah"></a>

<div class="row">
<div class="col-md-12" style="min-height: 300px;"> 
  <div id="hasil"> </div>
</div>
</div>
<?php $this->load->view("laporan_per_lokasi_view_js") ?>
<?php $this->load->view("js/general_js") ?>
