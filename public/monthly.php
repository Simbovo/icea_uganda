	<?php


	require('header.php');

	use app\application\controller\transactionController;

	$trans = new transactionController();

	$agent_code = $_SESSION['ref_no'];

	
	?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Commmission

			</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>

				<li class="active">Commmission</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-sm-12">

					
					<div class="box box-primary">
						<div class="col-sm4 colsm-col-offset-4">
							<div id="waiting" style="display: none">
								<center><img src="../assets/images/ajax-loader-bar.gif"/>Processing.. please wait </center>
							</div>
							<div class="box-header with-border">
								<h3 class="box-title">Select month to view commmission</h3>
							</div><!-- /.box-header -->

							<div class="box-body">	
								<form novalidate name="report-Form" method="GET" id="report-Form" class="form-inline">	
									<div class="form-group">
										<label for="startdate" class="control-label col-sm-3">Start Date:</label>
										<div class="col-sm-4">
											<input type="text" name="startDate" id="startDate" required data-provide="datepicker" data-date-end-date="0d" class="form-control" readonly>
										</div>

									</div>
									<div class="form-group">
										<label for="enddate" class="control-label col-sm-3">End Date:</label>
										<div class="col-sm-4">
											<input type="text" name="endDate" id="endDate" required data-provide="datepicker" data-date-end-date="0d" class="form-control" readonly>
										</div>

									</div>


									<button class="btn btn-primary" type="submit" id="generate_report">
										Generate Report
									</button>

									<a href="commission" class="btn btn-warning" role="button" target="_blank">Print Statement</a>
								</form>
							</div>
							<div class="box-footer"></div>
							
						</div>
					</div>
				</div>
				<!-- Default box -->
				<div class="row">
					<div class="col-sm-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Commission</h3>

							</div>
							<!-- /.box-header -->
							<div class="box body">
								<div class="box-body box-warning no-padding">
									<div class="datatables-wrapper" id="show_results">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>        <!-- /.row -->
				

			</section>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->


		<!-- /.content -->
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<?php include ('extras/footnote.php'); ?>
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
	<!-- Bootstrap Datepicker js-->
	<script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>

	<!-- SlimScroll -->
	<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<!-- FastClick -->
	<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
	<!-- AdminLTE App -->
	<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
	<!--Data Table js-->
	<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	<!-- My date Js File -->
	<script src="../assets/dist/js/date.js" type="text/javascript"></script>

	<!-- Demo -->
	<!--<script src="../assets/dist/js/demo.js" type="text/javascript"></script>-->
	<script>
		$(document).ready(function () {
			$("#report-Form").submit(function () {
				$("#waiting").slideDown();
				$.ajax({
					type: 'POST',
					url: '../providers/monthly',
					data: $("#report-Form").serialize(),
					error: function (error) {
						console.log(error);
					},
					success: function (data) {
						$("#waiting").slideUp();
						$("#show_results").html(data);
						$("#commission").dataTable({
							"responsive": true,
							paging: true,
							lengthChange: true,
							searching: true,
							ordering: true,
							info: true,
							autoWidth: false,
							pagingType: 'full_numbers',
							"footerCallback": function ( row, data, start, end, display ) {
								var api = this.api(), data;

								// Remove the formatting to get integer data for summation
								var intVal = function ( i ) {
									return typeof i === 'string' ?
									i.replace(/[\$,]/g, '')*1 :
									typeof i === 'number' ?
									i : 0;
								};

								// Total over all pages
								total = api
								.column( 3 )
								.data()
								.reduce( function (a, b) {
									return intVal(a) + intVal(b);
								}, 0 );

								// Total over this page
								pageTotal = api
								.column( 3, { page: 'current'} )
								.data()
								.reduce( function (a, b) {
									return intVal(a) + intVal(b);
								}, 0 );

								// Update footer
								$( api.column( 3).footer() ).html(
									'Ksh '+pageTotal.toFixed(2) +' ( Ksh'  + total.toFixed(2) +' total)'
									);
							}
						});
					}
				})
				return false;
			});

		});
	</script>
</body>
</html>