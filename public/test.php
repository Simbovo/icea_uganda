<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ob_start();
include 'header.php';

use app\application\controller\accountController;
use application\controller\memberController;

$acc = new accountController();
$member = new memberController();


?>
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Individual Account Information

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Transaction Panel</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box">

                <div class="box-header with-border">
                    <h3>Transactions Panel </h3>
                </div>
                <div class="box body no-border">

                    <div class="panel-body">
                        <fieldset style="-moz-background-origin: #ff6600">
                            <div id="waiting" style="display:none;">
                                <center><img src='../assets/images/loading.gif'> Verifying...</center>
                            </div>
                            <div class="row">
                                <form name="acc_reg" id="acc_reg" method="post" action="">
                                    <div class="form-group">
                                        <label class="control-label" for="account">Account Number</label>
                                        <input type="text" name="account" id="account"/>

                                    </div>
                                </form>
                            </div>

                        </fieldset>


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a
            href="https://clients.cic.co.ke"><?php echo $_SESSION['comp_name']; ?>
        </a>.</strong> All rights reserved.
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

</script>
</body>
</html>
