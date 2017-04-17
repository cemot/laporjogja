<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">
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

    <div class="panel panel-default">
                <div class="panel-heading"><b>PENCARIAN</b></div>
                <div class="panel-body">
                  <div class="form-inline">

                  <div class="form-group">
                         
                  <select class="form-control" name="tahun" id="tahun">
                    <option value="">- Pilih Tahun -</option>
                    <?php
                      for($x = date('Y'); $x >= 2000; $x--) {
                          echo "<option value='".$x."'>".$x."</option>";
                        }
                    ?>
                  </select>

                  <?php 

              $arr_polres = $this->cm->get_arr_dropdownpolres("m_polres","id_polres","nama_polres","nama_polres");
              echo form_dropdown("id_polres",$arr_polres,'','class="form-control" id="id_polres" onchange="get_data_polres(this,\'#id_polsek\',1)"');
              ?>
              <?php 
              
              echo form_dropdown("id_polsek",array(),'','class="form-control" id="id_polsek"');
              ?>



                     <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> Cari</button>
                     
               
                  </div>
                </div>
    </div>


  </div>
</div>

<div class="col-md-12">
<!-- 
<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">Tambah Baru </a> <a href="<?php echo site_url("$controller"); ?>" class="btn btn-primary">Lihat Data </a><br><br> -->

<div id="grafik" style="height: 423px;">

  <div id="view"></div>

</div>

</div>

<script type="text/javascript">
  $(document).ready(function() {

    $('#view').highcharts({
        title: {
            text: '<?php echo $title; ?>',
            x: -20 //center
        },
    subtitle: {
            text: 'Wellcome Back',
            x: -20
        },
        xAxis: {
            categories: [
          
          'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        
      ]
        },
        yAxis: {
            title: {
                text: '<?php echo $title ?>'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#f1c40f'
            }]
        },
        tooltip: {
            valueSuffix: ' Kasus'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Data Kosong',
            data: [
        <?php
          
          if($query == null ) {
            for($x=1; $x<=count($query); $x++){
              echo '0, ';
            }
          } else {
            $data = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            for($x=0; $x<count($data); $x++) {
              
              echo $query->$data[$x].', ';
            }
          }
          
        ?>
        ]
        }]
    });

    $("#id_polres").change(function(){

    $.ajax({

            url : '<?php echo site_url("$this->controller/get_polsek") ?>',
            data : { id_polres : $(this).val() },
            type : 'post', 
            success : function(result) {
                $("#id_polsek").html(result)
            }
    });

});

    $("#cari_button").click(function() {

      var nilai = $('#tahun').val();
      var id_polres = $('#id_polres').val();
      var id_polsek = $('#id_polsek').val();

      
      if(!nilai) {
        alert('Anda harus pilih tahun Terlebih Dahulu');
        return false;
      }  

      if(!id_polres) {
        alert('Anda harus pilih Polres Terlebih Dahulu');
        return false;
      }  

      $('#grafik').html('<div style="text-align: center; padding-top: 70px;"><img src="<?php echo base_url('assets/images/loading.gif'); ?>"></div>');


      $.ajax({

        url   : '<?php echo site_url("$controller/get_grafik"); ?>',
        data  : 'tahun=' + nilai + '&id_polres=' + id_polres + '&id_polsek=' + id_polsek + '&url=' + <?php echo $this->uri->segment(3); ?>,
        type  : 'GET',
        success: function(obj) {
          $("#grafik").html(obj);
        } 

      });

    });

  });


</script>

<?php //$this->load->view($controller."_view_js") ?>
