 
<link href="<?php echo base_url("assets") ?>/css/query-builder.default.min.css" rel="stylesheet">
<script src="<?php echo base_url("assets") ?>/jQuery.extendext-master/jQuery.extendext.min.js"></script>
<script src="<?php echo base_url("assets") ?>/doT-master/doT.min.js"></script> 
<script src="<?php echo base_url("assets") ?>/js/query-builder.min.js"></script>
<?php $this->dontPopper = true; ?>

<div class="row">
  <div id="salah" class="col-lg-12" style="display:none">
            <div class="alert alert-danger" role="alert" id="message">
            	
            </div>
        </div>
    </div>
    
  <div class="row">
  <div id="benar" class="col-lg-12" style="display:none">
            <div class="alert alert-success" role="alert" id="message2">
            	
            </div>
        </div>
    </div> 
 


 

<div class="row">
<div class="col-md-6">
 <div id="builder-basic"></div>
      <!-- <div class="btn-group">
        <button id="btn-reset" class="btn btn-warning reset" data-target="basic">Reset</button>
        <button id="btn-get" class="btn btn-primary parse-json" data-target="basic">CARI</button>
      </div> -->

</div>  


<div class="col-md-6">
 <div id="builder-basic2"></div>
     <!--  <div class="btn-group">
        <button id="btn-reset2" class="btn btn-warning reset" data-target="basic">Reset</button>
        <button id="btn-get2" class="btn btn-primary parse-json" data-target="basic">CARI</button>
      </div> -->

</div>  
</div>  

<!-- <div class="row">
<div class="col-md-12">
<hr />
<br />
</div>
</div>     --> 
<div class="row">
<div class="col-md-12">
<div class="btn-group">
<button id="query" class="btn btn-primary">QUERY ANEV </button>
 <button id="btn-reset" class="btn btn-warning reset" data-target="basic">RESET PENCARIAN ANEV</button>
</div>
</div>
</div>


 
<div class="row">
<div class="col-md-12" id="resultBox">
  

</div>
</div>



<div class="row">
<div class="col-md-6" id="hasil_pencarian">
</div>

<div class="col-md-6" id="hasil_pencarian2">
</div>
</div>
 





<?php $this->load->view($controller."_view_js") ?>
