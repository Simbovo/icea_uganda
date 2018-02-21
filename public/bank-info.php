<?php
/*
 *
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require '../app/Loader.php';


use application\controller\dataController;
use application\controller\memberController;
use app\application\library\commonFunctions;
use application\controller\risk;

$member_details = new memberController();
$lib = new commonFunctions();
$banks = new dataController();

$risk = new risk();
$bank_data = $banks->getBankDetails();
$prefered_fund = $risk->getPreferedFund($_SESSION['score']);

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
    <link rel="stylesheet" type="text/css"
          href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
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

        #log {
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
        <div class="col-sm-12">
            <div class="box box-info">
                <form class="form-horizontal" method="post" action="" id="other_details" data-toggle="validator">
                    <div class="box-header">
                        <h4 class="alert alert-info">Your risk assess was completed successfully and your score
                            is <?php echo $_SESSION['score']; ?> and the prefered fund
                            is <?php echo $prefered_fund->fund_name; ?> </h4>
                    </div>
                    <div class="box-body">
                        <div class="col-lg-5 col-lg-offset-1">
                            <fieldset>
                                <legend>Bank account details</legend>
                                <div class="form-group">

                                    <div class="form-group">
                                        <label for="bank_name" class="control-label col-sm-4">Bank Name </label>

                                        <div class="col-sm-8">
                                            <select name="bank_name" id="bank_name" class="form-control"
                                                    required="required">
                                                <option value="">--Select Bank --</option>
                                                <?php
                                                foreach ($bank_data as $bank) {

                                                    echo "<option value='" . $bank->bankcode . "-" . $bank->bankname . "'>" . $bank->bankname . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="bankoptions">
                                        <label class=" col-sm-4 control-label" for="branch">Bank Branch</label>

                                        <div class="col-sm-8">
                                            <select name="branch" class="form-control" id="branch" required="required">
                                                <option value="">--- Please Select Branch ---</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="acct_no" class="col-sm-4 control-label">Account NO
                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="acct_no" id="acct_no"
                                                   pattern="[0-9]{13}" data-min-length="10" placeholder="1000010000"
                                                   data-max-length="15" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="acct_name" class="col-sm-4 control-label">Account name </label>

                                        <div class="col-sm-8">
                                            <input type="text" id="acct_name" required="required" placeholder="John Doe"
                                                   name="acct_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="acc_type">Account Type:</label>

                                        <div class="col-sm-8">
                                            <select name="acc_type" class="form-control" id="acc_type"
                                                    required="required">
                                                <option value="">--- Please Select Account Type ---</option>
                                                <option value="Current">Current Account</option>
                                                <option value="Junior">Junior Account</option>
                                                <option value="Savings">Savings Account</option>
                                                <option value="Sharia">Sharia Account</option>
                                                <option value="Student">Student Account</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                            </fieldset>

                        </div>
                        <div class="col-lg-5 col-lg-offset-1">
                            <fieldset>
                                <legend>Other Details</legend>
                                <div class="form-group">
                                    <label class=" col-sm-4 control-label" for="kra_pin">KRA PIN</label>

                                    <div class="col-sm-8">
                                        <input type="text" name="kra_pin" id="kra_pin" required="required"
                                               placeholder="A000000000P" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="c_person">Contact Name</label>

                                    <div class="col-sm-8">
                                        <input type="text" name="c_person" id="c_person" required="required"
                                               placeholder="Name of contact" class="form-control"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4">Contact Email</label>

                                    <div class="col-sm-8">
                                        <input type="text" id="c_email" name="c_email" required class="form-control"
                                               data-error="Please fill in the contact email"
                                               placeholder="Email Address"/>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="c_phone">Contact Phone</label>

                                    <div class="col-sm-8">

                                        <input type="text" id="c_phone" name="c_phone" required class="form-control"
                                               data-error="Please fill in the contact phone"
                                               placeholder="+254729000000"/>
                                    </div>
                                    <span class="help-block with-errors"></span>
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
        <hr>

        <div class="row">
            <?php include 'extras/footnote.php'; ?>;
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
                $("#other_details").submit(function () {
                    $(".waiting").slideDown();
                    $.ajax({
                        type: "POST",
                        url: "../helpers/other-info",
                        data: $("#other_details").serialize(),
                        error: function (err_msg) {
                            console.log(err_msg);
                        },
                        success: function (response) {
                            $(".waiting").slideUp();
                            var data = JSON.parse(response);
                            if (data.code == "fail") {
                                $(".alert").attr("class", "alert alert-danger");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Error!</strong>" + data.Message);
                            } else if (data.code == "ok") {
                                $(".alert").attr("class", "alert alert-success");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Info!  </strong>" + data.Message);
                                setTimeout(function () {
                                    window.location.href = data.location;
                                }, 2000);
                            } else {
                                console.log(response);
                            }
                        }
                    });
                    return (false)
                });
                $("#dob").datepicker({
                    autoClose: true
                });
            })
        </script>
        <script type="text/javascript">
            $(document).on("change", '#bank_name', function (e) {
                // var selecte  = $(this).val();

                $.ajax({
                    type: "POST",
                    data: $("#bank_name").serialize(),
                    url: 'extras/getbnkbranch.php',
                    //dataType: 'json',
                    success: function (response) {
                        $("#bankoptions").html(response);
                    }
                });
                return false
            });
        </script>
</body>
</html>