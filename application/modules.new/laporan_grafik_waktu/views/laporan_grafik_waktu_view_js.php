<script type="text/javascript">
   $(document).ready(function(){
   

   // $('<p>').appendTo('#sleman').text('SELEMAN').css({position:'absolute',
   //                                               top:'100px',
   //                                               left:'70px'});
// begin of grahic 



// end of graphic 






    $(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });
   
 
 

$(".ds2").select2({
  placeholder: "Pilih "
});




// var defaultDipTooltip = 'I know you want the dip. But it\'s loaded with saturated fat, just skip it '
//         +'and enjoy as many delicious, crisp vegetables as you can eat.';

//     var carrotTooltip = 'Carrots?! I Love Carrots!';

    





 


    $("#harian").hide();
    $("#periodik").hide();
    $("#bulanan").hide();

    $("#jenis").change(function(){

      v_jenis = $(this).val();
        if( v_jenis == "harian") {
            $("#harian").show();
            $("#periodik").hide();
            $("#bulanan").hide();
        }
        else if ( v_jenis == "periodik" ) {
            $("#harian").hide();
            $("#periodik").show();
            $("#bulanan").hide();
        }
        else if ( v_jenis == "bulanan" ) {
            $("#harian").hide();
            $("#periodik").hide();
            $("#bulanan").show();
        }
        else {
            $("#harian").hide();
            $("#periodik").hide();
            $("#bulanan").hide();
        }

    });

});






function tampildata(){

     
  //$('#myPleaseWait').modal('show');

  $.ajax({
      url : '<?php echo site_url("$this->controller/get_laporan") ?>',
      data : $("#frmlaporan").serialize(),
      type : 'post', 
      // dataType : 'json',
      success : function(obj) {  
      
      //$('#myPleaseWait').modal('hide');
      $("#hasil").show();
      $("#hasil").html(obj);
      
      }
    });
 //alert('whatadaa');
  return false;
   
}

 

 </script>