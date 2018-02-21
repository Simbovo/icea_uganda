<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'header.php';

$data_ctl = new \application\library\Logger();
$activities = $data_ctl->displayLog();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User activity log's

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-home"></i>Home</a></li>

            <li class="active">Activities</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">User Activity</h3>
                    </div>
                    <div class="box-body with-border">
                        <div class="box body  box-warning">
                            <table class="table table-hover table-bordered" id="branches">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Branch Name</th>
                                        <th>Remote Address</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($activities as $activity) {
                                        echo "<tr>";
                                        echo "<td >" . $activity->username . "</td>";
                                        echo "<td >" . $activity->branch_name . "</td>";
                                        echo "<td >" . $activity->remote_address . "</td>";
                                        echo "<td >" . $activity->log_date . "</td>";
                                        echo "<td >" . $activity->user_action . "</td>";                                       
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
        e.preventDefault;
        $("#branches").DataTable();

    });
</script>
</body>
</html>