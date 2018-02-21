<?php
session_start();
require('../app/Loader.php');
//require_once('extras/rbac_auth.php');
use application\controller\settingsController;

$set = new settingsController();

$company_info = $set->companyInfo();

$company_name = strtoupper($company_info->company_name);


 $expire_time = 1 * 10 * 60; //expire time
 if ($_SESSION['last_activity'] < time() - $expire_time) {
     header('location:logout.php');
 } else {
     $_SESSION['last_activity'] = time();
 }

include('../bootstrap.php');


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="icon"
              type="image/gif"
              href="../assets/images/favicon.gif"/>
        <title><?php echo $company_name; ?>| Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php ROOT_DIR; ?>../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!--    Bootstrap 3 datepicker css-->    
        <link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
        <!-- Pretify css -->
        <link href="../assets/bootstrap/css/prettify.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome Icons -->
        <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
        <!--<link href="../assets/bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Theme style -->
        <link href="../assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <!-- Ubuntu fonts -->
<!--        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">-->

        <link href="../assets/dist/css/skins/skin-blue-light.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css">
        <!--    Datatables plugins-->
        <link href="../assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/datatables/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!-- Check-->
        <link href="../assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css">
        <!--    WYSIWYG-->
        <link href="../assets/plugins/wyeditor/bootstrap3-wysihtml5.min.css" type="text/css" rel="stylesheet"/>
        <!--<script type="text/javascript" src="../assets/dist/js/menu_handler.js"></script>-->
<!--        <link media="all" type="text/css" rel="stylesheet" href="../assets/plugins/pace/pace.min.css"/>-->
<!--        https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
<!--        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    

    </head>
    <body class="hold-transition skin-blue-light fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="dashboard" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>U</b>MO</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>NIC </b>Bank</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    
                    
                    <!-- Sidebar toggle button-->
                     <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </a>
                    
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                           

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                                    <span class="hidden-xs"><?php echo $_SESSION['username'] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>

                                        <p>
                                            <?PHP echo $_SESSION['username'] ?>
                                            <small><?php echo $_SESSION['category']; ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="changepass" class="btn btn-warning btn-flat">Change Password</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-success btn-flat"><span
                                                    class="glyphicon glyphicon-off"> Sign out</span></a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                       
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->

            <?php
            include('dynamic_nav.php');
            ?>
            <!-- Left Side navigation -->