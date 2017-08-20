<h4> AKSES MONITORING KASUS  </h4>

<hr /> 

<div class="row">
<div class="col-md-4">
</div>
<div class="col-md-4">
<form id="form_monitor" method="post" action="<?php echo site_url("$this->controller/set_monitor/$lap_b_id") ?>">


  <div class="form-group">
    <label for="mon_user">User</label>

    <input type="text" name="mon_user" class="form-control" value="<?php echo isset($mon_user)?$mon_user:""; ?>" />
  </div>
  <div class="form-group" >
    <label for="alasan">Password</label>
    <input type="text" name="mon_pass" class="form-control"  value="<?php echo isset($mon_pass)?$mon_pass:""; ?>" />

  </div>
  
  <button type="submit" class="btn btn-success">SIMPAN AKSES</button>
  

</form>

</div>
</div>