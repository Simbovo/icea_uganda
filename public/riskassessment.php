<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/15/15
 * Time: 12:23 PM
 */
session_start();

require '../app/Loader.php';

use application\controller\risk;

$risk = new risk();

$risk_quiz = $risk->get_quiz();
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
        <title><?php echo $_SESSION['comp_name']; ?>| Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pretify css -->
        <link href="../assets/bootstrap/css/prettify.css" rel="stylesheet" type="text/css"/>
        <!--    Bootstrap 3 datepicker css-->
        <link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome Icons -->
        <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Ionicons -->
        <link href="../dist/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="../assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="../assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-red-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="../index" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>U</b>MO</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>UnitTrust</b>Online</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <!--   <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </a>
                    -->

                    <div class="text-center" style="color: #fff">

                        <p><h4><?php echo $_SESSION['comp_name']; ?></h4></p>

                    </div>
                </nav>
            </header>
            <!-- <aside>
 
             </aside> -->
            <!-- Content Wrapper. Contains page content -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Risk assessment

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../index"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li class="active">DashBoard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Default box -->
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="box">
                                <form class="form-horizontal" method="post" action="" id="asses">
                                    <div class="box-header box-info">
                                        Please select the choices that best describes you!
                                    </div>
                                    <div class="box-body">
                                        <?php
                                        foreach ($risk_quiz as $val) {

                                            echo "<label class='contol-label' for='label'>" . $val->label . " : " . $val->description . "</label>";
                                            echo"<br/>";

                                            $risk_answers = $risk->risk_anwers($val->autoid);
                                            foreach ($risk_answers as $ans) {

                                                echo "<div class='radio'>";
                                                echo "<label>";
                                                echo "<input id='radio' name='question$val->autoid[]' value='$ans->points' type='radio'>";
                                                echo "( " . $ans->tag . " ) " . $ans->description;
                                                echo "</label>";
                                                echo "</div>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="box-footer">
                                        <a href="../index.php" class="btn btn-danger pull-left">Cancel</a>
                                        <button type="submit" class="btn btn-primary pull-right">Submit assessment</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.0
                </div>
                <strong>Copyright &copy; <?php echo date('Y'); ?> <a
                        href="https://icealion.com/"><?php echo $_SESSION['comp_name']; ?>
                    </a>.</strong> All rights reserved.
            </footer>

            <!-- Control Sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class='control-sidebar-bg'></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Bootstrap wizard JS -->
        <script src="../assets/dist/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>

        <script src = "../assets/dist/js/prettify.js" ></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

        <!-- SlimScroll -->
        <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='../assets/plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="../assets/dist/js/app.min.js" type="text/javascript"></script>

        <!-- Demo -->
        <script src="../assets/dist/js/demo.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#asses").submit(function () {

                    $(".waiting").slideDown();
                    var data = new Object();
                    data.all_data = $("#id").val();
                    $.ajax({
                        type: "POST",
                        url: "../helpers/assessment-helper",
                        data: $("#asses").serialize(),
                        error: function (err_msg) {
                            console.log(err_msg);
                        },
                        success: function (response) {
                            $(".waiting").slideUp();
                            if (response == "failed") {
                                $(".alert").attr("class", "alert alert-danger");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Error!</strong>There was a problem saving your details, please try again later")
                            } else if (response == "age") {
                                $(".alert").attr("class", "alert alert-danger");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Sorry!</strong>You should be above 18 years")
                            } else if (response == "registered") {
                                $(".alert").attr("class", "alert alert-success");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Success!</strong>You have successfully saved your details Please proceed");
                            } else {
                                console.log(response);
                            }
                        }
                    });
                    return(false)
                });

            })
        </script>
    </body>
</html>
