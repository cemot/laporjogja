<script type="text/javascript">
   $(document).ready(function(){
    $(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });


    $("#txt_polres").hide();
    $("#txt_polsek").hide();

    $("#jenis").change(function(){

      v_jenis = $(this).val();
        if( v_jenis == "polres") {
            $("#txt_polsek").hide();
            $("#txt_polres").show();
        }
        else if ( v_jenis == "polsek" ) {
            $("#txt_polsek").show();
            $("#txt_polres").show();
        }
        else {
            $("#txt_polsek").hide();
            $("#txt_polres").hide();
        }

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