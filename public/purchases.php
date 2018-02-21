<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/30/15
 * Time: 10:47 AM
 */
include('header.php');

use app\application\controller\accountController;
use application\controller\dataController;
use application\controller\memberController;
use app\application\library\commonFunctions;

$member = new memberController();
$securities = new dataController();
$accounts = new accountController();
$url = new commonFunctions();


if (isset($_GET['acid'])) {
    $account_no = $url->decryptStringArray(filter_var($_GET['acid']), '7800');
}
$member_no =
list($agent_no, $sec_code_no, $mem_no, $sec_code) = explode("-", $account_no, 4);


$member_details = $member->getClientDetails($mem_no);
$sec_details = $securities->getSecurityDetails($sec_code);
$bank_details = $accounts->getMemberBankDetails($mem_no);


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Purchase

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i>Home</a></li>

            <li class="active">Purchase</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">

                    <div class="box-header with-border">
                        PURCHASE FOR <?php echo $member_details->allnames; ?>

                    </div>
                    <div class="box-body">


                        <div id="waiting" style="display:none;">
                            <center><img src='../assets/images/loading.gif'> Processing...</center>
                        </div>
                        <div class="alert " style="display:none;"></div>
                        <div class="col-lg-6 col-lg-offset-3">
                            <table border="0" class="table table-bordered">
                                <tbody>


                                <tr>
                                    <td width="39%" align="right" valign="middle" class="alert-dismissable">Account
                                        Name
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $member_details->allnames; ?></td>
                                </tr>
                                <tr>
                                    <td width="39%" align="right" valign="middle" class="alert-dismissable">Account
                                        Number
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $account_no ?></td>

                                </tr>
                                <tr>
                                    <td width="39%" align="right" valign="middle" class="alert-dismissable">Fund
                                        Name
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $sec_details->descript ?></td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <form id="purchase" method="post" action="" enctype="multipart/form-data"
                              data-togle="validator" class="form-horizontal">
                            <div class="col-sm-12">
                                <div class="col-sm-5">
                                    <input type="hidden" id="name" name="name"
                                           value="<?= $member_details->allnames ?>"/>
                                    <input type="hidden" id="acct_no" name="acct_no"
                                           value="<?php echo $account_no ?>"/>
                                    <input type="hidden" id="mem_no" name="mem_no"
                                           value="<?php echo $mem_no ?>"/>
                                    <input type="hidden" id="desc" name="desc"
                                           value="<?= $sec_details->descript ?>"/>
                                    <input type="hidden" id="town" name="town"
                                           value="<?= $bank_details->town ?>"/>
                                    <input type="hidden" id="bank_code" name="bank_code"
                                           value="<?= $bank_details->bankcode ?>"/>

                                    <div class="form-group">
                                        <label class="control-label" for="reference">REF Number:</label>
                                        <input type="text" id="reference" name="reference" class="form-control"
                                               value="<?= $url->generate_ref_no(); ?>" required autofocus
                                               placeholder="REF NO"/>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="payment_mode">Payment Mode:</label>
                                        <select name="payment_mode" id="payment_mode" class="form-control" required="required">
                                            <option value="">--Select payment Mode--</option>
                                            <option value="Cash Deposit">Cash Deposit</option>
                                            <option value="RTGS">RTGS</option>
                                            <option value="EFT">EFT</option>
                                            <option value="MPESA">MPESA</option>
                                            <option value="Check Off">Check Off</option>
                                            <option value="Standing Orders">Standing Orders</option>
                                            <option value="Cheque Deposit">Cheque Deposit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="bank_details">Bank Details:</label>
                                        <input type="text" name="bank_details" id="bank_details"
                                               value="<?php echo $bank_details->bankname; ?>"
                                               class="form-control" required="required" readonly/>
                                    </div>

                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="control-label" for="amount">Amount:</label>

                                        <div class="input-group">
                                            <input type="number" id="amount" name="amount" class="form-control"
                                                   required placeholder="Amount"
                                                />
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="fund_source">Fund Source:</label>
                                        <select name="fund_source" id="fund_source" class="form-control">
                                            <option value="">--Select Fund Source--</option>
                                            <option value="Earnings">Earnings</option>
                                            <option value="Gifts">Gifts</option>
                                            <option value="Rental">Rental Income</option>
                                            <option value="Savings">Savings</option>
                                            <option value="Proceeds from other investment">Proceeds from other
                                                investment
                                            </option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="amount">Drawer Name:</label>

                                        <div class="input-group">
                                            <input type="text" id="drawer_name" name="drawer_name"
                                                   class="form-control"
                                                   required="required" value="<?php echo $bank_details->accountname; ?>"
                                                   readonly="readonly"/>
                                            <span class="input-group-addon"><i class="fa fa-user"></i> </span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="submit" class="btn btn-primary pull-left">Purchase
                                </button>
                                <a  href="individual-account?id=<?= $url->encryptStringArray($mem_no, '7800'); ?>"
                                   class="btn btn-danger pull-right">Cancel</a>
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
    <?php include('extras/footer.php') ?>
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
<!--Jquery UI Validator-->
<script src="../assets/bootstrap/js/jquery.validate.min.js"></script>
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
        $("#purchase").submit(function () {
            $("#waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: '../helpers/purchaseHelper.php',
                data: $("#purchase").serialize(),
                error: function (err) {
                    console.log(err);
                },
                success: function (response) {
                    $("#waiting").slideUp();
                    if (response == "first_deposit") {
                        $(".alert").attr("class", "alert alert-info");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Info</strong>The customer is making a first deposit");
                    } else if (response == "less_amount") {
                        $(".alert").attr("class", "alert alert-warning");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Info</strong>The deposit amount is less than the amount to be deposited");
                    } else if (response == "ref_exists") {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Info</strong>The reference number you are trying to use already exist");
                    } else if (response == "transacted") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Info</strong>The transaction was successfully carried out");
                    } else if (response == "failed") {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Info</strong>The transaction failed, please contact support for further  assistance");
                    } else {
                        console.log(response);
                    }
                }
            })
            return false;
        })
    })
</script>
</body>
</html>
