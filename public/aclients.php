<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/10/15
 * Time: 3:25 PM
 */
session_start();
require_once('header.php');

use app\application\controller\agentController;

$agentObj = new agentController();

$agent_no = $_SESSION['ref_no'];

$data = $agentObj->agentClients($agent_no);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clients

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Clients</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box">
                <div class="box-header with-border">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">THESE ARE YOUR CLIENTS</h3>

                        </div>
                        <!-- /.box-header -->

                        <div class="box body table-responsive no-padding">
                            <table id="agentclientelle" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>MEMBER NO</th>
                                        <th>NAME</th>
                                        <th>MOBILE NO</th>
                                        <th>POSTAL ADDRESS</th>
                                        <th>TOWN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //print_r($data);
                                    foreach ($data as $result) {
                                        echo "<tr>";
                                        echo "<td><a href=#MemberDetails?id=" . $result->member_no . " id='" . $result->member_no . "'  class='btnCnfMem'>" . $result->member_no . "</a></td>";
                                        echo "<td>" . $result->allnames . "</td>";
                                        echo "<td>" . $result->gsm_no . "</td>";
                                        echo "<td>" . $result->post_address . "</td>";
                                        echo "<td>" . $result->town . "</td>";
                                        echo " </tr>";
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
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://icealion.com/"> ICEA LION GROUP</a>.</strong></a>
.</strong> All rights reserved.
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
<!-- Demo -->
<!--<script src="../assets/dist/js/demo.js" type="text/javascript"></script>-->


<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            //$(this).removeData();
            $("#details").html("");
        });
        $(".btnCnfMem").click(function () {
            $("#MemberDetails").modal({
                backdrop: true,
                keyboard: true
            });
            var member_id = $(this).attr('id');

            $.ajax({
                type: 'GET',
                url: '../helpers/getMemberDetails.php?member_id=' + member_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#details").append(data);
                    console.log(data);
                }
            });
        });

    });
</script>
<script type="application/javascript">
    $(document).ready(function () {
    $('#agentclientelle').dataTable({
    responsive: true,
    "bProcessing": true,
    "bPaginate": true,
    "sScrollY": "350px",
    "bRetrieve": true,
    "bFilter": true,
    "bJQueryUI": true,
    "bAutoWidth": true,
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
<div id="MemberDetails" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">MEMBER DETAILS</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <form id="modal-feedback" name="modal-feedback" action="../scripts/confirmMembers.php"
                          method="post">
                        <div class="form-group" id="details">

                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-folder-close"> Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>