<?php
/**
 * Created by PhpStorm.
 * User: Allan
 * Date: 24/04/2018
 * Time: 08:29
 */

include('header.php');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Consolidated Sales
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Consolidated Sales</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <form class="form-inline" name="report-Form" method="post" id="report-form"
                              data-toggle="validator">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control" id="start_date" name="start_date"
                                       data-date-end-date="0d">
                                <div class="input-group-addon">to</div>
                                <input type="text" class="form-control" id="end_date" name="end_date"
                                       data-date-end-date="0d">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit" id="generate_report">
                                Generate Report
                            </button>
                        </form>
                    </div>
                    <div class="box-body no-padding">
                        <div class="dataTables_wrapper" id="show_results">

                        </div>
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
<script>
    $(document).ready(function () {
        $("#report-form").submit(function () {
            var form_data = new Object;
            form_data.start_date = $("#start_date").val();
            form_data.end_date = $("#end_date").val();
            $.ajax({
                type: 'POST',
                url: '../helpers/consolidated_sales_helper.php',
                data: "data=" + JSON.stringify(form_data),
                error: function (error) {
                    console.log(error);
                }
                ,
                success: function (data) {
                    console.log(form_data);
                    $("#show_results").html(data);
                    $("#members").dataTable();
                }
            })
            return false;
        });

        $("#end_date").datepicker({
            format: "yyyy-mm-dd",
            autoClose: true,
            yearRange: "c-100:c+0",
            daysOfWeekDisabled: [0, 6]
        });
        $("#start_date").datepicker({
            format: "yyyy-mm-dd",
            autoClose: true,
            yearRange: "c-100:c+0",
            daysOfWeekDisabled: [0, 6]
        });

    });
</script>

</body>
</html>
