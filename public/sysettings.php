<?php


require_once('header.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Transfer

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Transfer User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Search Staff you want to transfer</h3>
                    <a href="confirmed-staff" role="button"
                       class="btn btn-large btn-primary pull-right"><i class="fa fa-users"></i>&nbsp;&nbsp;Confirmed Staff</a>

                </div>
                <div class="box-body with-border">
                    <div class="col-sm-12">

                        <div class="waiting" style="display: none;">
                            <center><img src="../assets/images/loading.gif"> Verifying ...</center>
                        </div>
                        <div class="alert" style="display: none"></div>

                        <div class="box body  box-warning">
                            <table class="table table-hover table-bordered" id="user-transfer">
                                <thead>
                                <tr>
                                    <th>Ref. Number</th>
                                    <th>Name</th>
                                    <th>ID Number</th>
                                    <th>Date of Birth</th>
                                    <th>Department</th>
                                    <th>Transfer User</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($employees as $employee) {
                                    echo "<tr>";
                                    echo "<td >" . $employee->EMPCODE . "</td>";
                                    echo "<td >" . $employee->FULLNAMES . "</td>";
                                    echo "<td >" . $employee->IDNO . "</td>";
                                    echo "<td >" . $employee->DOB . "</td>";
                                    echo "<td >" . $employee->DEPTCODE . "</td>";
                                    echo "<td ><a href=#transfer?ref_id=" . $lib->encryptStringArray($employee->EMPCODE, 'equity1290') . "><i class = 'fa fa-plane'></i>&nbsp;&nbsp;Transfer user</a></td>";
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

<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function (e) {
        $("#add_members").submit(function () {
            $(".waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: "../helpers/memberRegistrationHelper.php",
                data: $("#add_members").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $(".waiting").slideUp();
                    if (response == "successful") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>The member has been registered. </strong>");
                        window.location = "members_view.php";
                    } else if (response == "failed") {
                        $(".alert").html("<div class='alert alert-danger'><strong>Error!!</strong>Member registration not successful, please try aagain</div>");
                    } else {
                        $(".alert").html("<div class='alert alert-danger'><strong>ERROR!! </strong>" + response + "</div>");
                    }
                    console.log(response);
                }
            })
            return false;
        });


    });
</script>
</body>
</html>