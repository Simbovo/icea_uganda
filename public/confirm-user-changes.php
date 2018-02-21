<?php
include('header.php');

use app\application\library\commonFunctions;
use application\controller\employeeController as employee;

$lib = new commonFunctions();
$empl = new employee();

$employees = $empl->userChanges();
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

            <li class="active">Confirm User Changes</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">Confirmation</h3>
                        <a href="confirmed-staff" role="button"
                           class="btn btn-large btn-primary pull-right"><i class="fa fa-users"></i>&nbsp;&nbsp;Confirmed
                            Staff</a>

                    </div>
                    <div class="box-body with-border">
                        <div class="waiting" style="display: none;">
                            <center><img src="../assets/images/loading.gif"> Verifying ...</center>
                        </div>
                        <div class="alert" style="display: none"></div>

                        <div class="box body  box-warning">
                            <table class="table table-hover table-bordered" id="user-change">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>User Type</th>
                                        <th>Branch Name</th>
                                        <th>Status</th>
                                        <th>Confirm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($employees as $employee) {
                                        if ($employee->DISBALED == 1) {
                                            $change = "DISABLED";
                                        } elseif ($employee->DELETED == 1) {
                                            $change = "DELETED";
                                        }
                                        echo "<tr>";
                                        echo "<td>" . $employee->USERNAME . "</td>";
                                        echo "<td>" . $employee->USER_TYPE . "</td>";
                                        echo "<td>" . $employee->BRANCHNAME . "</td>";
                                        echo "<td>" . $change . "</td>";
                                        if ($change == "DISABLED") {
                                            echo "<td><a href=../helpers/user-changes?token=" . $lib->encryptStringArray($employee->USER_ID, 'equity1290') ."&action=".$change." class='action-link'><i class = 'fa fa-check'></i>&nbsp;&nbsp;Confirm</a></td>";
                                        } else {
                                            echo "<td><a href=../helpers/user-changes?token=" . $lib->encryptStringArray($employee->USER_ID, 'equity1290') . "&action=".$change." class='action-link'><i class = 'fa fa-check'></i>&nbsp;&nbsp;Confirm</a></td>";
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
   $(function(){
       $('.action-link').click(function(){
           $.get($(this).attr('href'), function(response){
               alert(response);
           });
           return false;
       });
   });
</script>

<script type="text/javascript">
    $(document).ready(function (e) {
        $("user-change").dataTable();
    });
</script>
</body>
</html>