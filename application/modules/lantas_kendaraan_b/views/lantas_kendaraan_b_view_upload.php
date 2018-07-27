 
 
 
<!-- <link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">
  -->


 

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
            echo form_dropdown('',array(),'','id="arr_status" class="form-control"');
             ?>
                      </div>
                     
             
                      <a href="#"  id="btn_cari"   class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Cari</a>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
              </form>
                
                
                
            </div>
        </div>
</div>
 -->


<script type="text/javascript" src="<?php echo base_url("assets/js/loadingoverlay.min.js") ?>">
  
</script> 
<script src="<?php echo base_url("assets") ?>/jquery.form/jquery.form.min.js"></script>


<div class="row">
  <div class="col-md-12">

    <div class="card">
                <div class="card-header"><b>UPLOAD BERKAS</b></div>
                <div class="card-body">
                  <form method="post" class="form-inline" id="fuckyouform" enctype="multipart/form-data"  >

                   <input type="file" name="berkas">
                   <input type="hidden" name="no_lp" value="<?php echo $nomor; ?>">
                   <button class="btn btn-primary"> UPLOAD </button>

                  </form>
                </div>
    </div>


  </div>
</div>

<?php 

$url_bpkb = $this->config->item('bpkb_upload_url');
?> 
 
<script type="text/javascript">
Pace.on("done", function(){
    $(".cover").hide(2000);
});

  
$(document).ready(function(){




  $("#fuckyouform").submit(function(){
    // $('#myPleaseWait').modal('show'); 

    $.LoadingOverlay("show");

    

     //  alert('helllo...');
      $(this).ajaxSubmit({
          url : '<?php echo $url_bpkb."/save"; ?>', 
          dataType : 'json',
          success : function(obj) {
             
              if(obj.error == false) {
                // send request to server 


                  updatedatalp();


              }
              else {
                $.LoadingOverlay("hide");
                  // $('#myPleaseWait').modal('hide'); 
                 
                  //   BootstrapDialog.alert({
                  //       type: BootstrapDialog.TYPE_DANGER,
                  //       title: 'ERROR',
                  //       message: obj.message,
                  // });  
              }
          }
      });
      return false;
  });


});

function updatedatalp(){
    $.ajax({
       url : '<?php echo site_url("lantas_kendaraan_a/update_upload/") ?>',
       data : {lap_a_id : '<?php echo $lap_a_id ?>' }, 
       dataType : 'json',
       type : 'post',
       success : function(obj) {

       $.LoadingOverlay("hide");

        if(obj.error==false ) {
           // BootstrapDialog.alert({
           //              type: BootstrapDialog.TYPE_PRIMARY,
           //              title: 'Info',
           //              message: obj.message,
           //        }); 
           swal(obj.message, "", "success");
        }
        else {
           // BootstrapDialog.alert({
           //              type: BootstrapDialog.TYPE_DANGER,
           //              title: 'ERROR',
           //              message: obj.message,
           //        });  
           swal(obj.message, "", "danger");
        }




       }


    });
}
</script>

 


 
