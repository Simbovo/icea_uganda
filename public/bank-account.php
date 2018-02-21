<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/24/15
 * Time: 10:37 AM
 */


include('header.php');

use application\controller\dataController;
use application\controller\memberController;
use app\application\library\commonFunctions;

$member_details = new memberController();
$lib = new commonFunctions();


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $memberNo = $lib->decryptStringArray($_GET['id'], '7800');
    $data = $member_details->getClientDetails($memberNo);
}
$member_no = $lib->encryptStringArray($memberNo, '7800');

$banks = new dataController();
$bank_data = $banks->getBankDetails();


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bank Account Registration

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboards"><i class="fa fa-home"></i>Home</a></li>

            <li class="active">Bank Account Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Main row -->
        <div class="row">

            <div class="col-sm-12">


                <div id="waiting" style="display:none;">
                    <img src='../assets/images/loading.gif'> Verifying...

                </div>
                <div class="alert" style="display:none;">

                </div>
                <!-- Default left column box -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">Fill in the bank details</div>
                        <form id="account-form" data-toggle="validator" method="post"
                              action="" class="form-horizontal">
                            <div class="box-body">

                                <input type="hidden" id="full_name" name="full_name"
                                       value="<?= $data->allnames; ?>"
                                    />
                                <input type="hidden" id="mem_no" name="mem_no" value="<?= $data->member_no ?>"/>
                                <input type="hidden" id="member" name="member" value="<?= $member_no; ?>" />

                                <div class="form-group">
                                    <label for="bank_name" class="col-sm-4 control-label ">Bank Name </label>

                                    <div class="col-sm-8">
                                        <select name="bank_name" id="bank_name" class="form-control"
                                                required="required">
                                            <option value="">--Select Bank --</option>
                                            <?php
                                            foreach ($bank_data as $bank) {

                                                echo "<option value='" . $bank->bank_code . "-" . $bank->bank_name . "'>" . $bank->bank_name . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="options">
                                    <label class=" col-sm-4 control-label" for="branch">Bank Branch</label>

                                    <div class="col-sm-8">
                                        <select name="branch" class="form-control" id="branch" required="required">
                                            <option value="">--- Please Select Branch ---</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="acct_no" class="col-sm-4 control-label">Account Number
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="acct_no" id="acct_no"
                                               pattern="[0-9]{9,15}" data-min-length="10"
                                               data-max-length="15" required="required"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="acct_name" class="col-sm-4 control-label">Account name </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="acct_name" required="required"
                                               name="acct_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="acc_type">Account Type:</label>

                                    <div class="col-sm-8">
                                        <select name="acc_type" class="form-control" id="acc_type"
                                                required="required">
                                            <option value="">--- Please Select Account Type ---</option>
                                            <option value="Current">Current Account</option>
                                            <option value="Junior">Junior Account</option>
                                            <option value="Savings">Savings Account</option>
                                            <option value="Sharia">Sharia Account</option>
                                            <option value="Student">Student Account</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" id="submit" class="btn btn-success pull-right">Save Account
                                    Details
                                </button>
                                <button type="reset" id="reset" class="btn btn-warning">Reset</button>

                            </div>
                        </form>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            Member Details
                        </div>
                        <div class="box-body with-border">
                            <table class="table table-condensed">
                                <tbody>
                                <tr>
                                    <td class="text-center">Member Number
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td><?= $memberNo; ?></td>

                                </tr>
                                <tr>
                                    <td class="text-center">Full Name</td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td><?= $data->allnames; ?></td>

                                </tr>
                                <tr>
                                    <td class="text-center">ID
                                        Number
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td><?= $data->id_no ?></td>

                                </tr>
                                <tr>
                                    <td class="text-center">Mobile
                                        No
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="82%" align="left"><?= $data->gsm_no ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
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

        $("#account-form").submit(function () {
            var id = $("#member").val();
            $("#waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: "../helpers/accountRegHelper.php",
                data: $("#account-form").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $("#waiting").slideUp();
                    if (response == "successful") {

                        $(".alert").html("<div class='alert-success'><strong>Added! The Account has been added successfully</strong></div>");
                        setTimeout(function () {
                            window.location = "individual-account?id=" + id;
                        }, 3000);
                    } else if (response == "fail") {
                        $(".alert").html("<div class='alert-danger'><strong>Error! There was an error adding the account, Please contact administrator for assistance </strong></div>");
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
