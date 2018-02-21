<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once ('../app/Loader.php');
use app\application\library\commonFunctions as Lib;
use application\controller\memberController;

$lib = new Lib();
$mem = new memberController();

$message = '';

if(isset($_GET['token']) ){
	$username = $lib->decryptStringArray($_GET['token'], 'cicam0912');

	$member_data = $mem->membersByUsername($username);

	$delta = 86400;


	if($_SERVER["REQUEST_TIME"] - $member_data->p_reset_timestamp >$delta){
		$message = 'The token has expired';
	}else{

	}

}else{
    $message = 'Valid token not provided';
}
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
    <title><?php echo $_SESSION['comp_name']; ?></title>
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
            background: url(../assets/images/mainheader.gif) no-repeat;
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
                    <?php if(strlen($message) > 0 )
                    echo $message;
                    ?>
                </div>
                <div class="box box-info">
                    <form class="form-horizontal" method="post" action="" id="password_reset">
                        <div class="box-header">
                            <h3>Please fill in the form</h3>
                        </div>
                        <div class="box-body">

                            <input type="hidden" name="token" id="token" value="<?php echo $_GET['token'];?>">
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="password">New Password</label>
                                <div class="col-sm-5">
                                 <input class="form-control col-sm-4" type="password" name="password" id="password" placeholder="New Password" required="reqiured"
                                 data-error="Please fill in your password.">                                
                             </div>
                              <span class="help-block with-errors"></span>
                         </div>

                         <div class="form-group">
                            <label class="control-label col-sm-4" for="password">Confirm Password</label>
                            <div class="col-sm-5">
                             <input class="form-control col-sm-4" type="password" name="c_password" id="c_password" placeholder="Confirm Password" required="required" 
                             data-match="#password"
                             data-match-error="Passwords do not match!" >
                         </div>
                          <span class="help-block with-errors"></span>
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

        </div>
        <!-- ./wrapper -->


        <!-- jQuery 2.1.4 -->
        <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='../assets/plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
        <!--Data Table js-->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="../assets/dist/js/holder.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/validator.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#password_reset").submit(function () {
                    $(".waiting").slideDown();
                    var vals = new Object();
                    vals.token = $("#token").val();
                    vals.password = $("#password").val();
                    vals.c_password = $("#c_password").val();
                    $.ajax({
                        type: "POST",
                        url: "../helpers/activate-account",
                        data: "data=" + JSON.stringify(vals),
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
                            } else if (data.status == "err_match") {
                                $(".alert").attr("class", "alert alert-danger");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Info!</strong>" + data.message);
                                
                            } else if (data.status == "existing") {
                                $(".alert").attr("class", "alert alert-danger");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Info!</strong>" + data.message);
                            }  else if (data.status == "fail") {
                                $(".alert").attr("class", "alert alert-info");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Info! </strong> " + data.message);
                            } else {
                                //console.log(data.message);
                            }
                        }
                    });
                    return(false)
                });
            })
        </script>
    </body>
    </html>
