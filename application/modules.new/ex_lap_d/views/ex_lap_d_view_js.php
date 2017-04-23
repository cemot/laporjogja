<script>
var daft_id = false;



$(document).ready(function(){

  $(".tanggal").datepicker()
		.on('changeDate', function(ev){                 
		    $(this).datepicker('hide');
		});

 
$("#search_polres").hide();
$("#search_polsek").hide();


$("#jenis").change(function(){
	if( ($(this).val()=="polda") || (  $(this).val()=="x" )   ) {
		$("#search_polres").hide();
		$("#search_polsek").hide();
	}
	else if($(this).val()=="polres") {
		$("#search_polres").show();
		$("#search_polsek").hide();
	}
	else {
		$("#search_polres").show();
		$("#search_polsek").show();
	}
});


 


		 var dt = $("#leasing").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "ajax": '<?php echo site_url("$controller/get_data") ?>'
		 	});

		 
		 $("#leasing_filter").css("display","none");  
		 
			$("#cari_button").click(function(){

				


				 

			 
				 var tanggal_awal = $("#tanggal_awal").val();
				 var tanggal_akhir = $("#tanggal_akhir").val();
				 
			 

				 dt.column(1).search(tanggal_awal)
				 .column(2).search(tanggal_akhir)				 
				 .column(4).search($("#jenis").val())
				 .column(5).search($("#id_polres").val())
				 .column(6).search($("#id_polsek").val())
				 .draw();

				 return false;

				});


	
});




</script>