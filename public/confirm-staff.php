<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'header.php';

use application\controller\employeeController;

$staff = new employeeController();

$employees = $staff->notconfirmedEmployee();

$lib = new \app\application\library\commonFunctions();
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pending Staff

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Pending Staff</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">CONFIRM PENDING STAFF</h3>

                    </div>
                    <!-- /.box-header -->

                    <div class="box body">
                        <table class="table table-hover table-bordered table-responsive" id="onlineusers">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID Number</th>
                                    <th>PF Number</th>
                                    <th>Date of Birth</th>
                                    <th>Email Address</th>
                                    <th>Tel No</th>
                                    <th>Edit Details</th>
                                    <th>Confirm</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($employees as $employee) {
                                    echo "<tr>";

                                    echo "<td >" . $employee->fullnames . "</td>";
                                    echo "<td >" . $employee->idno . "</td>";
                                    echo "<td >" . $employee->pfno . "</td>";
                                    echo "<td >" . $employee->dob . "</td>";
                                    echo "<td >" . $employee->email . "</td>";
                                    echo "<td >" . $employee->htel . "</td>";
                                    echo "<td ><a href=edit-staff-details?ref_id=" . $lib->encryptStringArray($employee->empcode, 'equity1290') . " id=" . $employee->empcode . "><i class='fa fa-edit'></i> Edit Details</a></td>";
                                    echo "<td ><a href=#confirm?ref_id=" . $lib->encryptStringArray($employee->empcode, 'equity1290') . " id=" . $lib->encryptStringArray($employee->empcode, 'equity1290') . " class='btnuser' ><i class='fa fa-check'></i> Confirm Staff</a></td>";
                                    echo "</tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- /.row -->
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
<!--Modenizeer js-->
<!--<script src="../assets/dist/js/modernizr-jquery.min.js"></script>-->

<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--Datatables plugins-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../assets/plugins/datatables/datetime.js"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>

<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>


<script type="text/javascript">

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            $("#user_details").html("");
        });
        $('.btnuser').click(function () {
            $("#confirm").modal({
                backdrop: true,
                keyboard: true
            });
            var ref_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '../helpers/staff-details?token=' + ref_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#user_details").append(data);
                    //console.log(data);
                }
            });
            $("#staff-confirm").submit(function () {
                $("#waiting").slideDown();
                $.ajax({
                    type: 'POST',
                    url: '../helpers/confirm-staff.php',
                    data: $("#staff-confirm").serialize(),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $("#waiting").slideUp();
                        if (response == "failed") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Sorry, The request ended with an error. Please double check that the details are correct.!</strong>");
                            //window.location.href = "register_client.php";
                        } else if (response == "true") {
                            $(".alert").attr("class", "alert alert-success");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>User confirmation successful.!</strong>");
                            setTimeout(function () {
                                window.location.href = "confirm-staff";
                            }, 2000);
                        } else {
                            console.log(response);
                        }

                    }
                });
                return false;
            });
        });
    });</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#onlineusers").DataTable({
            columnDefs: [{
                    targets: 3,
                    render: $.fn.dataTable.render.moment('YYYY/MM/DD', 'Do MMM YY', 'fr')
                }],
            responsive: true,
            "bProcessing": true,
            "bPaginate": true,
            "sScrollY": "310px",
            "bRetrieve": true,
            "bFilter": true,
            "bJQueryUI": false,
            "bAutoWidth": false,
            "bInfo": true,
            "fnPreDrawCallback": function () {
                $("#details").hide();
                $("#loading").show();
            },
            "fnDrawCallback": function () {
                $("#details").show();
                $("#loading").hide();
            },
            "fnInitComplete": function () {
                //alert("Complete");
            }

        });
    });
</script>


<div id="confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Confirm Staff</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div id="waiting" style="display: none"><img src="../assets/images/loading.gif"/> Processing ...
                        Please wait
                    </div>
                    <div class="alert" style="display:none;">

                    </div>

                    <form id="staff-confirm" name="modal-feedback" action=""
                          method="post">
                        <div class="form-group" id="user_details">

                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="glyphicon glyphicon-check"></i> Confirm Staff
                            </button>
                            <a href="confirm-staff" class="btn btn-danger pull-right"> <i
                                    class="fa fa-close"></i>Close</a>

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



