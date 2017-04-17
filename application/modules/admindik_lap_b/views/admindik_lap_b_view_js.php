<script>
var daft_id = false;



$(document).ready(function(){

  
 


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
				 var id_fungsi = $("#id_fungsi").val();
			 

				 dt.column(1).search(tanggal_awal)
				 .column(2).search(tanggal_akhir)
				 .column(3).search(id_fungsi)
				 .column(4).search($("#pelapor_nama").val())
				 .column(5).search($("#nomor").val())
				 .draw();

				 return false;

				});


	
});

function reset_cari(){

$("#tanggal_awal").val('');
$("#tanggal_akhir").val('');
$("#id_fungsi").val(0).attr('selected','selected');
$("#pelapor_nama").val('')
$("#nomor").val('')
$("#cari_button").click();
return false;

}

</script>