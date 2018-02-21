<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require '../app/Loader.php';

$company =  new \application\controller\companyController();
$info = $company->getCompanyDetails();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="icon"
              type="image/gif"
              href="../assets/images/favicon.gif"/>
        <title><?php echo $info->comp_name; ?></title>
        <!-- Bootstrap 3.3.4 -->
        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome Icons -->
        <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="../assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- Ubuntu fonts -->
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
        <!-- iCheck -->
        <link href="../assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            #login {

                height: 300px;
                border-radius: 2px 2px 5px 5px;
                padding: 10px 20px 20px 20px;
                width: 100%;
                max-width: 500px;
                position: relative;
                padding-bottom: 80px;
                box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
            }

            #login-form {
                border-radius: 2px 2px 5px 5px;
                padding: 10px 20px 20px 20px;
                width: 100%;
                max-width: 400px;
                background: #ffffff;
                position: relative;
                padding-bottom: 80px;
                box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
                margin: 0 auto;
            }

            #my-panel {
                border-radius: 2px 2px 5px 5px;
                padding: 10px 20px 20px 20px;
                background: #ffffff;
                box-shadow: 0px 1px 5px rgba(153, 54, 31, 0.85);
            }
            #log{
                font-family: "Times New Roman", Georgia, Serif;
            }

        </style>
    </head>

    <body>
        <header class="main-header" style="background-color: rgba(171, 22, 43, 0.85)">
            <!-- Logo -->
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <h2 style="color: #f9be00"><?php echo $_SESSION['comp_name']; ?> &nbsp; PORTAL</h2>

                <div class="navbar-custom-menu">


                </div>
            </nav>
        </header>
        <div class="container" id="my-panel">

            <div class="row">

                <div class="col-md-4 col-md-offset-4">
                    <img src="../assets/images/logo.png" alt="Logo" width="154" height="92">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="waiting" style="display:none">
                            <center><img src="../assets/images/ajax-loader-bar.gif"> Processing ...</center>
                        </div>
                        <div class="alert" style="display:none;">

                        </div>
                    <div class="box box-info">
                        <form class="form-horizontal" method="post" action="" id="password_forgot">
                            <div class="box-header">
                                <h3>Please input your username!</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="username"> Username</label>
                                    <div class="col-sm-5">
                                        <input class="form-control col-sm-4" type="text" name="username_" id="username_" placeholder="Username" required autocomplete="off" 
                                                   data-error="Please fill in your username.">
                                            <span class="help-block with-errors"></span>
                                        </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="../index.php" class="btn btn-danger pull-left">Cancel</a>
                                <button type="submit" class="btn btn-primary pull-right">Reset password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <?php include 'extras/footnote.php'; ?>;
            </div>
            <!-- Control Sidebar -->
            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class='control-sidebar-bg'></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Bootstrap Datepicker js-->
        <script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
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
                $("#password_forgot").submit(function () {
                    $(".waiting").slideDown();
                   
                    $.ajax({
                        type: "POST",
                        url: "../helpers/forgot_pwd",
                        data: $("#password_forgot").serialize(),
                        error: function (err_msg) {
                            console.log(err_msg);
                        },
                        success: function (response) {
                            var data = JSON.parse(response);
                            $(".waiting").slideUp();
                            if (data.status == "ok") {
                                $(".alert").attr("class", "alert alert-success");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Ok! </strong>" + data.message);
                                setTimeout(function(){
                                    window.location.href = data.url_location;
                                }, 2000);
                            } else if (data.status == "fail") {
                                $(".alert").attr("class", "alert alert-danger");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Info!</strong>" + data.message);
                                
                            } else if (data.status == "error") {
                                $(".alert").attr("class", "alert alert-info");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Info! </strong>" + data.message);
                            } else {
                                console.log(data.message);
                            }
                        }
                    });
                    return(false)
                });
            })
        </script>
    </body>
</html>
