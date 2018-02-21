<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/24/15
 * Time: 8:52 AM
 */
include('header.php');

use app\application\controller\transactionController;

$trx = new transactionController();

$transactions = $trx->todayTransactions();


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Transaction Report Per Fund

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Transaction Reports</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                    Showing transactions done today
                    </div>
                    <div class="box body box-warning with-border">
                        <table class="table table-condensed table-responsive table-bordered" id="transactions">
                            <thead>
                            <tr>
                                <th>Trans ID</th>
                                <th>Member No</th>
                                <th>Full Names</th>
                                <th>Reference ID</th>
                                <th>Trans Date</th>
                                <th>Fund Name</th>
                                <th style="text-align: right;"> Amount (Ksh)</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th colspan="6" style="text-align:right">Total:</th>
                                <th style="text-align: right"></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            foreach ($transactions as $trans) {
                                echo "<tr>";
                                echo "<td >" . $trans->trans_id . "</td>";
                                echo "<td >" . $trans->member_no . "</td>";
                                echo "<td >" . $trans->full_name . "</td>";
                                echo "<td >" . $trans->doc_no . "</td>";
                                echo "<td >" . $trans->trans_date . "</td>";
                                echo "<td >" . $trans->portfolio . "</td>";
                                echo "<td style='text-align: right;'>" . $trans->amount . "</td>";
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
<!-- Bootstrap Datepicker js-->
<script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!--Data Table js-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/extensions/pluginsum/sum.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript"
        src="../assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>

<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>


<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#transactions").DataTable({
            "footerCallback": function () {
                var api = this.api();
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                // Total over all pages
                total = api
                    .column(6)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                // Total over this page
                pageTotal = api
                    .column(6, {page: 'current'})
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                // Update footer
                $(api.column(6).footer()).html(
                    'Ksh ' + pageTotal //'( Ksh' + total + ' total)'
                );
            }

        });
    });
</script>
</body>
</html>