<script>


$(document).ready(function(){

$(".data-kendaraan").hide();

$(".ds2").select2({
	placeholder: "Pilih "
});



$(".tr_ranmor").hide();

$("#is_ranmor").change(function(){
	if($(this).val() == "0") {
		$(".tr_ranmor").hide();
	}
	else {
		$(".tr_ranmor").show();
	}
});



$("#jenis_korban").change(function(){

	if($("#jenis_korban").val() == "bo") {
	$(".bo").hide();
	}
	else {
		$(".bo").show();
	}

});



$("#id_gol_kejahatan").change(function(){
	//alert('ini dan itu');
	$.ajax({
		url : '<?php echo site_url("general/get_detail_golongan") ?>',
		data : {id_gol_kejahatan : $(this).val() },
		type : 'post',
		dataType : 'json',
		success : function(rsdata) {
			$("#id_kelompok").val(rsdata.kelompok);
			$("#id_golongan").val(rsdata.golongan);

			
		}
	});


	showhide_kendaraan($(this).val());


});



$("#tr_barbuk_baru").hide();
$("#tr_satuan_baru").hide();



$(".tanggal").datepicker()
		.on('changeDate', function(ev){                 
		    $(this).datepicker('hide');
		});



var dt_terlapor = $("#terlapor").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 7, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo $json_url_terlapor ?>'
		 	});



		 /// saksi section 
			var dt_saksi = $("#saksi").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 7, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo $json_url_saksi ?>'
		 	});

		 	
		 	var dt_korban = $("#korban").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 7, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo $json_url_korban ?>'
		 	});

		 	var dt_barbuk = $("#barbuk").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 3, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo $json_url_barbuk; ?>'
		 	});


		 	var dt_pasal = $("#pasallap").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 1, "orderable": true } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo $json_url_pasal; ?>'
		 	});








	$("#txt_id_fungsi").change(function(){

		$.ajax({

			url : '<?php echo site_url("general/get_pasal") ?>',
			data : {id_fungsi : $(this).val()},
			type : 'post',
			success : function(htmldata) {
				$("#id_pasal").html(htmldata);
			}

		});

	});



	
	$("#formulir").submit(function(){

		$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#formulir").attr('action'),
			data : $(this).serialize(),
			dataType : 'json',
			type : 'post',
			error : function (a,b,c) {

				BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_DANGER,
			                title: 'Error',
			                message: 'Koneksi terputus'  
			                 
			    }); 
			},
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message 
			                 
			            });   
						 
						
						if($("#mode").val() == "I") { 
							$('#terlapor').DataTable().ajax.reload();
							$('#saksi').DataTable().ajax.reload();
							$('#korban').DataTable().ajax.reload();
							$('#barbuk').DataTable().ajax.reload();
							$('#pasallap').DataTable().ajax.reload();
							$("#formulir")[0].reset(); }
						
						 
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





