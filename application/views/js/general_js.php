<script type="text/javascript">
	

function get_kota(id,target,dropdown) {
	console.log('id privinsi' + $(id).val() );
 		$.ajax({
 			url:'<?php echo site_url("general/get_tiger_kota"); ?>/'+$(id).val()+'/'+dropdown,
 			success: function(data){
 				$(target).html('').append(data);
 			}
 		});
}


function get_kecamatan(id,target,dropdown){
 		console.log('id kabupaten' + $(id).val() );
 		$.ajax({
 			url:'<?php echo site_url("general/get_tiger_kecamatan"); ?>/'+$(id).val()+'/'+dropdown,
 			success: function(data){
 				$(target).html('').append(data);
 			}
 		});
 	}


 	function get_desa(id,target,dropdown){
 		console.log('id kecamatan' + $(id).val() );
 		$.ajax({
 			url:'<?php echo site_url("general/get_tiger_desa"); ?>/'+$(id).val()+'/'+dropdown,
 			success: function(data){
 				$(target).html('').append(data);
 			}
 		});
 	}

function tutup(id){
	$(id).modal('hide');
}



function get_dropdown_kota_by_prop(v_id_prop,v_id_kota,target) {
	$.ajax({
 			url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
 			data : {id_prop : v_id_prop, id_kota : v_id_kota },
 			type : 'post',
 			success: function(data){
 				$(target).html('').append(data);
 			}
 		});
}



function get_dropdown_kec_by_kota(v_id_prop,v_id_kota,target) {
	$.ajax({
 			url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
 			data : {id_prop : v_id_prop, id_kota : v_id_kota },
 			type : 'post',
 			success: function(data){
 				$(target).html('').append(data);
 			}
 		});
}


function get_data_polres(id,target,dropdown){
 		console.log('id kabupaten' + $(id).val() );
 		$.ajax({
 			url:'<?php echo site_url("general/get_data_polres"); ?>/'+$(id).val()+'/'+dropdown,
 			success: function(data){
 				$(target).html('').append(data);
 			}
 		});
 	}



function get_kelompok(id,target,dropdown) {
	$.ajax({
 			url:'<?php echo site_url("general/get_kelompok"); ?>/'+$(id).val()+'/'+dropdown,
 			success: function(data){
 				$(target).html('').append(data);
 			}
 	});
}

function get_data_kejahatan(id,target,dropdown) {
	$.ajax({
 			url:'<?php echo site_url("general/get_data_kejahatan"); ?>/'+$(id).val()+'/'+dropdown,
 			success: function(data){
 				$(target).html('').append(data);
 			}
 	});
}




function hapus_dokumen(id) {
 

    
BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DOKUMEN PERKEMBANGAN KASUS. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DOKUMEN',
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
                    url : '<?php echo site_url("$controller/perkembangan_hapus_dokumen") ?>',
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

                      $('#grid_perkembangan').DataTable().ajax.reload(); 
                      
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


</script>