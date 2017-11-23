<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

 <style type="text/css">
    .dataTables_filter {
      display: none;
    }

.datepicker{z-index:9999 !important}


 </style>

<a class="btn btn-danger" href="<?php echo site_url("$controller") ?>"><span class="glyphicon glyphicon-arrow-left"></span></i> Kembali </a>
<br />
<br />
<hr />


<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item"><a class="nav-link active" href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail</a></li>

    

    <li class="nav-item"><a class="nav-link" href="#tersangka" aria-controls="tersangka" role="tab" data-toggle="tab">Tersangka</a></li>

     <li class="nav-item"><a class="nav-link" href="#saksi" aria-controls="saksi" role="tab" data-toggle="tab">Saksi</a></li>

     <li class="nav-item"><a class="nav-link" href="#korban" aria-controls="korban" role="tab" data-toggle="tab">Korban</a></li>

      <li class="nav-item"><a class="nav-link" href="#barangbukti" aria-controls="barangbukti" role="tab" data-toggle="tab">Barang bukti</a></li>

      <li class="nav-item"><a class="nav-link" href="#penyidik" aria-controls="penyidik" role="tab" data-toggle="tab">Penyidik</a></li>
    

     <li class="nav-item"><a class="nav-link" href="#perkembagan" aria-controls="perkembagan" role="tab" data-toggle="tab">Perkembangan kasus</a></li>

     <li class="nav-item"><a class="nav-link" href="#status" aria-controls="status" role="tab" data-toggle="tab">Status Kasus</a>
     </li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="detail"> 
     

    
     <?php $this->load->view($this->controller."_view_detail_detail"); ?>
    </div>  
     
    <div role="tabpanel" class="tab-pane" id="tersangka">
    
    <?php $this->load->view($this->controller."_view_detail_tersangka"); ?>
       

    </div>

    <div role="tabpanel" class="tab-pane" id="saksi">

    <?php $this->load->view($this->controller."_view_detail_saksi"); ?>
         

    </div>

    <div role="tabpanel" class="tab-pane" id="korban">
      <?php $this->load->view($this->controller."_view_detail_korban"); ?>

    </div>

    <div role="tabpanel" class="tab-pane" id="barangbukti">

    <?php $this->load->view($this->controller."_view_detail_barbuk"); ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="penyidik">

    <?php $this->load->view($this->controller."_view_detail_penyidik"); ?>  

    </div>
    
    <div role="tabpanel" class="tab-pane" id="perkembagan">
    <?php $this->load->view($this->controller."_view_detail_perkembangan"); ?>  
    </div>

     <div role="tabpanel" class="tab-pane" id="status">
    <?php $this->load->view($this->controller."_view_detail_status"); ?>  
     
    </div>

  </div>

</div>
 





<?php  //$this->load->view($controller."_view_detail_js") ?>
 <?php //$this->load->view("js/general_js") ?>