<?php if($mode == "U") : ?>
$.ajax({
	url : '<?php echo site_url("$controller/get_detail_json/$lap_b_id") ?>',
	dataType : 'json',
	type : 'post',
 	success : function(jsonData){
 		$("#formulir").loadJSON(jsonData);

 		//$("#id_gol_kejahatan").val(jsonData.id_gol_kejahatan).attr('selected','selected');
 		$("#id_jenis_lokasi").val(jsonData.id_jenis_lokasi).attr('selected','selected');
 		$("#id_fungsi").val(jsonData.id_fungsi).attr('selected','selected');

 		$("#pelapor_jk").val(jsonData.pelapor_jk).attr('selected','selected');

 		$("#pelapor_id_pekerjaan").val(jsonData.pelapor_id_pekerjaan).attr('selected','selected');

 		$("#pelapor_id_provinsi").val(jsonData.pelapor_prov_id).attr('selected','selected');

 		 
 		// console.log('peapor id provinsi '+pelapor_prov_id); 

 		// alert('peapor id provinsi '+jsonData.pelapor_prov_id); 



	  $.ajax({
		url : '<?php echo site_url("general/get_detail_golongan") ?>',
		data : {id_gol_kejahatan :jsonData.id_gol_kejahatan },
		type : 'post',
		dataType : 'json',
		success : function(rsdata) {
			$("#id_kelompok").val(rsdata.kelompok);
			$("#id_golongan").val(rsdata.golongan);

			
		}
	});


	  // alamat pelapor section 

 		$.ajax({
	      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
	      data : {id_prop : jsonData.pelapor_prov_id, id_kota : jsonData.pelapor_kota_id },
	      type : 'post',
	      success: function(data){
	        $("#pelapor_id_kota").html('').append(data);
	      }
	    });


	    $.ajax({
	      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
	      data : { id_kota : jsonData.pelapor_kota_id, id_kec : jsonData.pelapor_kec_id },
	      type : 'post',
	      success: function(data){
	        $("#pelapor_id_kecamatan").html('').append(data);
	      }
	    });


	    $.ajax({
	      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
	      data : { id_kec : jsonData.pelapor_kec_id, id_desa : jsonData.pelapor_id_desa  },
	      type : 'post',
	      success: function(data){
	        $("#pelapor_id_desa").html('').append(data);
	      }
	    });





	    $("#pelapor_id_agama").val(jsonData.pelapor_id_agama).attr('selected','selected');
	    $("#pelapor_id_pendidikan").val(jsonData.pelapor_id_pendidikan).attr('selected','selected');
	    $("#pelapor_id_warga_negara").val(jsonData.pelapor_id_warga_negara).attr('selected','selected');

	    $("#kejadian_id_motif_kejahatan").val(jsonData.kejadian_id_motif_kejahatan).attr('selected','selected');

	    


 		$("#pen_lapor_id_pangkat").val(jsonData.pen_lapor_id_pangkat).attr('selected','selected');
 		$("#mengetahui_id_pangkat").val(jsonData.mengetahui_id_pangkat).attr('selected','selected');

 		
 		// dropdonwn pasal 

 		$.ajax({
 			url : '<?php echo site_url("$controller/get_pasa_edit_dropdown/") ?>',
			type : 'post',
			data : {id_fungsi : jsonData.id_fungsi, id_pasal : jsonData.id_pasal  },
			success : function(pasalData) {
				$("#id_pasal").html(pasalData);
			}
 		});



 		/// lokasi kejadian

 		$("#kejadian_id_provinsi").val(jsonData.kejadian_prov_id).attr('selected','selected');


 		$.ajax({
	      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
	      data : {id_prop : jsonData.kejadian_prov_id, id_kota : jsonData.kejadian_kota_id },
	      type : 'post',
	      success: function(data){
	        $("#kejadian_id_kota").html('').append(data);
	      }
	    });


	    $.ajax({
	      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
	      data : { id_kota : jsonData.kejadian_kota_id, id_kec : jsonData.kejadian_kec_id },
	      type : 'post',
	      success: function(data){
	        $("#kejadian_id_kecamatan").html('').append(data);
	      }
	    });


	    $.ajax({
	      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
	      data : { id_kec : jsonData.kejadian_kec_id, id_desa : jsonData.kejadian_id_desa  },
	      type : 'post',
	      success: function(data){
	        $("#kejadian_id_desa").html('').append(data);
	      }
	    });
 		
 		
 		
 		
 		
	 	}
});

<?php endif; ?>






});
 





var tersangka_couter = 1;
function tersangka_row_add(){

	var row_data = $("#row_tersangka").html();
	//alert(row_data);
	
	id_row = "tr_tersangka_"+tersangka_couter;
	row_data = row_data.replace("<table>",'');
	row_data = row_data.replace("</table>",'');
	row_data = row_data.replace("someid",id_row);
	row_data = row_data.replace("someid",id_row);
	console.log(row_data);
//	alert(row_data);
	$("#table_tersangka").append(row_data);
	//$("#table_tersangka").html('<h1>asshome</h1>');
	tersangka_couter++;
}


function hapus_row_tersangka(id){
	id = "#"+id;
	$(id).remove();

	//alert(id);
}

 



