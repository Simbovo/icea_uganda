<?php
require('header.php');

use application\controller\companyController;
use application\controller\dataController;

$impl = new companyController();

$branches = $impl->viewBranches();


$branch = new dataController();
$towns = $branch->townList();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            BANK BRANCHES

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">CIC Asset Branches</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">View and edit Branch Details</h3>
                        <a href="#add-branch" data-toggle="modal"  role="button"
                           class="btn btn-large btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add new
                            Branch</a>

                    </div>
                    <div class="box-body">

                        <table class="table table-bordered table-hover" id="branches">
                            <thead>
                                <tr>
                                    <th>Branch Code</th>
                                    <th>Branch Name</th>
                                    <th>Town</th>
                                    <th>Contact Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($branches as $branch) {
                                    echo "<tr>";
                                    echo "<td >" . $branch->branchid . "</td>";
                                    echo "<td >" . $branch->branchname . "</td>";
                                    echo "<td >" . $branch->town . "</td>";
                                    echo "<td >" . $branch->contactname . "</td>";
                                    echo "<td ><a href=#pwdreset?ref_id=" . $branch->USERNAME . " id=" . $branch->REFNO . " class='btnuser' ><i class='fa-fa-edit'></i>&nbsp;Edit</a></td>";
                                    echo "</tr>";
                                }
                                ?>

                            </tbody>
                        </table>

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
    jQuery(document).ready(function (e) {
        $("#branches").DataTable();

    });
</script>
<script type="text/javascript">
    $(document).ready(function (event) {
        //event.preventDefault();
        $("#add_branch").submit(function () {
            var form_data = new Object;
            form_data.branch_code = $("#branch_code").val();
            form_data.branch_name = $("#branch_name").val();
            form_data.town = $("#town").val();
            $(".waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: '../helpers/add-branch',
                data: "data="+JSON.stringify(form_data),
                error: function (error_response) {
                    console.log(error_response);
                },
                success: function (success_response) {
                    $(".waiting").slideUp();
                    var data = JSON.parse(success_response);
                    if (data.Status == "failed") {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Info!</strong> " + data.Message);
                    } else if (data.Status = "success") {
                        $(".alert").attr("classs", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Success!></strong>" + data.Message);
                        setTimeout(function(){
                            window.location.href= data.Location;
                        },2500);
                    } else {
                        console.log(data.Message);
                    }
                }
            });
            return false;
        });
    });
</script>
<div class="modal fade" id="add-branch" tabindex="-1" role="dialog" aria-labelledby="AddBranch" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Add a branch</h5>
            </div>

            <div class="modal-body">
                <!-- The form is placed inside the body of modal -->
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

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save details</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>