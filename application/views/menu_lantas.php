<?php 
$userdata = $_SESSION['userdata'];
?>

<nav class="sidebar-nav">
    <ul class="nav in side-menu">
        
        <li>
            <a href="<?php echo site_url("index_lantas") ?>" class="ripple">
                <i class="list-icon material-icons">home</i>
                <span class="hide-menu">Depan</span>
            </a>
        </li>

        <li class="menu-item-has-children">
            <a href="javascript:void(0);" class="ripple">
                <i class="list-icon material-icons">event_note</i>
                <span class="hide-menu">Laporan LP Ranmor</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <!-- <li><a href="<?php echo site_url("lantas_kendaraan"); ?>">Laporan Kendaraan </a></li> -->
                <li><a href="<?php echo site_url("lantas_kendaraan_a"); ?>">LP A </a></li>
                <li><a href="<?php echo site_url("lantas_kendaraan_b"); ?>">LP B </a></li>
                
                
            </ul>
        </li>
        <?php 
       $userdata = $_SESSION['userdata']; 
       if($userdata['user_id'] <> 'lantas' ) : 

       ?>
         <li>
            <a href="<?php echo site_url("lap_a") ?>" class="ripple">
                <i class="list-icon material-icons">arrow_back</i>
                <span class="hide-menu">Kembali Ke LP</span>
            </a>
        </li>
    <?php endif; ?>

         
                
    </ul>
    <!-- /.side-menu -->
</nav>