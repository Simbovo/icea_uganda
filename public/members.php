<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/23/15
 * Time: 1:14 AM
 */
include('../public/header.php');

use application\controller\memberController as HseNo;

$method = new HseNo();
$hse_no = $method->getHseNo();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Member Report

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Member Report</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box box-primary">

                <div class="box-header with-border">

                </div>
                <div class="box body with-border">
                    <div class="container-fluid">

                        <form novalidate name="report-Form" method="GET" id="report-Form">
                            <fieldset
                                style="-webkit-border-top-right-radius: 5px; -webkit-border-top-left-radius: 5px; background-color: #ffffff">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="report_type" class="control-label">Report Type:</label>
                                        <select name="report_type" id="report_type" class="form-control"
                                                data-ng-model="reportData.report_type">
                                            <option value="">---Select Report Type---</option>
                                            <?php
                                            foreach ($hse_no as $data) {
                                                echo "<option value='" . $data->HSE_NO . "'>" . $data->HSE_NO . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-6">
                                        <div class="input-group date">
                                            <label class="control-label" for="startDate">Start Date</label>
                                            <input type="datetime" id="startDate" name="startDate" class="form-control"
                                                   data-ng-model="reportData.startDate">

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="endDate">End Date</label>
                                            <input type="datetime" id="endDate" name="endDate" class="form-control"
                                                   data-ng-model="reportData.endDate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary" type="submit" id="generate_report">
                                        Generate Report
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <br/>

                <div class="container-fluid">
                    <div class="dataTables_wrapper" id="show_results">

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
<!-- Bootstrap Datepicker js-->
<script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!--Data Table js-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>

<!-- Demo -->
<!--<script src="../../assets/dist/js/demo.js" type="text/javascript"></script>-->

<script type="text/javascript">
    $(document).ready(function () {
        $("#report-Form").submit(function () {
            $.ajax({
                type: 'POST',
                url: '../helpers/memberReportHelper.php',
                data: $("#report-Form").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {

                    $("#show_results").html(data);
                    $("#members").dataTable();
                }
            })
            return false;
        })

    });
</script>
<script>
    $(function () {

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#startDate").datepicker({
            format: "dd-mm-yyyy"
        })
        $("#endDate").datepicker({
            format: "dd-mm-yyyy"
        })

    })
</script>
</body>

</html>