function tersangka_add() {
	 
	$('#tersangka_modal').modal('show');

	// $("#form_tersangka").attr('action','<?php echo site_url("$controller/tmp_tersangka_simpan") ?>'); 

	$("#form_tersangka").attr('action','<?php echo $tersangka_add_url; ?>');
	

}

function tersangka_edit(id) {

	$("#tersangkaModal").html('EDIT DATA TERSANGKA');
	 
$('#tersangka_modal').modal('show');
$("#form_tersangka").attr('action','<?php echo site_url("$controller/tmp_tersangka_update") ?>'); 

$.ajax({
    url : '<?php echo site_url("$controller/get_lap_b_tersangka_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $('#tersangka_modal').modal('show');
       $("#modal_tersangka_judul").html('EDIT DATA TERSANGKA');
       $(".tombol").prop('value','UPDATE DATA TERSANGKA');   

       $('#form_tersangka').loadJSON(jsonData);


       $("#tersangka_jk").val(jsonData.tersangka_jk).attr('selected','selected');
      $("#tersangka_id_suku").val(jsonData.tersangka_id_suku).attr('selected','selected');
     

     $("#tersangka_residivis").val(jsonData.tersangka_residivis).attr('selected','selected');
     
     $("#tersangka_klasifikasi").val(jsonData.tersangka_klasifikasi).attr('selected','selected');


      $("#tersangka_id_agama").val(jsonData.tersangka_id_agama).attr('selected','selected');
      $("#tersangka_id_pekerjaan").val(jsonData.tersangka_id_pekerjaan).attr('selected','selected');
     
      $("#tersangka_id_provinsi").val(jsonData.tersangka_prov_id).attr('selected','selected');

      $("#tersangka_id_pendidikan").val(jsonData.tersangka_id_pendidikan).attr('selected','selected');
    
    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
      data : {id_prop : jsonData.tersangka_prov_id, id_kota : jsonData.tersangka_kota_id },
      type : 'post',
      success: function(data){
        $("#tersangka_id_kota").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
      data : { id_kota : jsonData.tersangka_kota_id, id_kec : jsonData.tersangka_kec_id },
      type : 'post',
      success: function(data){
        $("#tersangka_id_kecamatan").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
      data : { id_kec : jsonData.tersangka_kec_id, id_desa : jsonData.tersangka_id_desa  },
      type : 'post',
      success: function(data){
        $("#tersangka_id_desa").html('').append(data);
      }
    });

      
    }
  });
	

}

function tersangka_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_tersangka").attr('action'),
			data : $("#form_tersangka").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#tersangka_modal").modal('hide'); 
						$('#terlapor').DataTable().ajax.reload();						 
						$('#form_tersangka')[0].reset();
						 		
						 
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
}


function tersangka_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA TERSANGKA. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/tersangka_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		$('#terlapor').DataTable().ajax.reload();	



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}


function korban_add() {
	 

	$('#korban_modal').modal('show');
	// $("#form_korban").attr('action','<?php echo site_url("$controller/tmp_korban_simpan") ?>');
	$("#form_korban").attr('action','<?php echo  $korban_add_url; ?>');


	

}

function korban_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_korban").attr('action'),
			data : $("#form_korban").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#korban_modal").modal('hide'); 
						$('#korban').DataTable().ajax.reload();						 
						$('#form_korban')[0].reset();
						 		
						 
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
}


