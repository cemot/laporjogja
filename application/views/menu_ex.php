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
               
                 <li><a href="<?php echo site_url("ex_lap_a"); ?>">LAPORAN POLISI MODEL A</a></li>
                <li><a href="<?php echo site_url("ex_lap_b"); ?>">LAPORAN POLISI MODEL B</a></li>
                <li><a href="<?php echo site_url("ex_lap_c"); ?>">LAPORAN POLISI MODEL C</a></li>
                <li><a href="<?php echo site_url("ex_lap_d"); ?>">LAPORAN POLISI MODEL D</a></li>
                <li><a href="<?php echo site_url("ex_lap_lantas"); ?>">LAPORAN LAKA LANTAS</a></li>
            </ul>
        </li>


          <li><a href="<?php echo site_url("ex_pencarian"); ?>"><i class="menu-icon fa  fa-search"></i>
                <span class="mm-text ">PENCARIAN</span></a></li> 
         <li><a href="<?php echo site_url("ex_anev"); ?>"><i class="menu-icon fa  fa-bars"></i><span class="mm-text ">ANEV</span></a></li>


      




        <li class="menu-dropdown">
            <a href="#">
                <i class="menu-icon fa fa-bar-chart"></i>
                <span>DATA GRAFIK</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
               
                 <li><a href="<?php echo site_url("ex_grafik_lap/grafik/1"); ?>">GRAFIK LAPORAN A</a></li>
                <li><a href="<?php echo site_url("ex_grafik_lap/grafik/2"); ?>">GRAFIK LAPORAN B</a></li>
                <li><a href="<?php echo site_url("ex_grafik_lap/grafik/3"); ?>">GRAFIK LAPORAN C</a></li>
                <li><a href="<?php echo site_url("ex_grafik_lap/grafik/4"); ?>">GRAFIK LAPORAN D</a></li>
                 <li><a href="<?php echo site_url("ex_grafik_lap/grafik/5"); ?>">GRAFIK LAPORAN LAKA LANTAS</a></li>
                 <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/1"); ?>">GRAFIK PENYIDIK LAP. A</a></li>
                 <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/2"); ?>">GRAFIK PENYIDIK LAP. B</a></li>
                 <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/3"); ?>">GRAFIK PENYIDIK LAP. C</a></li>
                 <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/4"); ?>">GRAFIK PENYIDIK LAP. D</a></li>
                 <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/5"); ?>">GRAFIK PENYIDIK LAP. LAKA LANTAS</a></li>   

                 <li><a href="<?php echo site_url("ex_grafik_gol_kejahatan"); ?>"> GRAFIK GOLONGAN  KEJAHATAN </a></li>

                  <li><a href="<?php echo site_url("ex_grafik_jenis_kejahatan"); ?>"> GRAFIK JE  KEJAHATAN </a></li>


                 <li><a href="<?php echo site_url("ex_grafik_jenis_kejahatan_bulan"); ?>"> GRAFIK JENIS  KEJAHATAN PER BULAN </a></li>   
                 <!-- <li><a href="<?php echo site_url("ex_grafik_kinerja_penyidik"); ?>"> GRAFIK KINERJA PENYIDIK </a></li>   --> 

            </ul>
        </li>


        <li class="menu-dropdown">
            <a href="#">
                <i class="menu-icon fa fa-users"></i>
                <span>DATA NAPI & LAPAS</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
               
                 <li><a href="<?php echo site_url("ex_lihat_data"); ?>">LIHAT DATA</a></li>
                <li><a href="<?php echo site_url("ex_import_data"); ?>">IMPORT DATA</a></li>
                <li><a href="<?php echo site_url("ex_diagram_pie"); ?>">DIAGRAM PIE</a></li> 
            </ul>
        </li>


     <li class="menu-dropdown">
        <a href="#">
            <i class="menu-icon fa  fa-th-large"></i>
            <span>LAPORAN</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li><a href="<?php echo site_url("laporan_harian"); ?>">LAPORAN HARIAN GANGGUAN KAMTIBMAS (LHGK)</a></li>
                <li><a href="<?php echo site_url("laporan_mingguan"); ?>">LAPORAN MINGGUAN GANGGUAN KAMTIBMAS (LMGK)</a></li>
                <li><a href="<?php echo site_url("laporan_bulanan"); ?>">LAPORAN BULANAN GANGGUAN KAMTIBMAS  </a></li>
                <li><a href="<?php echo site_url("laporan_per_lokasi"); ?>">LAPORAN TIDAK KEJAHATAN PER LOKASI</a></li>
                <li><a href="<?php echo site_url("laporan_grafik_waktu"); ?>">LAPORAN GRAFIK PENYEBARAN WAKTU </a></li>
        </ul>
    </li>
                   



                    
                     
</ul>