<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require 'header.php';

$emplobj = new \application\controller\employeeController();

$employees = $emplobj->systemStaff();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Staff Information

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Staff Information</li>
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
                                <h3 class="box-title">ALL CONFIRMED STAFF</h3>

                                <a href="add-staff" role="button"
                                   class="btn btn-large btn-primary pull-right"><i class="fa fa-plus"></i> Register New
                                    Staff</a>

                            </div>
                            <!-- /.box-header -->

                            <div class="box body no-padding box-warning">
                                <div class="dataTables_wrapper table-responsive">
                                    <table class="table table-hover table-bordered table-condensed" id="onlineusers">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>ID Number</th>
                                            <th>User Type</th>
                                            <th>Mobile Number</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Branch Registration</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($employees as $employee) {
                                            $webpass = $employee->webpass;
                                            echo "<tr>";
                                            echo "<td>" . $employee->fullname . "</td>";
                                            echo "<td>" . $employee->idno . "</td>";
                                            echo "<td>" . $employee->user_type . "</td>";
                                            echo "<td>" . $employee->htel . "</td>";
                                            echo "<td>" . $employee->email . "</td>";
                                            echo "<td>" . $employee->deptcode . "</td>";
                                            if ($webpass == 1) {
                                                echo "<td><button class='btn btn-success'>User is registered </button></td>";
                                            } else {
                                                echo "<td><a href=#onlineaccess?id=" . $employee->empcode . " id=" . $employee->empcode . " class='btnonline' ><i class='fa fa-user-plus'></i>&nbsp; Branch Registration</a></td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--/.box-->
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
        $('.btnonline').click(function () {
            $("#onlineaccess").modal({
                backdrop: true,
                keyboard: true
            });
            var ref_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '../helpers/system-staff?token=' + ref_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#user_details").append(data);
                }
            });

            $("#staff-confirm").submit(function () {
                $("#waiting").slideDown();


                $.ajax({
                    type: 'POST',
                    url: '../helpers/online-access',
                    data: $("#staff-confirm").serialize(),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $("#waiting").slideUp();
                        if (response == "error") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Sorry, The request ended with an error. Please double check that the details are correct.!</strong>");
                            //window.location.href = "register_client.php";
                        } else if (response == "registered") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Sorry, The user you are tyring to register is already registered!</strong>");
                            //window.location.href = "register_client.php";
                        } else if (response == "success") {
                            $(".alert").attr("class", "alert alert-success");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>User confirmation successful.!</strong>");
                            setTimeout(function () {
                                window.location.href = "system-users";
                            }, 2000);
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
            "sScrollY": "310px",
            "bRetrieve": true,
            "bFilter": true,
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


<div id="onlineaccess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                    class="glyphicon glyphicon-check"></i>Register Staff
                            </button>
                            <a href="system-users" class="btn btn-danger pull-right"> <i
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





