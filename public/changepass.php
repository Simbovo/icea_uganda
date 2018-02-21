<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/2/15
 * Time: 10:41 AM
 */
session_start();
require('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Changing Password

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Change password</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Change Password</h3>

                    </div>
                    <!-- /.box-header -->
                    <form action="" method="POST" data-toggle="validator" id="changepass" name="changepass">
                    <div class="box-body">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div id="waiting" style="display: none">
                                    <center><img src='../assets/images/ajax-loader-bar.gif'> Processing...Please wait</center>
                                </div>


                                <div class="form-group">
                                    <label class="control-label" for="currpass">Current Password:</label>
                                    <input class="form-control" name="currpass" id="currpass"
                                    data-minlength="6" type="password" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="text">Password:</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                    data-error="Please fill in the password." required data-minlength="6"/>
                                    <span class="help-block with-errors"></span>

                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="text"> Confirm Password:</label>
                                    <input type="password" name="Cpassword" class="form-control"
                                    data-match="#password"
                                    data-match-error="Passwords do not match!" required id="Cpass"
                                    data-error="Please fill in the password."/>
                                    <span class="help-block with-errors"></span>

                                </div>
                                <div class="form-group">

                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                    <input type="reset" class="btn btn-danger" name="reset" value="Reset">
                                    <a href="dashboard" class="btn btn-warning"> Cancel</a> 
                                </div>

                            </div>
                        </form>

                    </div>

                    <!--                                    <a href="feedback">-->
                </div>


            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.box-footer-->
</div>
<!-- /.box -->


<!-- /.content -->
<!-- /.content-wrapper -->

<footer class="main-footer">

</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class='control-sidebar-bg'></div>
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
   <script>
    //start ajax
    $(document).ready(function (e) {
        $("#changepass").submit(function () {
            $("#waiting").slideDown();
            $.ajax({
                //ajax options
                type: 'POST',
                url: "../helpers/changepass",
                //select * form data
                data: $("#changepass").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    //$("#waiting").html();
                    if (response == "error_match") {
                        $("#waiting").html("<div class='alert alert-danger'><strong>Error!! </strong>Password do not match our records.</div>");
                        //window.location = "index.php";
                    }
                    else if (response == "success") {
                        $("#waiting").html("<div class='alert alert-success'><strong>Password Changed!! </strong>Please check your email.</div>");
                        window.location = "logout.php";
                    }
                    else if (response == "MailError") {
                        $("#waiting").html("<div class='alert alert-danger'><strong>Error!! </strong>There was an error sending your email Please try again later.</div>");

                    }
                    else if (response == "failed") {
                        $("#waiting").html("<div class='alert alert-danger'><strong>ERROR!! </strong>Mail not send, please try again.</div>");

                    }
                    else if (response == "error_password") {
                        $("#waiting").html("<div class='alert alert-danger'><strong>ERROR!! </strong>Mail not send, please try again.</div>");

                    }
                    else {
                        $("#waiting").html("<div class='alert alert-danger'><strong>ERROR!! </strong>" + response + "</div>");
                    }

                    console.log(response);
                }
            })
            return false;
        })

    });
</script>
</body>
</html>
