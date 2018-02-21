<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/20/15
 * Time: 7:10 PM
 */
require('../app/Loader.php');
include("header.php");

use app\application\library\commonFunctions;
use application\controller\memberController;

$lib = new commonFunctions();

$data = new memberController();

$members = $data->SingleRegisteredMembers();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registered Members

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Member Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        Single Registered Members
                        <a href="registered-members" role="button"
                           class="btn btn-large btn-primary pull-right"><i class="fa fa-eye"></i> View Members</a>
                    </div>
                    <div class="box body with-border">
                        <table class="table table-responsive table-hover table-stripped" id="singlemembers">
                            <thead>
                            <tr>

                                <th>Member No:</th>
                                <th>Full names:</th>
                                <th>REG DATE:</th>
                                <th>D.O.B:</th>
                                <th>ID NO:</th>
                                <th>PIN NO:</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($members as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row->MEMBER_NO; ?></td>
                                    <td>
                                        <a href="individual-account?id=<?= $lib->encryptStringArray($row->MEMBER_NO, 'equity1290'); ?>"><?php echo $row->ALLNAMES; ?></a>
                                    </td>
                                    <td><?php echo $row->REG_DATE; ?></td>
                                    <td><?php echo $row->DOB; ?></td>
                                    <td><?php echo $row->ID_NO; ?></td>
                                    <td>
                                        <a href="individual-account?id=<?= $lib->encryptStringArray($row->MEMBER_NO, 'equity1290'); ?>">Transact </a>
                                    </td>
                                </tr>
                                <?php
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
    <?php
    include('extras/footnote.php');
    ?>
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
<!--Data Table js-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- Demo -->
<!--<script src="../assets/dist/js/demo.js" type="text/javascript"></script>-->

<script type="text/javascript">
    $(function () {
        $("#singlemembers").dataTable();
    })
</script>
</body>
<</html>