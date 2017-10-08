<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

<style>

</style>


<div class="row" style="margin-bottom: 10px;">

<div class="col-md-1">
         
        <a href="javascript:baru();" class="btn btn-success"><span class="glyphicon glyphicon-add"></span>Tambah Baru </a>
    </div>
</div>


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

<div class="row" style="margin-bottom:20px;">


<div class="col-md-2">
     <?php 
                 $arr = array("x"=>"= SEMUA =","polda"=>"POLDA","polrespolsek"=>"POLRES/POLSEK");
                 echo form_dropdown("search_jenis",$arr,'','id="search_jenis" class="form-control"');
              ?>
</div>
<div class="col-md-2">
   
 <?php 
                  echo form_dropdown("search_id_kesatuan",array(),'','id="search_id_kesatuan" class="form-control"'); 
                  ?>
</div>

<div class="col-md-2">
   
 <?php 
                  echo form_dropdown("search_id_subdit",array(),'','id="search_id_subdit" class="form-control"'); 
?>
</div>

<div class="col-md-3">
     <input id="txt_cari" type="text" Placeholder="Cari Subdit/Unit" class="form-control"   />
</div>

<div class="col-md-1">
 <a id="btn_cari"  href="#" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>Cari </a>
</div>
<div class="col-md-1">
 <a id="btn_reset"  href="#" class="btn btn-danger"><span class="glyphicon glyphicon-reset"></span>Reset </a>
</div>
 <!--     
            <span id="btn_cari" class="input-group-addon btn" >
            <span class="glyphicon glyphicon-search"></span> Cari</span>
            <span id="btn_reset" class="input-group-addon btn" >
            <span class="glyphicon glyphicon-ban-circle"></span> Reset</span>
        </div> -->



<!--        <div class="col-md-12">

    
        
        <div class="col-md-12"  style="padding-left: 0px; padding-right: 2px;">
             <input id="txt_cari" type="text" Placeholder="Cari nama" class="form-control"   /></div>

         <div class="input-group">  
            <span id="btn_cari" class="input-group-addon btn" >
            <span class="glyphicon glyphicon-search"></span> Cari</span>
            <span id="btn_reset" class="input-group-addon btn" >
            <span class="glyphicon glyphicon-ban-circle"></span> Reset</span>
        </div>
        </div>
    <div class="col-md-2">
         
        <a href="javascript:baru();" class="btn btn-success"><span class="glyphicon glyphicon-add"></span>Tambah Baru </a>
    </div> -->
</div>
 

<!-- 
            <?php 
                 $arr = array("x"=>"==PILIH JENIS ==","polda"=>"POLDA","polrespolsek"=>"POLRES/POLSEK");
                 echo form_dropdown("jenis",$arr,'','id="jenis" class="form-control"');
              ?>
 -->

<div class="row">
<div class="col-md-12">
 
  <div class='right-button-margin'> 
 
<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="datagrid" role="grid">
<thead>
	<tr style="background-color:#CCC">
       <th  >UNIT/PANIT</th>
        <th  >SUBDIT/UNIT</th>
        <th  >DIREKTORAT/SATUAN</th>
        <th  >TINGKAT</th>
         
        <th  >#</th>
    </tr>
	
</thead>
</table>

</div>    
     





<?php 
$this->load->view($controller."_view_form"); 
$this->load->view($controller."_view_js"); 
?>
