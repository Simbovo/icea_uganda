<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/22/15
 * Time: 2:48 PM
 */
include('header.php');

use application\controller\memberController as Member;

$memberDetails  = new Member();
$member_no = $_SESSION['ref_no'];
$data  = $memberDetails->clientProfile($member_no);
//print_r($data);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php
        echo strtoupper($data->allnames);
        ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Member Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box">

                <div class="box-header with-border">
                    Your Personal and Bank Details
                </div>
                <div class="box body with-border">

                    <div class="row">
                        <div class="container" style="width:100%">


                            <div class="col-sm-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Personal Basic Information</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">

                                            <table class="table table-responsive table-bordered">
                                                <tr class="info">
                                                    <th>Name:</th>
                                                    <th>ID Number:</th>
                                                    <th>PIN NO:</th>
                                                    <th>GENDER:</th>
                                                </tr>
                                                <tbody>
                                                <tr>
                                                    <td><?php echo $data->allnames; ?></td>
                                                    <td><?php echo $data->id_no; ?></td>
                                                    <td><?php echo $data->pin_no; ?></td>
                                                    <td><?php echo $data->gender; ?></td>

                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>

                                </div>


                            </div>

                            <div class="col-sm-6">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Contact Information</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <table class="table table-responsive table-bordered">
                                                <tr class="info">
                                                    <th>Postal Address:</th>
                                                    <th>Phone Number:</th>
                                                    <th>Email Address:</th>
                                                    <th>Town:</th>
                                                </tr>
                                                <tbody>
                                                <tr>
                                                    <td><?php echo $data->post_address ?></td>
                                                    <td><?php echo $data->gsm_no; ?></td>
                                                    <td><?php echo $data->e_mail; ?></td>
                                                    <td><?php echo $data->town; ?></td>

                                                </tr>
                                                </tbody>
                                                <tr class="info">
                                                    <th>TEL NO:</th>
                                                    <th>Physical Address:</th>
                                                    <th>Department:</th>
                                                    <th>Terms:</th>
                                                </tr>
                                                <tbody>
                                                <tr>
                                                    <td><?php echo $data->tel_no; ?></td>
                                                    <td><?php echo $data->phys_adress; ?></td>
                                                    <td><?php echo $data->hse_no; ?></td>
                                                    <td><?php echo $data->terms; ?></td>

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

                                            <table class="table table-responsive table-bordered">
                                                <tr class="info">
                                                    <th>Bank Name:</th>
                                                    <th>Branch:</th>
                                                    <th>Account Name:</th>

                                                </tr>
                                                <tbody>
                                                <tr>
                                                    <td><?php echo $data->bankname; ?></td>
                                                    <td><?php echo $data->branch; ?></td>
                                                    <td><?php echo $data->accountname; ?></td>


                                                </tr>
                                                </tbody>
                                                <tr class="info">
                                                    <th>Account Number:</th>
                                                    <th>Account Type:</th>
                                                    <th>Town:</th>

                                                </tr>
                                                <tbody>
                                                <tr>
                                                    <td><?php echo $data->accountno; ?></td>
                                                    <td><?php echo $data->accounttype; ?></td>
                                                    <td><?php echo $data->banktown; ?></td>


                                                </tr>

                                            </table>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- ./col -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<footer class="main-footer">
   <?php include('extras/footnote.php');?>
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
<
</html>