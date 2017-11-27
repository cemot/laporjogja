<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.form.js") ?>"></script>

<div class="row" style="margin-bottom: 100px;">
</div>

<div class="row">


<div class="col-md-3 col-md-offset-4">
<center>


<form id="frm_update" method="post" enctype="multipart/form-data" action="<?php echo site_url("api/do_import_lp") ?>">


<input type="file" name="userfile" class="form-control" / >  <br /> <br />
<input type="submit" value="IMPORT DATA LP OFFLINE" name="import_user" class="btn btn-primary" />

</form>



<!-- 
<a href="#" id="btnaktif" class="btn btn-primary btn-block btn-lg"><i class="fa fa-arrow-circle-down"></i> IMPORT DATA </a>
<a href="#" id="btnnonaktif"  class="btn btn-primary btn-block btn-lg" disabled="disabled"><i class="fa fa-circle-o-notch fa-spin"></i> SEDANG PROSES..  </a>
 -->

</center>
</div>


</div>

 
<script type="text/javascript">
	
$(document).ready(function(){



$("#frm_update").submit(function(){

	$('#myPleaseWait').modal('show');
	 $(this).ajaxSubmit({
	 	dataType : 'json' , 

	 	success : function(jsonData) {
	 		BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: jsonData.pesan,
			                 
			            });  
	 	

	 	}


	 	
	 }); 
 
 	$('#myPleaseWait').modal('hide');
     return false;  
       
     
}); 






$("#btnnonaktif").hide();

$("#btnaktif").click(function(){





BootstrapDialog.show({
            message : 'ANDA AKAN MENGIMPORT DATA DARI SERVER. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI IMPORT DATA ',
            draggable: true,
            buttons : [

            	{ // button ya 
            			label : 'YA',
            			cssClass : 'btn-primary',
            			hotkey: 13,
            			action : function(dialogItself){

            					 dialogItself.close();
            					 send();

            			}


            	},
            	{  // button tidak 

            		label : 'TIDAK',
	                cssClass : 'btn-danger',
	                action: function(dialogItself){
	                    dialogItself.close();
	                }

            	}



            ]



        });







	


});



});


function send(){
	$("#btnaktif").hide(); 
	$("#btnnonaktif").show();


	$.ajax({
		url : '<?php echo site_url("sync/pulldata") ?>',
		dataType : 'json',
		success : function(jsonData) {


			if(jsonData.error == false) { 

			 		BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: jsonData.pesan,
			                 
			            });  
			}
			else {
				BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_DANGER,
			                title: 'Error',
			                message: jsonData.pesan,
			                 
			            });  
			}

			$("#btnaktif").show(); 
			$("#btnnonaktif").hide();


		}
	});
}


</script>