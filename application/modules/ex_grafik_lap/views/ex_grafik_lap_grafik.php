<!--  <link rel="stylesheet" href="<?php echo base_url("assets2") ?>/vendors/morrisjs/css/morris.css">

<script src="<?php echo base_url("assets2") ?>/vendors/raphael/raphael.min.js" type="text/javascript"></script>
<script src="<?php echo base_url("assets2") ?>/vendors/morrisjs/js/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url("assets2") ?>/js/plugins/jquery.flot.spline.js" type="text/javascript"></script> -->
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

    <div class="card">
                <div class="card-header"><b>PENCARIAN</b></div>
                <div class="card-body">
                  <div class="form-inline">

                  <div class="form-group">
                         
                  <select class="form-control mb-2 mr-sm-2 mb-sm-0 mt-2" name="tahun" id="tahun">
                    <option value="">- Pilih Tahun -</option>
                    <?php
                      for($x = date('Y'); $x >= 2000; $x--) {
                          echo "<option value='".$x."'>".$x."</option>";
                        }
                    ?>
                  </select>

                     <button id="cari_button" class="btn btn-primary mb-2 mr-sm-2 mb-sm-0 mt-2" type="submit"><i class="glyphicon glyphicon-search"></i> Cari</button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger mb-2 mr-sm-2 mb-sm-0 mt-2"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
               
                  </div>
                </div>
    </div>


  </div>
</div>

<div class="col-md-12">
<!-- 
<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">Tambah Baru </a> <a href="<?php echo site_url("$controller"); ?>" class="btn btn-primary">Lihat Data </a><br><br> -->

<div id="grafik" style="height: 423px;">

   
</div>

<!-- <div id="sales_chart"></div>
 -->


<script type="text/javascript">
  $(document).ready(function() {

     
  // Morris.Bar({
  //       element: 'sales_chart',
  //       data: [
  //           {y: '2009', n: 70, b: 48},
  //           {y: '2010', n: 97, b: 63},
  //           {y: '2011', n: 58, b: 45},
  //           {y: '2012', n: 70, b: 48},
  //           {y: '2013', n: 43, b: 35},
  //           {y: '2014', n: 65, b: 43},
  //           {y: '2015', n: 77, b: 61},
  //           {y: '2016', n: 43, b: 35}
  //       ],
  //       resize: true,
  //       xkey: 'y',
  //       ykeys: ['n', 'b'],
  //       labels: ['Model A', 'Model B'],
  //       barColors: ["#2283BF", "#E7EFF5"],
  //       hideHover: 'auto',
  //       gridLineColor: '#E5E5E5'
  //   });

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
