                <?php 

                $userdata = $_SESSION['userdata'];
                ?>

                <ul class="navigation">
                    <li>
                        <a href="<?php ?>">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Depan</span>
                        </a>
                    </li>
                    


                     
                    <li class="menu-dropdown">
                        <a href="#">
                            <i class="menu-icon fa fa-check-square"></i>
                            <span>LAPORAN</span>
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
                        </ul>
                    </li>


                    





                    <li><a href="<?php echo site_url("ex_pencarian"); ?>"><i class="menu-icon fa  fa-search"></i>
                            <span class="mm-text ">PENCARIAN</span></a></li> 



                     <li><a href="<?php echo site_url("pengaturan"); ?>"><i class="menu-icon fa   fa-cog "></i>
                            <span class="mm-text ">PENGATURAN <?php echo strtoupper($userdata['jenis']) ?> </span></a></li>        
                     
                </ul>