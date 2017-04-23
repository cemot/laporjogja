<script type="text/javascript">
	

$(document).ready(function(){

	$("#frm_setting_polda").submit(function(){
		 $('#myPleaseWait').modal('show');

		 $.ajax({
		 	url : '<?php echo site_url("$this->controller/save") ?>',
		 	type : 'post',
		 	dataType : 'json',
		 	data : $(this).serialize(),
		 	success : function(obj) {
		 		$('#myPleaseWait').modal('hide');
		 		if(obj.error==false){
					 	 
			 	 BootstrapDialog.alert({
	                type: BootstrapDialog.TYPE_PRIMARY,
	                title: 'Informasi',
	                message: obj.message,
	                 
	            });   
				 
				 
				 
				}
				else {
					 BootstrapDialog.alert({
		                type: BootstrapDialog.TYPE_DANGER,
		                title: 'Error',
		                message: obj.message ,
		                 
		            }); 
				}

				
		 	}


		 });

		 

		 return false;

	});

});


</script>