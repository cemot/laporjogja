<!DOCTYPE html>
<html lang="en">
<?php
$userdata = $_SESSION['userdata'];
 

?>
<head>
    <link rel="stylesheet" href="<?php echo base_url("assets/oscar") ?>/css/pace.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets") ?>/images/favicon.ico">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dashboard</title>
    <!-- CSS -->
    <link href="<?php echo base_url("assets/oscar") ?>/vendors/material-icons/material-icons.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/oscar") ?>/vendors/mono-social-icons/monosocialiconsfont.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/oscar") ?>/vendors/weather-icons-master/weather-icons.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/oscar") ?>/vendors/weather-icons-master/weather-icons-wind.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/oscar") ?>/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>    

    <!-- Bawaan dari theme dulu -->
    <!-- <link type="text/css" href="<?php echo base_url("assets2") ?>/css/app.css" rel="stylesheet"/> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets2") ?>/css/custom.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets2") ?>/vendors/datatables/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets2") ?>/css/pages/datatables.css"> -->
    <link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets") ?>/select2/dist/css/select2.min.css" rel="stylesheet">
    <script src="<?php echo base_url("assets2") ?>/js/app.js" type="text/javascript"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url("assets2") ?>/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url("assets2") ?>/vendors/datatables/js/dataTables.bootstrap.min.js"></script> -->
    <script src="<?php echo base_url("assets2") ?>/vendors/mark.js/jquery.mark.js" charset="UTF-8"></script>
    <script src="<?php echo base_url("assets2") ?>/vendors/datatablesmark.js/js/datatables.mark.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo base_url("assets2") ?>/vendors/bootstrap-table/js/bootstrap-table.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url("assets2") ?>/vendors/tableExport.jquery.plugin/tableExport.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url("assets2") ?>/js/pages/responsive_datatables.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/bootstrap-dialog.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
</head>

<body class="header-light sidebar-dark sidebar-expand">
    <div id="wrapper" class="wrapper">
        <!-- HEADER & TOP NAVIGATION -->
        <nav class="navbar">
            <!-- Logo Area -->
            <div class="navbar-header">
                <a href="<?= site_url("index_lantas") ?>" class="navbar-brand">
                    <img class="logo-expand" alt="" src="<?php echo base_url("assets") ?>/images/logo-diy.png">
                    <img class="logo-collapse" alt="" src="<?php echo base_url("assets") ?>/images/polda_diy-collapse.png">
                    <!-- <p>OSCAR</p> -->
                </a>
            </div>
            <!-- /.navbar-header -->
            <!-- Left Menu & Sidebar Toggle -->
            <ul class="nav navbar-nav">
                <li class="sidebar-toggle"><a href="javascript:void(0)" class="ripple"><i class="material-icons list-icon">menu</i></a>
                </li>
            </ul>
            <!-- /.navbar-left -->
            <!-- Search Form -->
            <!-- <form class="navbar-search d-none d-sm-block" role="search"><i class="material-icons list-icon">search</i> 
                <input type="text" class="search-query" placeholder="Search anything..."> <a href="javascript:void(0);" class="remove-focus"><i class="material-icons">clear</i></a>
            </form> -->
            <!-- /.navbar-search -->
            <div class="spacer"></div>
            <!-- /.navbar-right -->
            <!-- User Image with Dropdown -->
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown"><span class="avatar thumb-sm"><img src="<?php echo base_url("assets2") ?>/img/authors/user.jpg" class="rounded-circle" alt=""> <i class="material-icons list-icon">expand_more</i></span></a>
                    <div
                    class="dropdown-menu dropdown-left dropdown-card dropdown-card-wide dropdown-card-dark text-inverse">
                        <div class="card">
                            <header class="card-heading-extra">
                                <div class="row">
                                    <div class="col-8">
                                        <h3 class="mr-b-10 sub-heading-font-family fw-300"><?php echo  $userdata['nama']. " -  ".$userdata['user_id']; ?></h3>
                                    </div>
                                    <div class="col-4 d-flex justify-content-end"><a href="<?= site_url("login/logout") ?>" class="mr-t-10"><i class="material-icons list-icon">power_settings_new</i> Logout</a>
                                    </div>
                                    <!-- /.col-4 -->
                                </div>
                                <!-- /.row -->
                            </header>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- /.navbar-right -->
        </nav>
        <!-- /.navbar -->

        <div class="content-wrapper">
        
            <!-- SIDEBAR -->
            <aside class="site-sidebar scrollbar-enabled clearfix">
                <!-- User Details -->
                <div class="side-user">
                    <a class="col-sm-12 media clearfix" href="javascript:void(0);">
                        <figure class="media-left media-middle user--online thumb-sm mr-r-10 mr-b-0">
                            <img src="<?php echo base_url("assets2") ?>/img/authors/user.jpg" class="media-object rounded-circle" alt="">
                        </figure>
                        <div class="media-body hide-menu">
                            <h4 class="media-heading mr-b-5 text-uppercase"><?php echo $userdata['nama'] ?></h4><span class="user-type fs-12"><?php //echo $userlevel." ".strtoupper($userdata['jenis'])." ".$inst. " " ; ?></span>
                        </div>
                    </a>
                </div>
                <!-- /.side-user -->

                <!-- Sidebar Menu -->
                <?php $this->load->view("menu_lantas") ?>
                <!-- /.sidebar-nav -->

            </aside>
            <!-- /.site-sidebar -->

            <main class="main-wrapper clearfix">
                <!-- Page Title Area -->
                <div class="row page-title clearfix">
                    <div class="page-title-left">
                        <h5 class="mr-0 mr-r-5"><?php echo $subtitle; ?></h5>
                    </div>
                    <!-- /.page-title-right -->
                </div>
                <!-- /.page-title -->

                <br>
                <?php echo $content; ?>

            </main>
            <!-- /.main-wrappper -->
            
        </div>
        <!-- /.content-wrapper -->
    
        <!-- FOOTER -->
        <!-- <footer class="footer text-center clearfix">2017 © Oscar Admin brought to you by UnifatoThemes</footer> -->

    </div>
    <!--/ #wrapper -->

    <!-- Scripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <?php if(!isset($this->dontPopper)): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
    <?php endif; ?>
    <script src="<?php echo base_url("assets/oscar") ?>/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.77/jquery.form-validator.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script> -->
    <!-- <script src="<?php echo base_url("assets/oscar") ?>/vendors/charts/utils.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script> -->
    <!-- <script src="<?php echo base_url("assets/oscar") ?>/vendors/charts/excanvas.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mithril/1.1.1/mithril.js"></script> -->
    <!-- <script src="<?php echo base_url("assets/oscar") ?>/vendors/theme-widgets/widgets.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/clndr/1.4.7/clndr.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script> -->
    <script src="<?php echo base_url("assets/oscar") ?>/js/theme.js"></script>
    <script src="<?php echo base_url("assets/oscar") ?>/js/custom.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
</body>

</html>