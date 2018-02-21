<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/24/15
 * Time: 8:52 AM
 */
include('header.php');


use application\controller\dataController;

$data_obj = new dataController();

$sucurities =  $data_obj->getSecDetails();


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Transaction Report Per Fund

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i>Home</a></li>

            <li class="active">Transaction Reports</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box">

                <div class="box-header with-border">

                </div>
                <div class="box body with-border">
                    <div class="container-fluid">

                        <form novalidate name="report-Form" method="GET" id="report-Form">
                            <fieldset
                                style="-webkit-border-top-right-radius: 5px; -webkit-border-top-left-radius: 5px; background-color: #ffffff">
                                <div class="col-sm-3">
                                    <div class="form-group">

                                        <label for="report_type" class="control-label">Fund Portfolio:</label>
                                        <select name="report_type" id="report_type" class="form-control">
                                            <option value="">---Select Fund Portfolio---</option>
                                            <?php
                                            foreach ($securities as $data) {
                                                echo "<option value='" . $data->descript . "'>" . $data->descript . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="startDate">Start Date</label>

                                            <div class="input-group">
                                                <input type="datetime" id="startDate" name="startDate"
                                                       class="form-control"/>
                                                <input type="hidden" name="report" id="report" value="transactions">
                                                <span class="input-group-addon add-on"><span
                                                        class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="endDate">End Date</label>

                                            <div class="input-group">
                                                <input type="datetime" id="endDate" name="endDate"
                                                       class="form-control"/>
                                                <span class="input-group-addon add-on"><span
                                                        class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" id="generate_report">
                                            Generate Report
                                        </button>
                                        <div class="dropdown">
                                            <button class="btn btn-warning dropdown-toggle" type="button"
                                                    data-toggle="dropdown"><i class="glyphicon glyphicon-print"></i>
                                                Print record
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Excel Printout</a></li>
                                                <li class="divider"></li>
                                                <li><a href="../reports/transactions" target="_blank">Pdf Printout</a>
                                                </li>
                                                <li class="divider"></li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <hr>

                <div class="container-fluid">
                    <div class="dataTables_wrapper">
                        <div class="dataTables_wrapper" id="show_results">

                        </div>
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
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
<!-- Date Picker initialisation -->
<script type="text/javascript" src="../assets/dist/js/date.js"></script>
<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#report-Form").submit(function () {
            $.ajax({
                type: 'POST',
                url: '../helpers/transactionReportHelper.php',
                data: $("#report-Form").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {

                    $("#show_results").html(data);
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
                }
            });
            return false;
        });
    });
</script>

</body>


</html>