<?php
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
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
<!-- CSS datepicker -->

<link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
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
    <div class="col-sm-10 col-sm-offset-1">
        <div class="waiting" style="display: none; align-self: center" ><img src="../assets/images/ajax-loader-bar.gif">Processing .. please wait</div>
        <div class="alert" style="display:none">
            
        </div>
                <div class="box box-info">
                    <form class="form-horizontal" method="post" action="" id="sregister" data-toggle="validator">
                        <div class="box-header">
                            Please fill in all the details
                        </div>
                        <div class="box-body">
                            <div class="col-lg-4 col-lg-offset-1">
                                <fieldset>
                                    <legend>Personal Information</legend>
                                    <div class="form-group">
                                        <select name="title" class="form-control" id="title"
                                        required="required">
                                        <option value="">---Select Title---</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Hon">Hon</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">Prof</option>
                                        <option value="Ms">Ms</option>
                                    </select>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" type="text" name="first_name" id="first_name"
                                        placeholder="First Name" required
                                        data-error="Please fill in your username.">
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" name="surname" class="form-control" id="surname"
                                        data-error="Name should not contain numerical values."
                                        placeholder="Surname" required>
                                        <span class="help-block with-errors"></span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" name="other_name" class="form-control"
                                        id="other_name"
                                        data-error="Name should not contain numerical values."
                                        placeholder="Other Name" required>
                                        <span class="help-block with-errors"></span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                            class="fa fa-calendar"></i></span>
                                            <input type="text" name="dob" class="form-control"
                                            id="dob"
                                            data-error="Date Should be filled."
                                            placeholder="Date Of birth" required data-provide="datepicker" data-date-end-date="0d">
                                            <span class="help-block with-errors"></span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                class="fa fa-genderless"></i></span>
                                                <select name="gender" id="gender" class="form-control"
                                                required="required">
                                                <option value="">--Please Select your Gender--</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>

                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-4 col-lg-offset-1">
                                <fieldset>
                                    <legend>Contact Details</legend>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" id="id_no" name="id_no" required class="form-control"
                                            placeholder="ID/Passport Number" data-error="Please fill in your ID/Passport"/>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" id="gsm_no" name="gsm_no" required class="form-control"
                                            data-error="Please fill in your ID" placeholder="Mobile Number"/>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                class="glyphicon glyphicon-envelope"></i></span>
                                                <input type="text" id="email" name="email" required class="form-control"
                                                data-error="Please fill in your ID" placeholder="Email Address"/>
                                                <span class="help-block with-errors"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="text" id="p_address" name="p_address" required class="form-control"
                                                data-error="Please fill in your postal address" placeholder="Postal Address (2536)"/>
                                                <span class="help-block with-errors"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="text" id="p_code" name="p_code" required class="form-control"
                                                data-error="Please fill in the postal code" placeholder="Postal Code (00100)"/>
                                                <span class="help-block with-errors"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                                <input type="text" id="town" name="town" required class="form-control"
                                                placeholder="City/Town"   data-error="Please fill in your ID"/>
                                                <span class="help-block with-errors"></span>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="../index.php" class="btn btn-danger pull-left">Cancel</a>
                                <button type="submit" class="btn btn-primary pull-right">Submit Details</button>
                            </div>
                        </form>

                    </div>
                </div>
</div>
<hr>
<div class="row">
    <?php include 'extras/footnote.php'; ?>;
</div>
</div>


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
<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.js" type="text/javascript"></script>
<!--Validator-->
<script src="../assets/bootstrap/js/validator.js" type="text/javascript"></script>
<!--Holder js-->
<script src="../assets/dist/js/holder.js" type="text/javascript"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $("#sregister").submit(function () {
            $(".waiting").slideDown();
            $.ajax({
                type: "POST",
                url: "../helpers/sregisterHelper",
                data: $("#sregister").serialize(),
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
                    } else if (response == "success") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Success!</strong>You have successfully saved your details Please proceed");
                        setTimeout(function () {
                            window.location.href = 'riskassess';
                        }, 2000);
                    } else {
                        console.log(response);
                    }
                }
            });
            return(false)
        });
        $("#dob").datepicker({
            autoClose: true
        });
    })
</script>
</body>
</html>