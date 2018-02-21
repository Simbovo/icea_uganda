	<?php


	require('header.php');

	use app\application\controller\transactionController;

	$trans = new transactionController();

	$agent_code = $_SESSION['ref_no'];

	//$params = array("date_from" => '2016-01-01', "date_to" => '2016-07-31', "agent_code"=>$agent_code);

	$start_date ="";
	$end_date = "";
	$data  = $trans->agent_commission($agent_code, $start_date, $end_date);


	?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Commmission

			</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

				<li class="active">Commmission</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">

			<!-- Default box -->
			<div class="row">
				<div class="col-sm-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Commission</h3>

						</div>
						<!-- /.box-header -->
						<div class="box body">
							<table id="commission" class="table table-hover table-condensed table-responsive">
								<thead>
									<tr>
										<th>Member #</th>
										<th>Name</th>
										<th>Fund</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($data as $result) {

										echo "<tr>";
										echo "<td>" . $result->member_no . "</td>";
										echo "<td>" . $result->allnames . "</td>";
										echo "<td>" . $result->descript . "</td>";
										echo "<td style='text-align:right'>" . number_format($result->commision, '2', ',','.'). "</td>";
										echo " </tr>";
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" style="text-align:right">Total:</th>
										<th style="text-align:right"></th>
									</tr>
								</tfoot>
							</table>
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
		$(document).ready(function () {
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
            $( api.column( 3 ).footer() ).html(
                'Ksh '+pageTotal.toFixed(2) +' ( Ksh'  + total.toFixed(2) +' total)'
            );
        }
	});
		})
	</script>
</body>
</html>