function korban_edit(id){


	$('#korban_modal').modal('show');
	$("#form_korban").attr('action','<?php echo site_url("$controller/tmp_korban_update") ?>'); 


	$.ajax({
    url : '<?php echo site_url("$controller/get_lap_b_korban_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_korban").modal('show');
       $("#modal_korban_judul").html('EDIT DATA KORBAN');
       $(".tombol").prop('value','UPDATE DATA KORBAN');
      

       $('#form_korban').loadJSON(jsonData);

       //$("#korban_id").val(jsonData.id);

      $("#korban_jk").val(jsonData.korban_jk).attr('selected','selected');
      $("#korban_id_agama").val(jsonData.korban_id_agama).attr('selected','selected');

      $("#korban_id_pekerjaan").val(jsonData.korban_id_pekerjaan).attr('selected','selected');

      $("#korban_id_suku").val(jsonData.korban_id_suku).attr('selected','selected');
       $("#korban_id_pendidikan").val(jsonData.korban_id_pendidikan).attr('selected','selected');

      $("#korban_residivis").val(jsonData.korban_residivis).attr('selected','selected');
      $("#korban_klasifikasi").val(jsonData.korban_klasifikasi).attr('selected','selected');





      $("#jenis_korban").val(jsonData.jenis_korban).attr('selected','selected');

		if( jsonData.jenis_korban == "bo") {
			$(".bo").hide();
			}
			else {
				$(".bo").show();
			}





      $("#korban_id_provinsi").val(jsonData.korban_prov_id).attr('selected','selected');

    
    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
      data : {id_prop : jsonData.korban_prov_id, id_kota : jsonData.korban_kota_id },
      type : 'post',
      success: function(data){
        $("#korban_id_kota").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
      data : { id_kota : jsonData.korban_kota_id, id_kec : jsonData.korban_kec_id },
      type : 'post',
      success: function(data){
        $("#korban_id_kecamatan").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
      data : { id_kec : jsonData.korban_kec_id, id_desa : jsonData.korban_id_desa  },
      type : 'post',
      success: function(data){
        $("#korban_id_desa").html('').append(data);
      }
    });

      
    }
  });
}




function korban_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA KORBAN. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/korban_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		$('#korban').DataTable().ajax.reload();	



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}






// #SAKSI SECTION 


function saksi_add() {
	 

	$('#saksi_modal').modal('show');
	// $("#form_saksi").attr('action','<?php echo site_url("$controller/tmp_saksi_simpan") ?>');
	$("#form_saksi").attr('action','<?php echo $saksi_add_url; ?>');


}

function saksi_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_saksi").attr('action'),
			data : $("#form_saksi").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#saksi_modal").modal('hide'); 
						$('#saksi').DataTable().ajax.reload();						 
						$('#form_saksi')[0].reset();
						 		
						 
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
}


function saksi_edit(id){


	$('#saksi_modal').modal('show');
	$("#form_saksi").attr('action','<?php echo site_url("$controller/tmp_saksi_update") ?>'); 


	$.ajax({
    url : '<?php echo site_url("$controller/get_lap_b_saksi_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_saksi").modal('show');
       $("#modal_saksi_judul").html('EDIT DATA saksi');
       $(".tombol").prop('value','UPDATE DATA saksi');


       $('#form_saksi').loadJSON(jsonData);

      // $("#saksi_nama").val(jsonData.saksi_nama);
      // $("#saksi_id_suku").val(jsonData.saksi_id_suku).attr('selected','selected');
      // $("#saksi_tmp_lahir").val(jsonData.saksi_tmp_lahir);
      // $("#saksi_tgl_lahir").val(jsonData.saksi_tgl_lahir);
      // $("#saksi_alamat").val(jsonData.saksi_alamat);
      // $("#saksi_id").val(jsonData.id);


	$("#saksi_jk").val(jsonData.saksi_jk).attr('selected','selected');
	$("#saksi_id_suku").val(jsonData.saksi_id_suku).attr('selected','selected');

	$("#saksi_id_agama").val(jsonData.saksi_id_agama).attr('selected','selected');

	$("#saksi_id_pekerjaan").val(jsonData.saksi_id_pekerjaan).attr('selected','selected');
	$("#saksi_id_pendidikan").val(jsonData.saksi_id_pendidikan).attr('selected','selected');


	$("#saksi_residivis").val(jsonData.saksi_residivis).attr('selected','selected');
	$("#saksi_klasifikasi").val(jsonData.saksi_klasifikasi).attr('selected','selected');



  

     $("#saksi_id_provinsi").val(jsonData.saksi_prov_id).attr('selected','selected');

    
    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
      data : {id_prop : jsonData.saksi_prov_id, id_kota : jsonData.saksi_kota_id },
      type : 'post',
      success: function(data){
        $("#saksi_id_kota").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
      data : { id_kota : jsonData.saksi_kota_id, id_kec : jsonData.saksi_kec_id },
      type : 'post',
      success: function(data){
        $("#saksi_id_kecamatan").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
      data : { id_kec : jsonData.saksi_kec_id, id_desa : jsonData.saksi_id_desa  },
      type : 'post',
      success: function(data){
        $("#saksi_id_desa").html('').append(data);
      }
    });

      
    }
  });
}




