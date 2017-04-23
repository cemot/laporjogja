<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">
<!-- <script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>"></script> -->
<script type="text/javascript">
   $(document).ready(function(){
    
    $(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });
   });


function reset_cari() {
  $("#tanggal").val('');



}

function tampildata(){

  $('#myPleaseWait').modal('show');

  $.ajax({
      url : '<?php echo site_url("$this->controller/get_laporan") ?>',
      data : $("#frmlaporan").serialize(),
      type : 'post', 
      // dataType : 'json',
      success : function(html) {
        $("#hasil").html(html);

        $('#myPleaseWait').modal('hide');
      }
    });
 //alert('whatadaa');
  return false;
}
</script>


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

                  
                     <form id="frmlaporan" method="get" action="<?php echo site_url("$this->controller/pdf") ?>" target="blank" >   
                    
                    <div class="form-group">  
                       <input type="text" placeholder="Tanggal"  name="tanggal" class="tanggal form-control" data-date-format="dd-mm-yyyy" id="tanggal" >

                       <a id="query_button" class="btn btn-primary" type="submit" onclick="tampildata()"><i class="fa fa-eye"></i> Tampilkan</a>

                         <button id="cari_button" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-print"></i> Cetak</button>
                          <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset</a>
                    
                    </div>

                  </form>
                </div>
                </div>
    </div>

 
</div>
</div>

<div class="row">
<div class="col-md-12" style="min-height: 300px;"> 
  <div id="hasil"> </div>
</div>
</div>

