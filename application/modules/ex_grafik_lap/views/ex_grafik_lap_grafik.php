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
    <!-- mabuk mabuk -->
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

                     <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> Cari</button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
               
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
        
chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo $title; ?> '
    },
    subtitle: {
        text: '<?php echo $title.' Tahun : '.$tahun; ?>'
    },
    xAxis: {
        categories: [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah kasus'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} Kasus</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Jumlah ',
        data: [
        0,0,0,0,0,0,0,0,0,0,0
       // 49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4
        <?php 
            // foreach($query as $index =>$vl):
            //                 echo $vl.', ';
            // endforeach;
        ?>
        
        ]

            }]

    });


    $("#cari_button").click(function() {

      var nilai = $('#tahun').val();
      
      if(!nilai) {
        alert('Anda harus pilih tahun dulu');
        return false;
      }  

      $('#grafik').html('<div style="text-align: center; padding-top: 70px;"><img src="<?php echo base_url('assets/images/loading.gif'); ?>"></div>');


      $.ajax({

        url   : '<?php echo site_url("$controller/get_grafik"); ?>',
        data  : 'tahun=' + nilai + '&url=' + <?php echo $this->uri->segment(3); ?>,
        type  : 'GET',
        success: function(obj) {
          $("#grafik").html(obj);
        } 

      });

    });

  });


</script>

<?php //$this->load->view($controller."_view_js") ?>
