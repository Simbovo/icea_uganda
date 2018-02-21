<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 10/22/15
 * Time: 9:43 AM
 */

//Include the header file

include('header.php');
use app\application\model\DbConnection;

$conn = DbConnection::getInstance();

$QryStr = "SELECT DESCRIPT FROM SECURITIES";

try {
    $stmt = $conn->dbConn->prepare($QryStr);
    $stmt->execute();

    $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
} catch (PDOException $ex) {

}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Posted Transactions

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Posted Transactions</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <form novalidate name="report-Form" method="GET" id="report-Form">
                        <fieldset
                            style="-webkit-border-top-right-radius: 5px; -webkit-border-top-left-radius: 5px; background-color: #ffffff">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="report_type" class="control-label">Report Type:</label>
                                    <select name="report_type" id="report_type" class="form-control"
                                            data-ng-model="reportData.report_type">
                                        <option value="">---Select Fund Type---</option>
                                        <?php
                                        foreach ($result as $data) {
                                            echo "<option value='" . $data->descript . "'>" . $data->descript . "</option>";
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
                <div class="box-body no-padding">
                    <div class="dataTables_wrapper" id="show_results">

                    </div>
                </div>
            </div>


        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <?php
    include('extras/footnote.php');
    ?>
</footer>
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
<!--Initialize datepicker-->
<script src="../assets/dist/js/date.js" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>
<script>
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
                    $("#members").dataTable();
                }
            })
            return false;
        })

    });
</script>
<script type="text/javascript">
/*    $(document).ready(function () {
        $("#startDate").datepicker({
            format: "dd-mm-yyyy"
        })
        $("#endDate").datepicker({
            format: "dd-mm-yyyy"
        })
    })*/
</script>
</body>
</html>