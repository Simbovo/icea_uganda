<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/16/15
 * Time: 4:31 PM
 */
require('../app/Loader.php');

include('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Member Registration

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Member Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box box-warning">

                <div class="box-header with-border">

                </div>
                <div class="box-body with-border">
                </div>
            </div>

            <div class="col-sm-12">

                <ul id="tabs" class="nav nav-tabs nav-justified" data-tabs="tabs">

                    <li class="active"><a data-toggle="tab" href="#sectionA"> Single Member Registration</a></li>

                    <li><a data-toggle="tab" href="#sectionB" id="posted_navs"></i>
                            Joint Member Registration </a></li>
                    <li><a data-toggle="tab" href="#sectionB" id="posted_navs"></i>
                            Club Member Registration  </a></li>
                </ul>


                <div class="tab-content" style="width:100%;">
                    <div id="sectionA" class="tab-pane fade in active">
                        <div class="well">
                            <form method="post" action="" id="single-registration" class="form-inline"
                                  data-toggle="validator">
                                <div class="form-group">
                                    <label class="sr-only" for="cifId">Client CIF ID</label>
                                    <input type="text" class="form-control" required="required" name="cifId" id="cifId"
                                           placeholder="Client CIF ID"
                                           data-error="The CIF should not contain any characters"
                                           pattern="[0-9]{11}">

                                    <div class="help-block with-errors"></div>
                                </div>

                                <button type="submit" class="btn btn-info">Get Details</button>

                            </form>
                        </div>
                    </div>
                    <div id="sectionB" class="tab-pane fade">
                        <div id="load" style=" width: 100%;">
                            <div class="well" style="width:100%;">
                                <form method="post" action="" id="joint" class="form-inline">
                                    <div class="form-group">
                                        <label for="accno" class="sr-only">Account Number</label>
                                        <input type="text" class="form-control" id="accno" name="accno"
                                               required="required" placeholder="Account Number"
                                               data-error="The account number should not contain any characters"
                                               pattern="[0-9]{13}">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <button type="submit" class="btn btn-info">Get Details</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="row">
            <div class="box box-warning">

                <div class="box-header with-border">
                    Customer Details
                </div>
                <div class="box-body with-border">
                    <div class="waiting" style="display:none;">
                        <center><img src='../assets/images/loading.gif'> Processing...</center>
                    </div>
                    <div class="alert alert-danger alert-dismissable" style="display:none;">
                        <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">
                            &times;
                        </button>
                    </div>
                    <div id="show-results">
                    </div>
                </div>


            </div>
        </div>
    </section>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<footer class="main-footer">
    <?php include('extras/footnote.php'); ?>
</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!--Validator and holder-->
<script src="../assets/bootstrap/js/validator.min.js" type="text/javascript"></script>
<script src="../assets/dist/js/holder.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>

<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function (e) {
        $("#single-registration").submit(function () {
            $(".waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: "../helpers/getCustDetails.php",
                data: $("#single-registration").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {

                    $(".waiting").slideUp();

                    if(response == "member_exists"){
                        $(".alert").attr("class", "alert alert-info alert-dismissable");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>The member already exists, please input another CIF id!</strong>");
                    }else if(response == "not_exixts"){
                        $(".alert").attr("class", "alert alert-info alert-dismissable");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>The CIF ID you entered doest not exit! Please try again another CIF </strong>");
                    }else{
                        $("#show_results").html(response);
                    }

                    console.log(response);

                }
            });
            return false;
        });
    });
</script>
</body>
</html>