function saksi_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA KORBAN. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/saksi_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		$('#saksi').DataTable().ajax.reload();	



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}

// #BARBUK SECTION 


function barbuk_add() {
	 

	$('#barbuk_modal').modal('show');
	// $("#form_barbuk").attr('action','<?php echo site_url("$controller/tmp_barbuk_simpan") ?>');
	$("#form_barbuk").attr('action','<?php echo $barbuk_add_url ?>');



}

function pasal_add() {
	 

	$('#pasalmodal').modal('show'); 
	$("#form_pasal").attr('action','<?php echo $pasal_add_url ?>');
	$("#exampleModalLabel").html('TAMBAH PASAL');



}




function barbuk_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_barbuk").attr('action'),
			data : $("#form_barbuk").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#barbuk_modal").modal('hide'); 
						$('#barbuk').DataTable().ajax.reload();						 
						$('#form_barbuk')[0].reset();
						 		
						 
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
}





function barbuk_edit(id){


	$('#barbuk_modal').modal('show');
	$("#form_barbuk").attr('action','<?php echo site_url("$controller/tmp_barbuk_update") ?>'); 


	$.ajax({
    url : '<?php echo site_url("$controller/get_lap_b_barbuk_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_barbuk").modal('show');
       $("#modal_barbuk_judul").html('EDIT DATA BARANG BUKTI');
       $(".tombol").prop('value','UPDATE DATA BARANG BUKTI');
       
      $("#barbuk_nama").val(jsonData.barbuk_nama).attr('selected','selected');
      $("#barbuk_satuan").val(jsonData.barbuk_satuan).attr('selected','selected');
      $("#barbuk_jumlah").val(jsonData.barbuk_jumlah);
      $("#barbuk_id").val(jsonData.id);

       
      

      
    }
  });
}




function barbuk_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA BARANG BUKTI. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/barbuk_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		$('#barbuk').DataTable().ajax.reload();	



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}




function barbuk_baru_simpan(){
	$.ajax({
		url : '<?php echo site_url("lap_a/barbuk_baru_simpan") ?>',
		data : { barang_bukti : $("#barbuk_baru").val() },
		type : 'post',
		success : function(obj) {
			$("#barbuk_nama").html('').append(obj);
			$("#tr_barbuk_baru").hide();
			$("#barbuk_baru").val('');
		}

	});

}


function show_barbuk_baru(){
	$("#tr_barbuk_baru").show();
}

function barbuk_baru_batal(){
	$("#tr_barbuk_baru").hide();
}




function satuan_baru_simpan(){
	$.ajax({
		url : '<?php echo site_url("lap_a/satuan_baru_simpan") ?>',
		data : { satuan : $("#satuan_baru").val() },
		type : 'post',
		success : function(obj) {
			$("#barbuk_satuan").html('').append(obj);
			$("#tr_satuan_baru").hide();
			$("#satuan_baru").val('');
		}

	});

}

function show_satuan_baru(){
	$("#tr_satuan_baru").show();
}

function satuan_baru_batal(){
	$("#tr_satuan_baru").hide();
}



function pasal_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_pasal").attr('action'),
			data : $("#form_pasal").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#pasalmodal").modal('hide'); 
						$('#pasallap').DataTable().ajax.reload();						 
						$('#form_pasal')[0].reset();
						 		
						 
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
}



function pasal_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA PASAL. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/pasal_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		 

						$('#pasallap').DataTable().ajax.reload();						 
						 



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}


