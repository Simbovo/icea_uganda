<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('header.php');

$user = new \application\controller\employeeController();
$lib = new \app\application\library\commonFunctions();
$data = new \application\controller\dataController();


$user_id = $lib->decryptStringArray($_GET['ref_id'], 'equity1290');

$user_details = $user->getEmployeeById($user_id);

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Staff as User

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-home"></i>Home</a></li>

            <li class="active"> Add Staff As User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header">
                        Add staff as a user

                        <a href="confirmed-staff" role="button"
                           class="btn btn-large btn-primary pull-right"><i class="fa fa-eye-slash"></i> View Users</a>
                    </div>
                    <div class="box body box-warning">
                        <div id="waiting" style="display:none;">
                            <center><img src='../assets/images/loading.gif'> Processing...</center>
                        </div>
                        <div class="alert" style="display:none;"></div>

                        <table class="table table-bordered table-hover table responsive">
                            <thead>
                            <tr>
                                <th>Staff Name</th>
                                <th>PF Number</th>
                                <th>Staff ID Number</th>
                                <th>Email Address</th>
                                <th>Tel No</th>
                                <th>Date Employed</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="text-center"><?= $user_details->fullnames; ?></td>
                                <td class="text-center"><?= $user_details->pfno; ?></td>
                                <td class="text-center"><?= $user_details->idno; ?></td>
                                <td class="text-center"><?= $user_details->email; ?></td>
                                <td class="text-center"><?= $user_details->htel; ?></td>
                                <td class="text-center"><?= $user_details->demployed; ?></td>
                            </tr>
                            </tbody>

                        </table>
                        <form id="add_user" method="post" action="" enctype="multipart/form-data"
                              data-togle="validator" class="form-inline"
                              data-fv-framework="bootstrap"
                              data-fv-icon-valid="glyphicon glyphicon-ok"
                              data-fv-icon-invalid="glyphicon glyphicon-remove"
                              data-fv-icon-validating="glyphicon glyphicon-refresh">

                            <div class="col-lg-12">
                                <!-- <div id="waiting" style="display: none"></div>-->
                                <div class="col-lg-4">
                                    <input type="hidden" id="surname" name="surname"
                                           value="<?= $user_details->surname ?>"/>
                                    <input type="hidden" name="empcode" id="empcode"
                                           value="<?= $user_details->empcode ?>">

                                    <input type="hidden" name="email" id="email"
                                           value="<?= $user_details->email ?>">


                                    <div class="form-group">
                                        <label class="control-label">USERNAME:</label>
                                        <input type="text" id="username" name="username" pattern="[a-zA-Z0-9]+"
                                               class="form-control" required="required"/>
                                        <span class="help-block">The username must be alphanumeric</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">TYPE:</label>
                                        <select name="userType" id="userType" class="form-control" required="required">
                                            <option value="-1">----Select Type-------</option>
                                            <?php
                                            $types = $data->userControl();
                                            foreach ($types as $type) {
                                                echo "<option value=$type->utype>$type->utype</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">BRANCH:</label>
                                        <select name="branchid" id="branchid" class="form-control" required="required">
                                            <option value="-1">----Select Branch----</option>
                                            <?php
                                            $branches = $data->getBankBranch();
                                            foreach ($branches as $branch) {
                                                echo "<option value='" . $branch->branchid . "-" . $branch->branchname . "'>$branch->branchname</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-4">

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <button type="submit" id="add_user" name="add_user"
                                                class="btn btn-primary ">Add User
                                        </button>
                                        <a href="confirmed-staff" class="btn btn-warning ">Cancel</a>

                                    </div>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                        </form>
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

<!-- Demo -->
<!--<script src="../assets/dist/js/demo.js" type="text/javascript"></script>-->
<script language="javascript">
    $(document).ready(function (e) {

        $("#add_user").submit(function () {
            $("#waiting").slideDown();
            $.ajax({
                type: "POST",
                url: "../helpers/save-user",
                data: $("#add_user").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (result) {
                    $("#waiting").slideUp();
                    if (result == "success") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Added! The user has been successfully added</strong>");
                        setTimeout(function () {
                            window.location = "confirmed-staff";
                        }, 2000);
                    } else if (result == "failed") {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>ERROR!! </strong> Incorrect details, please try again");
                    } else {
                        $(".alert").attr("class", "alert alert-info");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>ERROR!! </strong>There was a technical error, please contact system administrator for assistance");
                    }
                    console.log(result);
                }

            })
            return false;
        });

    });
</script>
</body>
</html>
