<?php
require('header.php');

use application\controller\settingsController;

$impl = new settingsController();

$controls = $impl->roles()
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Roles

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">User Roles</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">

            <div class="col-sm-12">
                <div class="box box-primary">

                    <div class="box">


                        <div class="box-header with-border">
                            <h3 class="box-title">User Control Setup</h3>
                            <a href="#" role="button" data-toggle="modal" data-target="#add-role"
                               class="btn btn-large btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add new
                                role</a>

                        </div>
                        <div class="box-body with-border">                          


                            <table class="table table-hover table-bordered" id="user_roles">
                                <thead>
                                    <tr>
                                        <th>Role ID</th>
                                        <th>Role Name</th>
                                        <th>Added By</th>
                                        <th>Registration Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($controls as $control) {
                                        echo "<tr>";
                                        echo "<td >" . $control->controlno . "</td>";
                                        echo "<td >" . $control->utype . "</td>";
                                        echo "<td >" . $control->uname . "</td>";
                                        echo "<td >" . $control->reg_date . "</td>";
                                        echo "<td ><a href=edit-role?ref_id=" . $control->username . " id=" . $control->refno . " class='btnuser' ><i class='fa-fa-edit'></i>&nbsp;Edit</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
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
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function (e) {
        $("#add-role").submit(function () {
            $(".waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: "../helpers/add-role",
                data: $("#add-role").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    data = JSON.parse(response);
                    $(".waiting").slideUp();
                    if (data.Status == "success") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong></i></strong>" + data.Message);
                        setTimeout(function () {
                            window.location, href = data.Location;
                        }, 2000);
                    } else if (data.Status == "failed") {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong></strong>" + data.Message)
                    } else {
                        console.log(data.response);
                    }
                }
            });
            return false;
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#view_roles").click(function () {
            $("#loading").slideDown();
            $("#loading").html("<div class='alert alert-info'><center><img src='../assets/images/loading.gif'> Loading ...</center></div>");
            $.ajax({
                type: 'GET',
                url: "../providers/view-roles",
                success: function (response) {
                    $("#loading").slideUp();
                    $("#sectionB").html(response);
                    $("#user_roles").dataTable();
                }
            });

        });
    })
</script>


<!-- Add role modal -->


<div id="add-role" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Add new role</h4>

            </div>
            <div class="modal-body">
                <form name="add-role" id="add-role" method="post" action=""
                      data-toggle="validator" class="form-inline">

                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="role" class="control-label">Role
                                Name </label>
                            <input type="text" class="form-control" name="role_name"
                                   id="role_name"
                                   data-min-length="5"
                                   data-error="The role entered is invalid"
                                   required/>

                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submit" class="btn btn-success"><i
                                    class="glyphicon glyphicon-save"></i>&nbsp; Save Role
                            </button>
                            <button type="reset" id="reset" class="btn btn-warning">
                                Clear
                            </button>

                        </div>
                    </div>
                    <div class="col-sm-2"></div>

                </form>
            </div>

            <div class="modal-footer">

                
            </div>

        </div>

    </div>

</div>






</body>

</html>