function copypelapor(){
	$("#korban_nama").val($("#pelapor_nama").val());
	$("#korban_jk").val($("#pelapor_jk").val()).attr('selected','selected');
	
	$("#korban_tmp_lahir").val($("#pelapor_nama").val());

	$("#korban_tgl_lahir").val($("#pelapor_nama").val());
	$("#korban_tmp_lahir").val($("#pelapor_nama").val());
	$("#korban_id_agama").val($("#pelapor_nama").val());
	$("#korban_id_pekerjaan").val($("#pelapor_nama").val());
	$("#korban_email").val($("#pelapor_nama").val());
	$("#korban_telpon").val($("#pelapor_nama").val());
	$("#korban_id_pendidikan").val($("#pelapor_nama").val());
	$("#korban_wn").val($("#pelapor_nama").val());
	$("#korban_nik").val($("#pelapor_nama").val());

	$("#korban_alamat").val($("#pelapor_nama").val());
	$("#korban_id_provinsi").val($("#pelapor_nama").val());
	$("#korban_id_kota").val($("#pelapor_nama").val());
	$("#korban_id_kota").val($("#pelapor_nama").val());
	$("#korban_id_kecamatan").val($("#pelapor_nama").val());
	$("#korban_id_desa").val($("#pelapor_nama").val());
	
	 
	




}

function tambah_pelapor_tersangka(){
	$('#myPleaseWait').modal('show');

	$.ajax({
		url : '<?php echo $korban_add_url; ?>',
		data : {
			korban_nama : $("#pelapor_nama").val(),
			korban_jk : $("#pelapor_jk").val(),
			korban_tgl_lahir : $("#pelapor_tgl_lahir").val(),
			korban_tmp_lahir : $("#pelapor_tmp_lahir").val(),
			korban_id_pekerjaan : $("#pelapor_id_pekerjaan").val(),
			korban_alamat : $("#pelapor_alamat").val(),
			korban_id_desa :  $("#pelapor_id_desa").val(),
			korban_id_suku :  $("#pelapor_id_suku").val(),

			korban_id_agama :  	$("#pelapor_id_agama").val(),
			korban_id_pendidikan	 :  $("#pelapor_id_pendidikan").val(), 
			jenis_korban : 'o'
		},
		type : 'post', 
		dataType : 'json',
		success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						 
						$('#korban').DataTable().ajax.reload();						 
						 
						 		
						 
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
}

function showhide_kendaraan(id){
	if(id=="131" || id=="132") {
		$(".data-kendaraan").show();
	}
	else {
		$(".data-kendaraan").hide();
	}
}

function query_kendaraan(){
	nopol = $("#kendaraan_nopol").val();
	$.ajax({
		url : '<?php echo site_url("service/get_data_kendaraan") ?>/'+nopol,
		dataType : 'json',
		success : function(obj) {
			console.log(obj);
			if(obj.error == true ) {
				alert(obj.message);
				$("#kendaraan_no_bpkb").val('');           
				$("#kendaraan_no_rangka").val('');     
				$("#kendaraan_no_mesin").val('');       
				$("#kendaraan_pemilik").val('');           
				$("#kendaraan_pemilik_alamat").val('');    
				$("#kendaraan_merk").val('');              
				$("#kendaraan_model").val('');             
				$("#kendaraan_warna").val('');        
				$("#kendaraan_tahun").val('');   
				$("#kendaraan_jumlah_roda").val('');   

				       
			} 
			else {
				$("#kendaraan_no_bpkb").val(obj.data.NO_BPKB);
				$("#kendaraan_no_rangka").val(obj.data.NO_RANGKA);
				$("#kendaraan_pemilik").val(obj.data.NAMA_PEMILIK);
				$("#kendaraan_pemilik_alamat").val(obj.data.ALAMAT_PEMILIK);
				$("#kendaraan_merk").val(obj.data.MERK_NAMA);
				$("#kendaraan_model").val(obj.data.MODEL_NAMA);
				$("#kendaraan_warna").val(obj.data.WARNA_NAMA);
				$("#kendaraan_tahun").val(obj.data.THN_BUAT); 
				$("#kendaraan_jumlah_roda").val(obj.data.JML_RODA);   
				$("#kendaraan_no_mesin").val(obj.data.NO_MESIN);                
			}


		}
	}); 
	return false;
}

</script>