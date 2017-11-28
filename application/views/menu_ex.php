<?php 
$userdata = $_SESSION['userdata'];
?>

<nav class="sidebar-nav">
    <ul class="nav in side-menu">
        
        <li>
            <a href="<?php echo site_url("index_executive") ?>" class="ripple">
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
                <li><a href="<?php echo site_url("ex_lap_a"); ?>">Laporan polisi model a</a></li>
                <li><a href="<?php echo site_url("ex_lap_b"); ?>">Laporan polisi model b</a></li>
                <li><a href="<?php echo site_url("ex_lap_c"); ?>">Laporan polisi model c</a></li>
                <li><a href="<?php echo site_url("ex_lap_d"); ?>">Laporan polisi bencana alam</a></li>
                <li><a href="<?php echo site_url("ex_lap_lantas"); ?>">Laporan laka lantas</a></li>
            </ul>
        </li>

        <li>
            <a href="<?php echo site_url("ex_pencarian") ?>" class="ripple">
                <i class="list-icon material-icons">search</i>
                <span class="hide-menu">Pencarian</span>
            </a>
        </li>

        <li>
            <a href="<?php echo site_url("ex_anev") ?>" class="ripple">
                <i class="list-icon material-icons">reorder</i>
                <span class="hide-menu">Anev</span>
            </a>
        </li>

        <li class="menu-item-has-children">
            <a href="javascript:void(0);" class="ripple">
                <i class="list-icon material-icons">insert_chart</i>
                <span class="hide-menu">Data Grafik</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="<?php echo site_url("ex_grafik_lap/grafik/1"); ?>">Grafik laporan a</a></li>
                <li><a href="<?php echo site_url("ex_grafik_lap/grafik/2"); ?>">Grafik laporan b</a></li>
                <li><a href="<?php echo site_url("ex_grafik_lap/grafik/3"); ?>">Grafik laporan c</a></li>
                <li><a href="<?php echo site_url("ex_grafik_lap/grafik/4"); ?>">Grafik laporan polisi bencana alam</a></li>
                <li><a href="<?php echo site_url("ex_grafik_lap/grafik/5"); ?>">Grafik laporan laka lantas</a></li>
                <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/1"); ?>">Grafik penyidik lap. a</a></li>
                <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/2"); ?>">Grafik penyidik lap. b</a></li>
                <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/3"); ?>">Grafik penyidik lap. c</a></li>
                <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/4"); ?>">Grafik penyidik lap. polisi bencana alam</a></li>
                <li><a href="<?php echo site_url("ex_grafik_penyidik/grafik/5"); ?>">Grafik penyidik lap. laka lantas</a></li>   
                <li><a href="<?php echo site_url("ex_grafik_gol_kejahatan"); ?>">Grafik golongan  kejahatan</a></li>
                <li><a href="<?php echo site_url("ex_grafik_jenis_kejahatan"); ?>">Grafik jenis  kejahatan</a></li>
                <li><a href="<?php echo site_url("ex_grafik_jenis_kejahatan_bulan"); ?>">Grafik jenis  kejahatan per bulan</a></li>   
                <li><a href="<?php echo site_url("ex_grafik_kinerja_penyidik"); ?>">Grafik kinerja penyidik</a></li>  
            </ul>
        </li>

        <li class="menu-item-has-children">
            <a href="javascript:void(0);" class="ripple">
                <i class="list-icon material-icons">show_chart</i>
                <span class="hide-menu">Kinerja Penyidik</span>
            </a>
            <ul class="list-unstyled sub-menu">
            <li><a href="<?php echo site_url("ex_kinerja_penyidik/grafik/1"); ?>">Lap. a</a></li>
            <li><a href="<?php echo site_url("ex_kinerja_penyidik/grafik/2"); ?>">Lap. b</a></li>
            <li><a href="<?php echo site_url("ex_kinerja_penyidik/grafik/3"); ?>">Lap. c</a></li>
            <li><a href="<?php echo site_url("ex_kinerja_penyidik/grafik/4"); ?>">Lap. polisi bencana alam</a></li>
            <li><a href="<?php echo site_url("ex_kinerja_penyidik/grafik/5"); ?>">Lap. laka lantas</a></li>   
            </ul>
        </li>

        <li class="menu-item-has-children">
            <a href="javascript:void(0);" class="ripple">
                <i class="list-icon material-icons">group</i>
                <span class="hide-menu">Data Napi & Lantas</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="<?php echo site_url("ex_lihat_data"); ?>">Lihat data</a></li>
                <li><a href="<?php echo site_url("ex_import_data"); ?>">Import data</a></li>
                <li><a href="<?php echo site_url("ex_diagram_pie"); ?>">Diagram pie</a></li> 
            </ul>
        </li>

        <li class="menu-item-has-children">
            <a href="javascript:void(0);" class="ripple">
                <i class="list-icon material-icons">developer_board</i>
                <span class="hide-menu">Laporan</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="<?php echo site_url("laporan_harian"); ?>">Laporan harian gangguan kamtibmas (LHGK)</a></li>
                <li><a href="<?php echo site_url("laporan_mingguan"); ?>">Laporan mingguan gangguan kamtibmas (LMGK)</a></li>
                <li><a href="<?php echo site_url("laporan_bulanan"); ?>">Laporan bulanan gangguan kamtibmas</a></li>
                <li><a href="<?php echo site_url("laporan_per_lokasi"); ?>">Laporan tidak kejahatan per lokasi</a></li>
                <li><a href="<?php echo site_url("laporan_grafik_waktu"); ?>">Laporan grafik penyebaran waktu</a></li>
            </ul>
        </li>

        <li>
            <a href="<?php echo site_url("ex_whos_online") ?>" class="ripple">
                <i class="list-icon material-icons">record_voice_over</i>
                <span class="hide-menu">Who's Online</span>
            </a>
        </li>
                
    </ul>
    <!-- /.side-menu -->
</nav>