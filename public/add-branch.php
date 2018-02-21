<?php


require('header.php');

use application\controller\dataController;

$branch = new dataController();
$towns = $branch->townList();

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CIC GROUP BRANCHES

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Bank Branches</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">

            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">View and edit Branch  Details</h3>
                        <a href="branches" role="button"
                           class="btn btn-large btn-primary pull-right"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Branches</a>

                    </div>
                    <div class="box-body with-border box-warning">


                        <div class="waiting" style="display: none;">
                            <img src="../assets/images/loading.gif" style="text-align: center"> <span
                                class="fa fa-refresh fa-2x"></span>
                        </div>
                        <div class="alert" style="display: none"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <form name="add_branch" id="add_branch" method="post" action="" data-toggle="validator">
                                <div class="form-group-sm">
                                    <div class="form-group">
                                        <label class="control-label" for="branch_name">Branch Name</label>
                                        <input class="form-control" name="branch_name" id="branch_name" type="text"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="branch_code">Branch Code</label>
                                        <input class="form-control" pattern="[0-9]{1,}" name="branch_code"
                                               id="branch_code" type="text"
                                               data-error="Name should not contain numerical values." required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="town">
                                            Town
                                        </label>
                                        <select name="town" id="town" class="form-control">
                                            <option value="">--Please select town --</option>
                                            <?php
                                            foreach ($towns as $town) {

                                                echo "<option value='" . $town->tname . "'>" . $town->tname . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-primary">Save Branch
                                    </button>
                                    <a href="branches>"
                                       class="btn btn-warning"> <i class="fa fa-cancel"></i> Cancel</a>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3"></div>

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
</div>
<!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


<!--Datatables plugins-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function (e) {
        e.preventDefault;
        $("#add_branch").submit(function () {
            var data = new Object;
            data.branch_code = $("#branch_code").val();
            data.branch_name = $("#branch_name").val();
            data.town = $("#town").val();
            $(".waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: "../helpers/add-branch.php",
                data: "data=" + JSON.stringify(data),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $(".waiting").slideUp();
                    if (response == "successful") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>The town has been registered succesfuly </strong>");
                        setTimeout(function(){
                            window.location = "branches";
                        },2000);
                    } else if (response == "failed") {
                        $(".alert").html("<div class='alert alert-danger'><strong>Success!!</strong>Branch registration not successful, please try aagain</div>");
                    } else {
                        $(".alert").html("<div class='alert alert-danger'><strong>Error saving branch details</strong></div>");
                    }
                    //console.log(response);
                }
            });
            return false;
        });
    });
</script>
</body>
</html>