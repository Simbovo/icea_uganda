<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require '../app/Loader.php';


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="icon"
	type="image/gif"
	href="../assets/images/favicon.gif"/>
	<title><?php echo $_SESSION['comp_name']; ?></title>
	<!-- Bootstrap 3.3.4 -->
	<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<!-- Font Awesome Icons -->
	<link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<!-- CSS datepicker -->

	<link href="../assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
	<!-- Theme style -->
	<link href="../assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
	<!-- Ubuntu fonts -->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
	<!-- iCheck -->
	<link href="../assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css"/>
	<style type="text/css">
		#login {
			background: url(../assets/images/mainheader.gif) no-repeat;
			height: 300px;
			border-radius: 2px 2px 5px 5px;
			padding: 10px 20px 20px 20px;
			width: 100%;
			max-width: 500px;
			position: relative;
			padding-bottom: 80px;
			box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
		}

		#login-form {
			border-radius: 2px 2px 5px 5px;
			padding: 10px 20px 20px 20px;
			width: 100%;
			max-width: 400px;
			background: #ffffff;
			position: relative;
			padding-bottom: 80px;
			box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
			margin: 0 auto;
		}

		#my-panel {
			border-radius: 2px 2px 5px 5px;
			padding: 10px 20px 20px 20px;
			background: #ffffff;
			box-shadow: 0px 1px 5px rgba(153, 54, 31, 0.85);
		}
		#log{
			font-family: "Times New Roman", Georgia, Serif;
		}

	</style>
</head>

<body>
	<header class="main-header" style="background-color: rgba(171, 22, 43, 0.85)">
		<!-- Logo -->
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<h2 style="color: #f9be00"><?php echo $_SESSION['comp_name']; ?> &nbsp; PORTAL</h2>

			<div class="navbar-custom-menu">


			</div>
		</nav>
	</header>
	<div class="container" id="my-panel">

		<div class="row">

			<div class="col-md-4 col-md-offset-4">
				<img src="../assets/images/logo.png" alt="Logo" width="154" height="92">
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-info">
					<form class="form-horizontal" method="post" action="" id="other_details" data-toggle="validator">
						<div class="box-header">
							<h2>Payment details</h2>
							<a href="../index" class="fa fa-home pull-right">Home</a>
						</div>
						<div class="box-body">
							<div class="col-lg-5 col-lg-offset-1">
								<fieldset>
									<legend>MPESA PAYEMENT</legend>

									<ul>
										<li class="style3">Go to M-PESA Menu</li>
										<li class="style3">Enter 600118 as the Business Number </li>
										<li class="style3">Enter your ID NUMBER as the account number </li>		<li class="style3">Enter the value amount to pay (NO COMMAS) </li>
										<li class="style3">Enter your M-PESA PIN </li>
										<li class="style3">Then send the request </li>
										<li class="style3">You will receive an SMS confirming the  transaction</li>

									</ul>
								</fieldset>

							</div>
							<div class="col-lg-5 col-lg-offset-1">
								<fieldset>
									<legend>BANK PAYEMNT</legend>
									<ul>
										<li class="style3">Account  Name: CIC UNIT TRUST COLLECTION ACCOUNT </li>
										<li class="style3">Bank:: Co-operative Bank of Kenya </li>
										<li class="style3">Branch:: Co-operative House </li>
										<li class="style3">Branch  No:: 02 </li>
										<li class="style3">Branch  Code:: 11 </li>
										<li class="style3">Account  No:: 01122190806600 </li>
									</ul>
								</fieldset>


							</div>
						</div>
						<div class="box-footer">
							<h3>You have completed the process. Please check your email for further more details</h3>
						</div>
					</form>

				</div>
			</div>
		</div>
		<hr>

		<div class="row">
			<?php include 'extras/footnote.php'; ?>;
		</div>

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

		<!-- Demo -->
		<script src="../assets/dist/js/demo.js" type="text/javascript"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="../assets/bootstrap/js/bootstrap.js" type="text/javascript"></script>
		<!--Validator-->
		<script src="../assets/bootstrap/js/validator.js" type="text/javascript"></script>
		<!--Holder js-->
		<script src="../assets/dist/js/holder.js" type="text/javascript"></script>


		<script type="text/javascript">
			$(document).ready(function () {
				$("#other_details").submit(function () {
					$(".waiting").slideDown();
					$.ajax({
						type: "POST",
						url: "../helpers/other-info",
						data: $("#other_details").serialize(),
						error: function (err_msg) {
							console.log(err_msg);
						},
						success: function (response) {
							$(".waiting").slideUp();
							var data = JSON.parse(response);
							if (data.code == "fail") {
								$(".alert").attr("class", "alert alert-danger");
								$(".alert").slideDown();
								$(".alert").html("<strong>Error!</strong>" + data.Message);
							}  else if (data.code == "ok") {
								$(".alert").attr("class", "alert alert-success");
								$(".alert").slideDown();
								$(".alert").html("<strong>Info!  </strong>" + data.Message);
								setTimeout(function(){
									window.location.href = data.location;
								}, 2000);
							} else {
								console.log(response);
							}
						}
					});
					return(false)
				});
				$("#dob").datepicker({
					autoClose: true
				});
			})
		</script>
		<script type="text/javascript">
			$(document).on("change", '#bank_name', function (e) {
        //var bank = $(this).val();

        $.ajax({
        	type: "POST",
        	data: $("#bank_name").serialize(),
        	url: 'extras/getbnkbranch.php',
            //dataType: 'json',
            success: function (response) {
            	$("#options").html(response);
            }
        });
        return false
    });
</script>
</body>
</html>