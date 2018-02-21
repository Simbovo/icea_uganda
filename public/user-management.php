<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/23/15
 * Time: 1:35 AM
 */
session_start();
include('header.php');

use app\application\library\commonFunctions;
use application\controller\employeeController;

$members = new employeeController();
$lib = new commonFunctions();
$online_users = $members->manageUsers();
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Online Staff

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Online Staff</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">REGISTERED ONLINE STAFF</h3>

                    </div>
                    <!-- /.box-header -->

                    <div class="box body table-responsive no-padding">
                        <table class="table table-hover table-bordered" id="onlineusers">
                            <thead>
                            <tr class="info">
                                <th>USERNAME</th>
                                <th>SURNAME</th>
                                <th>BRANCH</th>
                                <th>REVOKE ACCESS</th>
                                <th>DELETE</th>
                                <th>TRANSFER USER</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            foreach ($online_users as $online_user) {
                                echo "<tr>";
                                echo "<td>" . $online_user->USERNAME . "</td>";
                                echo "<td>" . $online_user->SURNAME . "</td>";
                                echo "<td>" . $online_user->BRANCHNAME . "</td>";
                                echo "<td><a href=#revoke_user?ref_id=" . $lib->encryptStringArray($online_user->USERNAME,'equity1290') . " id=" . $lib->encryptStringArray($online_user->USER_ID, 'equity1290') . " class='btn-revoke' ><i class='fa fa-ban'></i>&nbspRevoke User</a></td>";
                                echo "<td><a href=#delete_user?ref_id=" . $lib->encryptStringArray($online_user->USERNAME,'equity1290') . " id=" . $lib->encryptStringArray($online_user->USER_ID, 'equity1290') . " class='btn-delete' ><i class='fa fa-ban'></i>&nbspDelete User</a></td>";
                                echo "<td><a href=transfer-user><i class='fa fa-plane'></i>&nbsp;Transfer User</a></td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
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
        //clear the modal for new request
        $(".modal").on("hidden.bs.modal", function () {
            $("#user_details").html("");
        });
        $('.btn-revoke').click(function () {
            $("#revoke_user").modal({
                backdrop: true,
                keyboard: true
            });
            var ref_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '../helpers/staffDetails.php?token=' + ref_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#user_details").append(data);
                    //console.log(data);
                }
            });

            $("#modal_revoke").submit(function () {
                $("#waiting").slideDown();
                $.ajax({
                    type: 'POST',
                    url: '../helpers/revoke-user.php',
                    data: $("#modal_revoke").serialize(),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $("#waiting").slideUp();
                        if (response == "save_error") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Sorry, The request ended with an error. Please double check that the details are correct.!</strong>");

                        } else if (response == "MailError") {
                            $(".alert").attr("class", "alert alert-info");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>There was an error sending emails. Please contact your network administrator for assistance.!</strong>");

                        } else if (response == "success") {
                            $(".alert").attr("class", "alert alert-success");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The user password has been successfully reset.!</strong>");
                            setTimeout(function () {
                                window.location.href = 'online-users'
                            }, 2000)
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
        //clear the modal for new request
        $(".modal").on("hidden.bs.modal", function () {
            $("#user_details").html("");
        });
        $('.btn-delete').click(function () {
            $("#delete_user").modal({
                backdrop: true,
                keyboard: true
            });
            var ref_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '../helpers/staffDetails.php?token=' + ref_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#delete_details").append(data);
                    //console.log(data);
                }
            });

            $("#modal_delete").submit(function () {
                $("#waiting").slideDown();
                $.ajax({
                    type: 'POST',
                    url: '../helpers/delete-user.php',
                    data: $("#modal_delete").serialize(),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $("#waiting").slideUp();
                        if (response == "save_error") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Sorry, The request ended with an error. Please double check that the details are correct.!</strong>");

                        } else if (response == "MailError") {
                            $(".alert").attr("class", "alert alert-info");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>There was an error sending emails. Please contact your network administrator for assistance.!</strong>");

                        } else if (response == "success") {
                            $(".alert").attr("class", "alert alert-success");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The user password has been successfully reset.!</strong>");
                            setTimeout(function () {
                                window.location.href = 'online-users'
                            }, 2000)
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
            "sScrollY": "400px",
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


<div id="revoke_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Revoke Staff Access</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div id="waiting" style="display: none"><img src="../assets/images/loading.gif"/> Processing ...
                        Please wait
                    </div>
                    <div class="alert" style="display:none;">

                    </div>

                    <form id="modal_revoke" name="modal-feedback" action=""
                          method="post">
                        <div class="form-group" id="user_details">

                        </div>
                        <div class="form-group">
                            <label class="control-label">Revoke Reason</label>
                            <textarea name="reason" id="reason" rows="3" cols="30" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="glyphicon glyphicon-refresh"></i> Revoke staff access
                            </button>
                            <a href="user-management" class="btn btn-danger pull-right"> <i
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
<div id="delete_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Delete staff from system</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div id="waiting" style="display: none"><img src="../assets/images/loading.gif"/> Processing ...
                        Please wait
                    </div>
                    <div class="alert" style="display:none;">

                    </div>

                    <form id="modal_delete" name="modal-feedback" action=""
                          method="post">
                        <div class="form-group" id="delete_details">

                        </div>
                        <div class="form-group">
                            <label class="control-label">Delete Reason</label>
                            <textarea name="reason" id="reason" rows="3" cols="30" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="glyphicon glyphicon-refresh"></i> Delete staff
                            </button>
                            <a href="user-management" class="btn btn-danger pull-right"> <i
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