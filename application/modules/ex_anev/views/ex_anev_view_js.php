<?php 
$userdata = $this->session->userdata("userdata");
?>
<script>
 



$(document).ready(function(){

// $('#builder-widgets').on('afterCreateRuleInput.queryBuilder', function(e, rule) {
//   if (rule.filter.plugin == 'selectize') {
//     rule.$el.find('.rule-value-container').css('min-width', '200px')
//       .find('.selectize-control').removeClass('form-control');
//   }
// });


// $('#builder-widgets').on('afterCreateRuleInput.queryBuilder', function(e, rule) {
//     if (rule.filter.id === 'date') {
//       var $input = rule.$el.find('.rule-value-container [name*=_value_]');
//       $input.on('dp.change', function() {
//           $input.trigger('change');
//       });
//     }
// });


var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
} 
if(mm<10){
    mm='0'+mm;
} 
var tanggal = dd+'-'+mm+'-'+yyyy;


 
// var rules_basic = {
//   condition: 'OR',
//   rules: [{
//     id: 'kp_awal',
//     operator: 'equal',
//     value: tanggal
//   } ]
// };



  var rules_basic = "";
 

$('#builder-basic').queryBuilder({
  plugins: ['bt-tooltip-errors'],
  
  filters: <?php echo $rules; ?> 

  ,

  rules: rules_basic
});


$('#builder-basic2').queryBuilder({
  plugins: ['bt-tooltip-errors'],
  
  filters: <?php echo $rules; ?> 

  ,

  rules: rules_basic
});


// first secction 
$('#btn-reset').on('click', function() {
  $('#builder-basic').queryBuilder('reset');
  $('#builder-basic2').queryBuilder('reset');
});

$('#btn-set').on('click', function() {
  $('#builder-basic').queryBuilder('setRules', rules_basic);
});

/*
$('#btn-get').on('click', function() {
  var result = $('#builder-basic').queryBuilder('getRules');

  //console.log(result);
  
  if (!$.isEmptyObject(result)) {
    //alert(JSON.stringify(result, null, 2));
    $.ajax({
    	url : '<?php echo site_url("$this->controller/cari") ?>',
    	type : 'post',
    	data : {json_data : result}, 
    	success : function (obj){
    		//console(obj)
    		$("#hasil_pencarian").html(obj);
    	}
    });
  }
  else {
  	alert('Buat kriteria pencarian')
  }
});  */

// second section 



$('#btn-reset2').on('click', function() {
  $('#builder-basic2').queryBuilder('reset');
});

$('#btn-set2').on('click', function() {
  $('#builder-basic2').queryBuilder('setRules', rules_basic);
});
/*
$('#btn-get2').on('click', function() {
  var result = $('#builder-basic2').queryBuilder('getRules');

  //console.log(result);
  
  if (!$.isEmptyObject(result)) {
    //alert(JSON.stringify(result, null, 2));
    $.ajax({
      url : '<?php echo site_url("$this->controller/cari2") ?>',
      type : 'post',
      data : {json_data : result}, 
      success : function (obj){
        //console(obj)
        $("#hasil_pencarian2").html(obj);
      }
    });
  }
  else {
    alert('Buat kriteria pencarian')
  }
});
*/

$("#query").on('click',function(){


   $('#myPleaseWait').modal('show');
   $("#resultBox").html('');

    var result = $('#builder-basic').queryBuilder('getRules');
    var result2 = $('#builder-basic2').queryBuilder('getRules');

    if(!$.isEmptyObject(result,null,2)){

      $.ajax({
      url : '<?php echo site_url("$this->controller/cari") ?>',
      type : 'post',
      data : {json_data : result, json_data2 : result2}, 
      success : function (obj){
        //console(obj)
        $('#myPleaseWait').modal('hide');
        $("#resultBox").html(obj);
      }
    });

    }

    /*if(!$.isEmptyObject(result2,null,2)){

      $.ajax({
      url : '<?php echo site_url("$this->controller/cari") ?>',
      type : 'post',
      data : {json_data : result2}, 
      success : function (obj){
        //console(obj)
        $("#hasil_pencarian2").html(obj);
      }
    });

    }

    else {
      alert('Buat kriteria pencarian')
    } */



});

	
});
 
</script>