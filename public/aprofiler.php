<?php
include('header.php');

use app\application\controller\agentController;

$agent_obj = new agentController();

$details = $agent_obj->agentDetails();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Agent profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>

            <li class="active">Agent Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personal Basic Information</h3>
                    </div>
                    <div class="box-body">

                        <table class="table table-condensed table-bordered">
                            <tr class="info">
                                <th>Name:</th>
                                <th>ID Number:</th>
                                <th>PIN NO:</th>
                                <th>GENDER:</th>
                            </tr>
                            <tbody>
                                <tr>
                                    <td><?php echo $details->agent_name; ?></td>
                                    <td><?php echo $details->id_no; ?></td>
                                    <td><?php echo $details->pin_no; ?></td>
                                    <td><?php echo $details->gender; ?></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row-border">
                <div class="col-sm-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Contact Information</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <table class="table table-condensed table-bordered">
                                    <tr class="info">
                                        <th>Postal Address:</th>
                                        <th>Phone Number:</th>
                                        <th>Email Address:</th>
                                        <th>Town:</th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $details->postal_address; ?></td>
                                            <td><?php echo $details->mobile_no; ?></td>
                                            <td><?php echo $details->email; ?></td>
                                            <td><?php echo $details->town; ?></td>


                                        </tr>
                                    </tbody>
                                    <tr class="info">
                                        <th>TEL NO:</th>
                                        <th>Physical Address:</th>
                                        <th>Department:</th>
                                        <th>TERMS:</th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $tel_no; ?></td>
                                            <td><?php echo $physical_address; ?></td>
                                            <td><?php echo $dept; ?></td>
                                            <td><?php echo $terms; ?></td>
                                        </tr>

                                </table>


                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bank Information</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">

                                <table class="table table-condensed table-bordered">
                                    <tr class="info">
                                        <th>Bank Name:</th>
                                        <th>Branch:</th>
                                        <th>Account Name:</th>

                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $bankname; ?></td>
                                            <td><?php echo $branch; ?></td>
                                            <td><?php echo $accname; ?></td>


                                        </tr>
                                    </tbody>
                                    <tr class="info">
                                        <th>Account Number:</th>
                                        <th>Account Type:</th>
                                        <th>Town:</th>

                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $accno; ?></td>
                                            <td><?php echo $acctype; ?></td>
                                            <td><?php echo $bank_town; ?></td>
                                        </tr>

                                </table>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<footer class="main-footer">
    <?php include('extras/footnote.php'); ?>
</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js" type="text/javascript"></script>

<!-- Demo -->
<script src="../dist/js/demo.js" type="text/javascript"></script>
</body>
</html>