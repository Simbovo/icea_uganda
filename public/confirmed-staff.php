<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('header.php');

use app\application\library\commonFunctions;
use application\controller\employeeController;

$lib = new commonFunctions();
$empl = new employeeController();

$employees = $empl->confirmedEmployees();

//var_dump($employees);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Confirmed Staff

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Confirmed Staff</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header with-border">

                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">CONFIRMED STAFF PENDING SYSTEM REGISTRATION</h3>
                                <a href="transfer-user" role="button"
                                   class="btn btn-large btn-primary pull-right"><i class="fa fa-plane"></i>Transfer User</a>
                            </div>
                            <!-- /.box-header -->

                            <div class="box body  box-warning">
                                <table class="table table-hover table-bordered" id="onlineusers">
                                    <thead>
                                    <tr>
                                        <th>Ref. Number</th>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>Date of Birth</th>
                                        <th>Department</th>
                                        <th>Add as User</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($employees as $employee) {
                                        echo "<tr>";
                                        echo "<td >" . $employee->empcode . "</td>";
                                        echo "<td >" . $employee->fullnames . "</td>";
                                        echo "<td >" . $employee->id_no. "</td>";
                                        echo "<td >" . $employee->dob . "</td>";
                                        echo "<td >" . $employee->deptcode . "</td>";
                                        echo "<td ><a href=add-as-user?ref_id=" . $lib->encryptStringArray($employee->empcode, 'equity1290') . "><i class = 'fa fa-user-plus'></i> Add as User</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    <?php
    include('extras/footnote.php');
    ?>
</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>

</div>
<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/dist/js/modernizr-jquery.min.js"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>

<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<!--Datatables plugins-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            $("#user_details").html("");
        });
        $('.btnuser').click(function () {
            $("#addasuser").modal({
                backdrop: true,
                keyboard: true
            });
            var ref_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '../helpers/onlineUserHelper.php?ref_id=' + ref_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#user_details").append(data);
                    //console.log(data);
                }
            });

            $("#modalAdduser").submit(function () {
                $("#waiting").slideDown();
                $.ajax({
                    type: 'POST',
                    url: '../helpers/addAsUser.php',
                    data: $("#modalAdduser").serialize(),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $("#waiting").slideUp();
                        if (response == "save_error") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Sorry, The request ended with an error. Please double check that the details are correct.!</strong>");
                            //window.location.href = "register_client.php";
                        } else if (response == "MailError") {
                            $(".alert").attr("class", "alert alert-info");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>There was an error sending emails. Please contact your network administrator for assistance.!</strong>");
                            //window.location.href = "register_client.php";
                        } else if (response == "success") {
                            $(".alert").attr("class", "alert alert-success");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The user password has been successfully reset.!</strong>");
                            //window.location.href = "register_client.php";
                        } else {
                            console.log(response);

                        }

                    }
                });
                return false;

            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#onlineusers").DataTable({
            responsive: true,
            "bProcessing": true,
            "bPaginate": true,
            "sScrollY": "350px",
            "bRetrieve": true,
            "bFilter": true,
            "bJQueryUI": false,
            "bAutoWidth": false,
            "bInfo": true,
            "fnPreDrawCallback": function () {
                $("#details").hide();
                $("#loading").show();
                //alert("Pre Draw");
            },
            "fnDrawCallback": function () {
                $("#details").show();
                $("#loading").hide();
                //alert("Draw");
            },
            "fnInitComplete": function () {
                //alert("Complete");
            }

        });
    });
</script>


<div id="addasuser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Reset user password</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div id="waiting" style="display: none"><img src="../assets/images/loading.gif"/> Processing ...
                        Please wait
                    </div>
                    <div class="alert" style="display:none;">

                    </div>

                    <form id="modalAdduser" name="modal-feedback" action=""
                          method="post">
                        <div class="form-group" id="user_details">

                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="glyphicon glyphicon-refresh"></i> Reset user password
                            </button>
                            <a href="employees" class="btn btn-danger pull-right"> <i
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


