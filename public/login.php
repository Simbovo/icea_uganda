<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require('../vendor/autoload.php');

use app\application\library\commonFunctions;
use application\controller\dataController;
use application\controller\settingsController;

$set = new settingsController();

$company_info = $set->companyInfo();

$company_name = strtoupper($company_info->company_name);
$_SESSION['comp_name'] = $company_name;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon"
          type="image/gif"
          href="../assets/images/favicon.ico"/>
    <title><?php echo $company_name; ?></title>
    <!-- Bootstrap 3.3.4 -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   
    <!-- Font Awesome Icons -->
    <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="../assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    <!-- Ubuntu fonts -->
    <link rel="stylesheet" type="text/css"
          href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
    <!-- iCheck -->
    <link href="../assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css"/>
  <link href="../assets/bootstrap/css/ilam.css" rel="stylesheet" type="text/css"/>
 
</head>

<body>
<header class="main-header" id="main_header">
    <!-- Logo -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <h2  class="text-center" id="company_name"><?php echo $company_name; ?> &nbsp;</h2>

        <div class="navbar-custom-menu">


        </div>
    </nav>
</header>
<div class="container" id="my-panel">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="logo">
                <img src="../assets/images/logo.png" alt="Logo">
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="login-panel">
        <div class="col-md-4 col-md-offset-4">

            <form method="post" id="login-form" data-toggle="validator" role="form">
                <legend id="log">Login</legend>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input class="form-control input-sm col-xs-5" type="text" name="username" id="username"
                               autocomplete="off"
                               placeholder="Enter Username" required data-error="Please fill in your username.">
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control input-sm col-xs-5" placeholder="Enter password"
                               autocomplete="off"
                               name="password"
                               id="password"
                               required data-error="Please fill in the password." data-minlength="8"/>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <a href="forgot"><i class="glyphicon glyphicon-info-sign"></i> Forgot password</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" id="login_button" class="btn btn-primary btn-block btn-flat"><span
                                class="glyphicon glyhicon-log-in"></span> Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="waiting" style="display:none">
                    <img src="../assets/images/ajax-loader-bar.gif"> Authenticating ...
                </div>
                <div class="alert" style="display:none;">

                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <?php include 'extras/footnote.php'; ?>;
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="../assets/bootstrap/js/jquery.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../assets/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <!--Validator-->
    <script src="../assets/bootstrap/js/validator.js" type="text/javascript"></script>
    <!--Holder js-->
    <script src="../assets/dist/js/holder.js" type="text/javascript"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $("#login_button").click(function () {
                $(".waiting").slideDown();
                var data = new Object();
                data.username = $("#username").val();
                data.password = $("#password").val();
                $.ajax({
                    type: 'POST',
                    url: '../helpers/authUser.php',
                    data: "data=" + JSON.stringify(data),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $(".waiting").slideUp();
                        var data = JSON.parse(response);
						   console.log(data);
                        if (data.Status === "failed") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").show();
                            $(".alert").html("<strong>Info!</strong> " + data.Message)
                        } else if (data.Status === "success") {
                            window.location.href = data.Location;
                        } else if (data.Status) {
                            $(".alert").attr("class", "alert alert-info");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Info!</strong>" + data.Message)
                        } else {
                            console.log(response);
                        }
                    }
                });
                return false;
            })
        });
    </script>
</body>
</html>