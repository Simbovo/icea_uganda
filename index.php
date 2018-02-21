<?php

header('Location: public/login');
session_start();
require_once('app/Loader.php');

use application\model\DbConnection;

$companyName;
try {
    $conn = DbConnection::getInstance();


    $QryStr = "select company_name from unitmaster.company";
    $stmt = $conn->dbConn->query($QryStr);
    $stmt->execute();

    /* @var $result type */
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    /* @var $companyName type */
    $companyName = $result->company_name;

    $_SESSION['comp_name'] = $companyName;
    //print_r($result);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon"
              type="image/gif"
              href="assets/images/favicon.gif"/>
        <title><?php echo $companyName; ?> | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome Icons -->
        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- iCheck -->
        <link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <p><?php echo strtoupper($companyName); ?> PORTAL LOGIN</p>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <div class="waiting" style="display:none">
                    <center><img src="assets/images/loading.gif"> Verifying ...</center>
                </div>
                <div class="alert" style="display:none;">

                </div>

                <form method="POST" id="login" data-toggle="validator" role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="text" name="username" id="username"
                                   placeholder="Username" required data-error="Please fill in your username.">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" class="form-control" placeholder="Enter password" name="password"
                                   id="password"
                                   required data-error="Please fill in the password." data-minlength="6"/>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" id="login_button" class="btn btn-primary btn-block btn-flat"><span
                                    class="glyphicon glyphicon-log-in"></span> Sign In
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <a href="public/forgot">I forgot my password</a><br>
                <a href="public/sregister" class="text-center">Register a new membership</a>

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="assets/bootstrap/js/jquery.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="assets/bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <!--Validator-->
        <script src="assets/bootstrap/js/validator.js" type="text/javascript"></script>
        <script src="assets/dist/js/holder.js" type="text/javascript"></script>
        <!---->
        <!-- iCheck -->
        <script src="assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


        <script type="text/javascript">
            $(document).ready(function () {
                $("#login_button").click(function () {
                    $(".waiting").slideDown();
                    var data = new Object;
                    data.username = $("#username").val();
                    data.password = $("#password").val();
                    $.ajax({
                        type: 'POST',
                        url: 'helpers/authUser.php',
                        data: "data=" + JSON.stringify(data),
                        //data: $("#login").serialize(),
                        error: function (error) {
                            console.log(error);
                        },
                        success: function (response) {
                            $(".waiting").slideUp();
                            var data = JSON.parse(response);
                            if (data.Status == "failed") {
                                $(".alert").attr("class", "alert alert-danger");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Info!</strong> " + data.Message)
                            } else if (data.Status == "success") {
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

        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>

    </body>
</html>