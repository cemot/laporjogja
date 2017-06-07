<script src="<?php echo base_url("assets") ?>/js/jquery.form.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script> 
</script>
<script type="text/javascript">




$(document).ready(function(){



  $mce = tinymce.init({
  selector: '#isi',
  height: 500,
  menubar: false,

  setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    },
  
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],  
  toolbar: 'undo redo | table |  insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});


   

$(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });


		 var dt = $("#grid_penyidik").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": true } ],
				"processing": true,
		        "serverSide": true,
		        "ajax": '<?php echo site_url("$controller/get_data_penyidik/$lap_b_id") ?>'
		 	});

		 
		// $("#grid_penyidik").css("display","none");  
		 
		var dt_kembang = $("#grid_perkembangan").DataTable(
      {
        // "order": [[ 0, "desc" ]],
        // "iDisplayLength": 50,
        "columnDefs": [ { "targets": 0, "orderable": false } ],
        "processing": true,
            "serverSide": true,
            "ajax": '<?php echo site_url("$controller/get_data_perkembangan/$lap_b_id") ?>'
      });
				


$("#lidik").change(function(){

    $.ajax({
      url : '<?php echo site_url("general/get_tahap") ?>/'+$(this).val(),
      success : function(htmlData) {
          $("#id_tahap").html(htmlData);
          }

    });


});




$("#penyelesaian").change(function(){
     if($(this).val()=="p21"){
          $("#divalasan").hide();
      }
      else {
        $("#divalasan").show();
      }
});

  
$("#formpenyelesaian").submit(function(){
    //alert('test'); 
    update_penyelesaian();
    return false;
    
});

