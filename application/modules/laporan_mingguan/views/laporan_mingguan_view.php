
<script type="text/javascript">
   $(document).ready(function(){
    $(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });
   });



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

    <div class="card">
                <div class="card-header"><b>PENCARIAN</b></div>
                <div class="card-body">
                  <div class="form-inline">

                  <div class="form-group">
                     <form id="frmlaporan" method="get" action="<?php echo site_url("$this->controller/pdf") ?>" target="blank" >    
                   <input type="text" placeholder="Tanggal awal"  name="tanggal" class="tanggal form-control mb-2 mr-sm-2 mb-sm-0 mt-2" data-date-format="dd-mm-yyyy" id="tanggal">

                   <input type="text" placeholder="Tanggal akhir"  name="tanggal2" class="tanggal form-control mb-2 mr-sm-2 mb-sm-0 mt-2" data-date-format="dd-mm-yyyy" id="tanggal2">


                    <a id="query_button" class="btn btn-primary mb-2 mr-sm-2 mb-sm-0 mt-2" type="submit" onclick="tampildata()"><i class="fa fa-eye"></i> Tampilkan</a>

                     <button id="cari_button" class="btn btn-primary mb-2 mr-sm-2 mb-sm-0 mt-2" type="submit"><i class="glyphicon glyphicon-print"></i> Cetak</button>
                     
                      <a href="#" onclick="reset_cari();" class="btn btn-danger mb-2 mr-sm-2 mb-sm-0 mt-2"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
                    </form>
                  </div>
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


