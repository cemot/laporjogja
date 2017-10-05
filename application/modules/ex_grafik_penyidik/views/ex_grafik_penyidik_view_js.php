<script type="text/javascript">
  $(document).ready(function() {





$(".ds2").select2({
  placeholder: "Pilih "
});


$("#search_polres").hide();
$("#search_polsek").hide();


$("#jenis").change(function(){
  if( ($(this).val()=="polda") || (  $(this).val()=="x" )   ) {
    $("#search_polres").hide();
    $("#search_polsek").hide();

      }
  else if($(this).val()=="polres" || $(this).val()=="polresall") {
    $("#search_polres").show();
    $("#search_polsek").hide();
  }
  else {
    $("#search_polres").show();
    $("#search_polsek").show();
  }


  if($(this).val()=="polda"||$(this).val()=="x") {
      var jenis = "polda";
  }
  else {
      var jenis = "polsekpolres";
  }

  $.ajax({
    url : '<?php echo site_url("general/get_fungsi_terkait") ?>/'+jenis,
    success : function(htmldata) {
       $("#id_fungsi").html(htmldata);
    }
  });


});



   $("#frmcari").submit(function(){
        //alert('hello');
        //$("#Pleaewait")
        $('#myPleaseWait').modal('show'); 
        $.ajax({
            url : '<?php echo site_url("$this->controller/get_grafik/$url") ?>',
            data : $(this).serialize(),
            type : 'post',
            success : function(hasil){
        $('#myPleaseWait').modal('hide'); 
                    $("#hasil").html(hasil);
                }
            
        });

        return false;
  });





});


function detailkasus(id) {
  // alert('tampilakn');

  $.ajax({
      url : '<?php echo site_url("$this->controller/get_kasus_per_user") ?>/'+id,
      success : function(htmldata) {
        $("#datakasus").html(htmldata);

        $('#myModal').modal('show');

      }
  });





}


</script>