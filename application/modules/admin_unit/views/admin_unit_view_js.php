<?php 
$userdata = $this->session->userdata("userdata");
?>
<script>
var daft_id = false;



$(document).ready(function(){

  



		 var dt = $("#datagrid").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": true } ],
				"processing": true,
		        "serverSide": true,
		        "ajax": '<?php echo site_url("$controller/get_data") ?>'
		 	});

		 
		 $("#datagrid_filter").css("display","none");  
			$("#btn_cari").click(function(){


				 

			 
				 
				 var nama = $("#txt_cari").val();
				 
			
				 

				 dt.columns(1).search(nama)
				 .columns(2).search($("#search_jenis").val())
				 .columns(3).search($("#search_id_kesatuan").val())			 
				 .columns(4).search($("#search_id_subdit").val())		
				 .draw();

				});
			$("#btn_reset").click(function(){

				$("#txt_cari").val('');
				$("#txt_level").val('x').attr('selected','selected');
				$("#search_jenis").val('x').attr('selected','selected');
				$("#search_id_kesatuan").val('x').attr('selected','selected');


				$("#btn_cari").click();
			});
	

	$("#jenis").change(function(){
		get_kesatuan($(this).val(),'x',"#id_kesatuan");
	});

	
	$("#search_jenis").change(function(){
		get_kesatuan_cari($(this).val(),"#search_id_kesatuan");
	});


	$("#id_kesatuan").change(function(){
		get_subdit($(this).val(),'x',"#id_subdit");
	});

	$("#search_id_kesatuan").change(function(){
		get_subdit_cari($(this).val(),"#search_id_subdit");
	});




});


function hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA UNIT/PANIT. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA UNIT/PANIT',
            draggable: true,
            buttons : [
              {
                label : 'YA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/hapus") ?>',
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

                  		$('#datagrid').DataTable().ajax.reload();		
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
 		 
	  

function cari(){
	var dtx = $("#leasing").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": true } ],
				"processing": true,
		        "serverSide": true,
		        "ajax": '<?php echo site_url("$controller/get_data") ?>'
		 	});

	 dtx.columns(1).search($("txt_cari").val()).draw();
				 // .column(4).search(tanggal_awal)
				 // .column(6).search(tanggal_akhir)
				 // .column(7).search(status)
				 


}

function baru(){
	$("#pengguna_modal").modal("show");
	$("#formulir").attr('action','<?php echo site_url("$controller/simpan") ?>');
	$("#titleModal").html('TAMBAH DATA KESATUAN ');
}

function edit(id){

$("#pengguna_modal").modal("show");
$("#formulir").attr('action','<?php echo site_url("$controller/update") ?>');	
$("#titleModal").html('EDIT DATA KESATUAN');

	$.ajax({
		url : '<?php echo site_url("$controller/get_json_detail") ?>/'+id, 
		dataType : 'json',
		success : function(obj) {
			console.log(obj);
			// $("#id_kesatuan").val(obj.id_kesatuan);
			// $("#id_subdit").val(obj.id_subdit);
			// $("#subdit").val(obj.subdit);
			// $("#jenis").val(obj.jenis);
			$("#unit").val(obj.unit);
			$("#id_unit").val(obj.id_unit);
			$("#jenis").val(obj.jenis).attr('selected','selected');
			
			get_kesatuan(obj.jenis, obj.id_kesatuan, "#id_kesatuan");
			get_subdit(obj.id_kesatuan,obj.id_subdit,'#id_subdit');

			 


		}

	});
}




function get_subdit_cari(jenis,target){
		$.ajax({
			url : '<?php echo site_url("$this->controller/get_subdit_cari") ?>/'+jenis,
			success : function(htmldata) {
				$(target).html(htmldata);
			}

		});
}

function get_subdit(a,b,target){
		$.ajax({
			url : '<?php echo site_url("$this->controller/get_subdit") ?>/'+a+'/'+b,
			success : function(htmldata) {
				$(target).html(htmldata);
			}

		});
}


function get_kesatuan(a,b,target){
		$.ajax({
			url : '<?php echo site_url("$this->controller/get_kesatuan") ?>/'+a+'/'+b,
			success : function(htmldata) {
				$(target).html(htmldata);
			}

		});
}


function get_kesatuan_cari(jenis,target){
		$.ajax({
			url : '<?php echo site_url("$this->controller/get_kesatuan_cari") ?>/'+jenis,
			success : function(htmldata) {
				$(target).html(htmldata);
			}

		});
}


function simpan(){
	$('#myPleaseWait').modal('show');
	$.ajax({
		url : $("#formulir").prop('action'),
		data : $("#formulir").serialize(), 
		method : 'post',
		dataType : 'json',
		success : function(obj) {
			$('#myPleaseWait').modal('hide');

			if(obj.error==false){
					 	 
			 	 BootstrapDialog.alert({
	                type: BootstrapDialog.TYPE_PRIMARY,
	                title: 'Informasi',
	                message: obj.message,
	                 
	            });   
				 
				$("#pengguna_modal").modal('hide'); 
				$('#datagrid').DataTable().ajax.reload();	
				if(obj.mode == "I") {
					$("#formulir")[0].reset();
				}		
				 
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

</script>