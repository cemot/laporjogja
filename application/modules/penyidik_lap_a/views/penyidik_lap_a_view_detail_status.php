<h3> STATUS PENYELESAIAN KASUS </h3>

<hr /> 
<form id="formpenyelesaian" method="post" action="<?php echo site_url("$this->controller/update_penyelesaian/$lap_a_id") ?>">
  <div class="form-group">
    <label for="penyelesaian">Penyelesaian</label>
    <?php 
      $arr = $this->cm->arr_penyelesaian;

      echo form_dropdown("penyelesaian",$arr,'','id="penyelesaian" class="form-control"');
    ?>




  </div>
  <div class="form-group" id="divalasan" style="display: none;">
    <label for="alasan">Dengan Alasan</label>
    <?php 
      $arr_alasan =  $this->cm->arr_alasan;

      echo form_dropdown("alasan",$arr_alasan,'','id="alasan" class="form-control"');
    ?>

  </div>
  
  <button type="submit" class="btn btn-success">UPDATE PENYELESAIAN KASUS</button>
  

</form>