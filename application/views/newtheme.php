<!DOCTYPE html>
<html>
<?php $userdata = $_SESSION['userdata']; ?>

<?php 
                                      

                                      // show_array($userdata);

                                      if($userdata['jenis']=="polres") {
                                           $inst =  $this->cm->get_detail_polres($userdata['id_polres']);
                                      }
                                      else if($userdata['jenis']=="polsek") {
                                           $inst =  $this->cm->get_detail_polsek($userdata['id_polsek']);
                                      }
                                      else  {
                                           $inst =  ' D.I.Y';
                                      }

                                      if($userdata['level']=="0") {
                                        $userlevel = "SUPER ADMIN";
                                        $homepage= "index_administrator";
                                      }
                                      else if($userdata['level']=="1") {
                                        $userlevel = "ADMINDIK";
                                        $homepage= "index_administrator";
                                      }
                                      else if($userdata['level']=="2") {
                                        $userlevel = "PENYIDIK";
                                        $homepage= "index_penyidik";
                                        
                                      }
                                      else if($userdata['level']=="3") {
                                        $userlevel = "OPERATOR";
                                        $homepage = 'depan_baru';
                                      }
                                      else {
                                        $userlevel = "EXECUTIVE";
                                        $homepage = 'index_executive';
                                      }

                                    ?>
<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Laporan Polisi</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url("assets") ?>/images/favicon.ico"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link type="text/css" href="<?php echo base_url("assets2") ?>/css/app.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets2") ?>/css/custom.css">


        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets2") ?>/vendors/datatables/css/dataTables.bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets2") ?>/css/pages/datatables.css">

<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">


<link href="<?php echo base_url("assets") ?>/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css">



 <link href="<?php echo base_url("assets") ?>/select2/dist/css/select2.min.css" rel="stylesheet">




<script src="<?php echo base_url("assets2") ?>/js/app.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url("assets2") ?>/vendors/datatables/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?php echo base_url("assets2") ?>/vendors/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url("assets2") ?>/vendors/mark.js/jquery.mark.js" charset="UTF-8"></script>
<script src="<?php echo base_url("assets2") ?>/vendors/datatablesmark.js/js/datatables.mark.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url("assets2") ?>/vendors/bootstrap-table/js/bootstrap-table.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets2") ?>/vendors/tableExport.jquery.plugin/tableExport.min.js"></script>

<script type="text/javascript" src="<?php echo base_url("assets2") ?>/js/pages/responsive_datatables.js"></script>


 
<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

 <script src="<?php echo base_url("assets") ?>/js/bootstrap-dialog.min.js"></script>
<script src="<?php echo base_url("assets") ?>/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>


    <!-- end of global css -->
</head>
<style type="text/css">
#myPleaseWait {
    z-index: 999999;
}
</style>
<body>

<div class="modal fade bs-example-modal-sm" id="myPleaseWait" tabindex="-1"
    role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="glyphicon glyphicon-time">
                    </span>Sedang memproses. Harap Tunggu...
                 </h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-info
                    progress-bar-striped active"
                    style="width: 100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- header logo: style can be found in header-->
<header class="header">
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="<?php echo site_url($homepage); ?>" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            <img height="100%" src="<?php echo base_url() ?>/assets/images/logo-diy.png" alt="logo"/>
        </a>
        <!-- Header Navbar: style can be found in header-->
        <!-- Sidebar toggle button-->
        <!-- Sidebar toggle button-->
        <div>
            <a href="javascript:void(0)" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i
                    class="fa fa-fw fa-bars"></i>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                 
                <!-- User Account: style can be found in dropdown-->
                <li class="dropdown user user-menu">
                    <a href="javascript:void(0)" class="dropdown-toggle padding-user" data-toggle="dropdown">
                        <img src="<?php echo base_url("assets2") ?>/img/authors/user.jpg" class="img-circle img-responsive pull-left" alt="User Image">
                        <div class="riot">
                            <div>
                                <i class="caret"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User name-->
                        <li class="user-name text-center">
                            <span><?php echo  $userdata['nama']. " -  ".$userdata['user_id']; ?></span>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="p-t-3">
                            <a href="user_profile.html">
                                Profile<i class="fa fa-fw fa-user pull-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="edit_user.html">
                                Settings <i class="fa fa-fw fa-cog pull-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="lockscreen.html">
                                Lock <i class="fa fa-fw fa-lock pull-right"></i>
                            </a>
                        </li> -->
                        <li>
                            <a href="<?php echo site_url("login/logout"); ?>">
                                Logout <i class="fa fa-fw fa-sign-out pull-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-aside">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <div class="nav_profile">
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="javascript:void(0)">
                            <img src="<?php echo base_url("assets2") ?>/img/authors/user.jpg" class="img-circle" alt="User Image">
                        </a>
                        <div class="content-profile">
                            <h4 class="media-heading">

                                                                  <?php echo  $userdata['nama']. " -  ".$userdata['user_id']; ?>
                            </h4>
                            <p><?php echo $userlevel." ".strtoupper($userdata['jenis'])." ".$inst. " " ; ?></p>
                        </div>
                    </div>
                </div>
                <?php 
                // menu here 


                    if($userdata['level']=="4") {
                        $this->load->view("menu_ex");
                    }
                    else if($userdata['level']=="0") {
                        $this->load->view("menu_admin");
                    }
                    else if($userdata['level']=="1") {
                        $this->load->view("menu_admindik");
                    }
                    else if($userdata['level']=="2") {
                        $this->load->view("menu_penyidik");
                    }
                    else if($userdata['level']=="3") {
                        $this->load->view("menu_op");
                    }
                // menu here 

                ?>
                <!-- / .navigation -->
            </div>
            <!-- menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
    <aside class="right-aside view-port-height">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><?php echo $subtitle; ?></h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">

              <!--   <div class="panel panel panel-success">
                    <div class="panel-heading"><strong><?php echo $subtitle; ?></strong></div>            

                    <div id="homepage" class="panel-body" style="min-height:300px;"> -->
                            <?php echo $content; ?>
             <!--        </div>
                </div> -->


                </div>
            </div>
        </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<!-- global js -->



<!-- end of page level js -->
</body>

</html>