$("#form_monitor").submit(function(){
    //alert('test'); 
    
                    $.ajax({
                    url : $("#form_monitor").prop('action'),
                    type : 'post',
                    data :  $("#form_monitor").serialize(),
                    dataType : 'json',
                    success : function(obj) {
                      $('#myPleaseWait').modal('hide'); 
                      if(obj.error==false) {
                          BootstrapDialog.alert({
                              type: BootstrapDialog.TYPE_PRIMARY,
                              title: 'Informasi',
                              message: obj.message,
                               
                          });   

                      // $('#grid_perkembangan').DataTable().ajax.reload(); 
                      
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

    return false;
    
});


// get detail 
$.ajax({
  url : '<?php echo site_url("$this->controller/get_lap_b_detail/$lap_b_id") ?>',
  dataType : 'json',
  success : function(retdata) {
    $("#penyelesaian").val(retdata.penyelesaian).attr('selected','selected');
    if(retdata.penyelesaian=="p21"){
      $("#divalasan").hide();
    }
    else {
      $("#divalasan").show();
    }
  }
});

// submit formulir 

// $("#formulir_perkembangan").submit(function(){


// });				 
 
$("#id_template").change(function(){

  if($(this).val() != 'x') {

    $.ajax({
          url : '<?php echo site_url("$this->controller/get_template") ?>',
          data : {id : $(this).val() },
          dataType : 'json',
          type : 'post',
          success : function(jsonData) {
            tinyMCE.activeEditor.setContent(jsonData.isi);
          }
    });

  }

  // alert('test');

});


/// save template 
$("#tombol").click(function(){

    if($("#id_template").val() == 'x') {  // baru 


      // $('#myModal').modal('show');
      $("#modal_nama").modal('show');
      // $('#myModal').modal('show');


    }
    else { // update template yang ada 

        v_isi = tinymce.get('isi').getContent();
        v_id =  $("#id_template").val();

        $.ajax({
            url : '<?php  echo site_url("$this->controller/updatetemplate") ?>',
            data : {id : v_id, isi : v_isi }, 
            type : 'post',
            dataType : 'json' , 
            
            success : function(jsonData) {

                   if(jsonData.error==false) {
                  BootstrapDialog.alert({
                          type: BootstrapDialog.TYPE_PRIMARY,
                          title: 'Informasi',
                          message: jsonData.message,
                           
                      });   

                  // $('#grid_perkembangan').DataTable().ajax.reload(); 
                                
                  }
                  else {
                    BootstrapDialog.alert({
                        type: BootstrapDialog.TYPE_DANGER,
                        title: 'Error',
                        message: jsonData.message,
                         
                    }); 
                  }

            }
        });
    }

    return false;

});



$("#simpantemplate").click(function(){

   // v_isi = tinymce.get('#isi').getContent();

   v_isi = tinymce.get('isi').getContent();
   v_nama = $("#nama_template").val();

   $("#modal_nama").modal('hide');

   // console.log(v_isi); 
   // console.log(v_isi2);

   $.ajax({
      url : '<?php echo site_url("$this->controller/simpantemplate") ?>',
      data : {nama : v_nama, isi : v_isi},
      dataType : 'json',
      type : 'post', 
      success : function(jsonData){
          console.log(jsonData); 


          if(jsonData.error==false) {
                      BootstrapDialog.alert({
                              type: BootstrapDialog.TYPE_PRIMARY,
                              title: 'Informasi',
                              message: jsonData.message,
                               
                          });   

                      // $('#grid_perkembangan').DataTable().ajax.reload(); 
                      $("#id_template").html('').html(jsonData.templateList);
                      
          }
          else {
            BootstrapDialog.alert({
                type: BootstrapDialog.TYPE_DANGER,
                title: 'Error',
                message: jsonData.message,
                 
            }); 
          }

      }

   });

   // alert( v_isi ); 
   return false;

});

	
});



function update_penyelesaian(){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGUPDATE PENYELESAIAN LAPORAN INI. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI UPDATE PENYELESAIAN LAPORAN ',
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
                    url : $("#formpenyelesaian").prop('action'),
                    type : 'post',
                    data :  $("#formpenyelesaian").serialize(),
                    dataType : 'json',
                    success : function(obj) {
                      $('#myPleaseWait').modal('hide'); 
                      if(obj.error==false) {
                          BootstrapDialog.alert({
                              type: BootstrapDialog.TYPE_PRIMARY,
                              title: 'Informasi',
                              message: obj.message,
                               
                          });   

                      // $('#grid_perkembangan').DataTable().ajax.reload(); 
                      
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



function perkembangan_baru() {
   
  $("#perkembangan_modal").modal("show");
  $("#formulir_perkembangan").attr('action','<?php echo site_url("$controller/perkembangan_simpan/") ?>');
  $("#titleModal").html('TAMBAH DATA PERKEMBANGAN KASUS');
}


function perkembangan_edit(id) {
   
  $("#perkembangan_modal").modal("show");
  $("#formulir_perkembangan").attr('action','<?php echo site_url("$controller/perkembangan_update/") ?>/'+id);
  $("#titleModal").html('EDIT DATA PERKEMBANGAN KASUS');

  $.ajax({
    url : '<?php echo site_url("$controller/get_perkembangan_detail_json") ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
      
      $("#proses_penyidikan").val(jsonData.proses_penyidikan).attr('selected','selected');
      $("#lidik").val(jsonData.lidik).attr('selected','selected');

      $("#no_dokumen").val(jsonData.no_dokumen);
      $("#tanggal").val(jsonData.tanggal);
      $("#keterangan").val(jsonData.keterangan);
      $("#id").val(jsonData.id);
      $("#lap_b_id").val(jsonData.lap_b_id);

      $("#id_pn").val(jsonData.id_pn);
      $("#id_lapas").val(jsonData.id_lapas);
      $("#no_urut").val(jsonData.no_urut);
     //  $("#isi").val(jsonData.isi);

     if(jsonData.isi === null ) {
        jsonData.isi = ""; 
     }

     // if(jsonData == "")
     tinyMCE.activeEditor.setContent('');
     if( jsonData.isi != ''   )
      { 
      tinyMCE.activeEditor.setContent(jsonData.isi);
      } 
      //$("#nomor_dokumen").val(jsonData.nomor_dokumen);

      $.ajax({
        url:'<?php echo site_url("general/get_dropdown_tahap"); ?>/',
        data : { lidik : jsonData.lidik, 
                id_tahap : jsonData.id_tahap },
        type : 'post',
        success: function(data){
          $("#id_tahap").html('').append(data);
        }
      });
      
    }

  });


}




function perkembangan_simpan(){

// $("#formulir_perkembangan").submit();


$('#myPleaseWait').modal('show');
  $("#formulir_perkembangan").ajaxSubmit({
     dataType : 'json',
     //data : $(this).serialize(), 
    // type : 'post', 
     success : function(obj){


        $('#myPleaseWait').modal('hide');

        if(obj.error==false){
               
           BootstrapDialog.alert({
                    type: BootstrapDialog.TYPE_PRIMARY,
                    title: 'Informasi',
                    message: obj.message,
                     
                });   
           
          
          $('#grid_perkembangan').DataTable().ajax.reload(); 
          $("#perkembangan_modal").modal('hide'); 
         
           
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


function perkembangan_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA PENYIDIK. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA PENYIDIK',
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
                  	url : '<?php echo site_url("$controller/perkembangan_hapus") ?>',
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