<?php


include('header.php');

use app\application\library\commonFunctions;
use application\controller\employeeController as employee;

$lib = new commonFunctions();
$empl = new employee();

$employees = $empl->systemStaff();




?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Transfer

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Transfer User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">Search Staff you want to transfer</h3>
                        <a href="confirmed-staff" role="button"
                           class="btn btn-large btn-primary pull-right"><i class="fa fa-users"></i>&nbsp;&nbsp;Confirmed
                            Staff</a>

                    </div>
                    <div class="box-body with-border">

                        <div class="box body  box-warning">
                            <table class="table table-hover table-bordered" id="user-transfer">
                                <thead>
                                <tr>
                                    <th>Ref. Number</th>
                                    <th>Name</th>
                                    <th>ID Number</th>
                                    <th>Date of Birth</th>
                                    <th>Department</th>
                                    <th>Transfer User</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($employees as $employee) {
                                    echo "<tr>";
                                    echo "<td >" . $employee->empcode . "</td>";
                                    echo "<td >" . $employee->fullnames . "</td>";
                                    echo "<td >" . $employee->idno . "</td>";
                                    echo "<td >" . $employee->dob . "</td>";
                                    echo "<td >" . $employee->deptcode . "</td>";
                                    echo "<td ><a href=#transfer?ref_id=" . $lib->encryptStringArray($employee->empcode, 'equity1290') . " id='" . $lib->encryptStringArray($employee->empcode, 'equity1290') . "' class='btn_transfer' data-toggle='modal'><i class = 'fa fa-plane'></i>&nbsp;&nbsp;Transfer user</a></td>";
                                    echo "</tr>";
                                }
                                ?>

                                </tbody>
                            </table>
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
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>

<!--Datatables plugins-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            $("#user_details").html("");
        });
        $('.btn_transfer').click(function () {
            $("#transfer").modal({
                backdrop: true,
                keyboard: true
            });
            var ref_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '../providers/transfer-provider.php?ref_id=' + ref_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#user_details").append(data);

                }
            });

            $("#modaluser").submit(function () {
                $("#waiting").slideDown();
                $.ajax({
                    type: 'POST',
                    url: '../helpers/transfer-helper',
                    data: $("#modaluser").serialize(),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $("#waiting").slideUp();
                        if (response == "empty_details") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Sorry, The request ended with an error. Please double check that the details are correct!</strong>");

                        } else if (response == "mailError") {
                            $(".alert").attr("class", "alert alert-info");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>There was an error sending emails. Please contact your network administrator for assistance!</strong>");

                        } else if (response == "transferred") {
                            $(".alert").attr("class", "alert alert-success");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The user has been successfully transferred pending approval!</strong>");
                            setTimeout(function () {
                                window.location.href = 'transfer-user'
                            }, 2000)
                        } else {
                            console.log(response);

                        }

                    }
                });
                return false;

            })
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("user-transfer").DataTable();
    });
</script>
<div id="transfer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Transfer User</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div id="waiting" style="display: none"><img src="../assets/images/loading.gif"/> Processing ...
                        Please wait
                    </div>
                    <div class="alert" style="display:none;">

                    </div>

                    <form id="modaluser" name="modal-feedback" action=""
                          method="post">
                        <div class="form-group" id="user_details">

                        </div>
                        <!-- <div class="form-group">
                              <label class="control-label">Reset Reason</label>
                              <textarea name="reason" id="reason" rows="3" cols="30" class="form-control"></textarea>
                          </div>-->

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="glyphicon glyphicon-arrow-right"></i> Transfer
                            </button>
                            <a href="transfer-user" class="btn btn-danger pull-right"> <i
                                    class="glyphicon glyphicon-close"></i>Close</a>

                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>

</div>
</body>
</html>