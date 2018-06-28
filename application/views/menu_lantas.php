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
                <span class="hide-menu">Laporan</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="<?php echo site_url("lantas_kendaraan"); ?>">Laporan Kendaraan </a></li>
                
            </ul>
        </li>

         
                
    </ul>
    <!-- /.side-menu -->
</nav>