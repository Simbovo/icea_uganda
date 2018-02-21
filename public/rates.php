<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/23/15
 * Time: 10:16 AM
 */
include('header.php');

use application\controller\dataController as Data;

$rates_data = new Data();

$rates = $rates_data->viewRates();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fund Interest Rates

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Rates</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">

                    <div class="box-header with-border">
                        Confirmed Interest Rates
                    </div>
                    <div class="box-body with-border">

                        <table class="table table-striped table-bordered table-hover" id="interest-view">
                            <thead>
                                <tr class="success">
                                    <td>RATE ID</td>
                                    <td>RATE DATE</td>
                                    <td>PRODUCT NAME</td>
                                    <td>APPLICABLE RATE</td>
                                    <td>POSTED BY</td>
                                </tr>
                            </thead>
                            <tbody>

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
<!--Data Table js-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- Demo -->
<!--<script src="../assets/dist/js/demo.js" type="text/javascript"></script>-->

<script type="text/javascript">
    $(function () {
        $("#interest-view").dataTable({
            "bProcessing": true,
            "sAjaxSource": '../providers/nav_rates_minion.php?token=rates',
            "oLanguage": {
                "sProcessing": "Processing all rates..."
            },
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pagingType: 'full_numbers'
        });
    })
</script>
</body>
</html>