<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/15/15
 * Time: 12:23 PM
 */
session_start();

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
    <!--    Bootstrap 3 datepicker css-->
    <link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <!--    <link href="../dist/css/ionicons.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Theme style -->
    <link href="../assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="../assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>

    <!--    Datatables plugins-->
    <!--    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>-->
    <!--    <link href="../plugins/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css"/>-->
    <!--    <link href="../plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css"/>-->


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
        <span class="logo-lg"><b>Unit Trust</b>Online</span>
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

        <div class="text-center" style="color: #fff">

            <p><h4><?php echo strtoupper($_SESSION['comp_name']); ?></h4></p>

        </div>
    </nav>
</header>
<!--<aside>

</aside>-->
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Self Registration

        </h1>
        <ol class="breadcrumb">
            <li><a href="../index"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Self Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box">
                <div class="box-header with-border">
                    Please fill in the form below appropriately
                </div>


                <div class="box-body">
                    <div class="waiting" style="display:none">
                        <center><img src="../assets/images/loading.gif"> Verifying ...</center>
                    </div>
                    <div class="alert" style="display:none;">

                    </div>
                    <form id="sregister" name="sregister" method="post" action="" data-toggle="validator">
                        <div class="col-lg-12">

                            <div class="col-lg-2"></div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <legend>Personal Information</legend>
                                    <div class="form-group">
                                        <label class="control-label" for="title">Title</label>
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
                                            <input class="form-control" type="text" name="fist_name" id="fist_name"
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
                                                   placeholder="Date Of birth" required>
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
                            <div class="col-lg-4">
                                <fieldset>
                                    <legend>Contact Details</legend>
                                </fieldset>
                                <div class="form-group">
                                    <label class="control-label" for="id_no">ID/Passport Number</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" id="id_no" name="id_no" required class="form-control"
                                              placeholder="ID/Passport Number" data-error="Please fill in your ID"/>
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
                                               data-error="Please fill in your ID" placeholder="Postal Address"/>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                        <input type="text" id="town" name="town" required class="form-control"
                                               data-error="Please fill in your ID"/>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-2"></div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-4"></div>

                            <div class="col-xs-4">
                                <button type="submit" id="login_button" class="btn btn-primary btn-block "><span
                                        class="glyphicon glyphicon-save"></span> Submit Details
                                </button>
                            </div>
                            <div class="col-xs-4"></div>
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
   <?php include('extras/footnote.php');?>
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
                    } else if (response == "registered") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Success!</strong>You have successfully saved your details Please proceed");
                        setTimeout(function(){
                            window.location.href = 'riskassessment.php';
                        }, 2000);
                    } else {
                        console.log(response);
                    }
                }
            });
            return(false)
        });
        $("#dob").datepicker();
    })
</script>
</body>
</html>
