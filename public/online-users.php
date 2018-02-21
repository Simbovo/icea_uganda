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
use application\controller\memberController;

$members = new memberController();
$url = new commonFunctions();

$online_users = $members->getOnlineUsers();


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Online Users

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Online Users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">REGISTERED ONLINE USERS</h3>

                            </div>
                            <!-- /.box-header -->

                            <div class="box body table-responsive no-padding">
                                <table class="table table-hover table-bordered" id="onlineusers">
                                    <thead>
                                    <tr class="info">
                                        <th>REFERENCE NO</th>
                                        <th>USERNAME</th>
                                        <th>EMAIL ADDRESS</th>
                                        <th>CATEGORY</th>
                                        <th>RESET PASSWORD</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($online_users as $online_user) {
                                        echo "<tr>";
                                        echo "<td >" . $online_user->refno . "</td>";
                                        echo "<td >" . $online_user->username . "</td>";
                                        echo "<td >" . $online_user->e_mail . "</td>";
                                        echo "<td >" . $online_user->category . "</td>";
                                        echo "<td ><a href=#pwdreset?ref_id=" . $url->encryptStringArray($online_user->username, '7800') . " id=" . $online_user->username . " class='btnuser' >Reset User Password</a></td>";
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

<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<!--Datatables plugins-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            $("#user_details").html("");
        });
        $('.btnuser').click(function () {
            $("#pwdreset").modal({
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

            $("#modaluser").submit(function () {
                $(".waiting").slideDown();
                $.ajax({
                    type: 'POST',
                    url: '../helpers/forgot_pwd.php',
                    data: $("#modaluser").serialize(),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $(".waiting").slideUp();
                        var data = JSON.parse(response);
                            $(".waiting").slideUp();
                            if (data.status == "ok") {
                                $(".alert").attr("class", "alert alert-success");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Ok! </strong>" + data.message);
                                setTimeout(function(){
                                    window.location.href = online-users;
                                }, 2000);
                            } else if (data.status == "fail") {
                                $(".alert").attr("class", "alert alert-danger");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Info!</strong>" + data.message);
                                
                            } else if (data.status == "error") {
                                $(".alert").attr("class", "alert alert-danger");
                                $(".alert").slideDown();
                                $(".alert").html("<strong>Info!</strong>" + data.message);
                            } else {
                                console.log(data.message);
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

<div id="pwdreset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Reset user password</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div class="waiting" style="display: none;"><img src="../assets/images/ajax-loader-bar.gif"/>Processing</div>
                    <div class="alert" style="display:none;"></div>

                    <form id="modaluser" name="modal-feedback" action=""
                          method="post">
                        <div class="form-group" id="user_details">

                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="glyphicon glyphicon-refresh"></i> Reset user password
                            </button>
                            <a href="online-users" class="btn btn-danger pull-right"> Close</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>