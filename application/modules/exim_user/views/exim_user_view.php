<style type="text/css">
  

  .col-centered{
    float: none;
    margin: 0 auto;
}


.col-center-block {
    float: none;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style> 

<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">
 


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
 


 

<div class="row" style="margin-top: 50px;">
<div class="col-md-4"> </div>
<div class="col-md-4">
  
       



        <a href="<?php echo site_url("$this->controller/export_data_user") ?>" id="btn-reset" class="btn btn-primary col-center-block" data-target="basic"><i class="fa fa-download" aria-hidden="true"></i> 
DOWNLOAD DATA USER </a>
       



 

</div>  
<div class="col-md-4"> </div>
</div>  

<div class="row">
<div class="col-md-12">
<hr />
<br />
</div>
</div>     

<div class="row">
<div class="col-md-12" id="hasil_pencarian">
</div>
</div>

 


 
 