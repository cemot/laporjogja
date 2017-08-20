<?php 

$userdata = $_SESSION['userdata'];
?>

    <ul class="navigation">
        <li>
            <a href="<?php echo site_url("index_executive") ?>">
                <i class="menu-icon fa fa-fw fa-home"></i>
                <span class="mm-text ">DEPAN</span>
            </a>
        </li>
        


         
        <li class="menu-dropdown">
            <a href="#">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span>LAPORAN</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
               
             <li><a href="<?php echo site_url("penyidik_lap_a"); ?>">LAPORAN POLISI MODEL A</a></li>
            <li><a href="<?php echo site_url("penyidik_lap_b"); ?>">LAPORAN POLISI MODEL B</a></li>
            <li><a href="<?php echo site_url("penyidik_lap_c"); ?>">LAPORAN POLISI MODEL C</a></li>
            <li><a href="<?php echo site_url("penyidik_lap_d"); ?>">LAPORAN POLISI MODEL D</a></li>
            <li><a href="<?php echo site_url("penyidik_laka"); ?>">LAPORAN LAKA LANTAS</a></li>
            </ul>
        </li>


           
                   



                    
                     
</ul>