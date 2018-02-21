<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 10/2/15
 * Time: 1:13 PM
 */
include('header.php');

use app\application\controller\accountController;
use app\application\controller\transactionController;
use application\model\DbConnection;
use application\controller\dataController;
use application\controller\memberController;
use app\application\library\commonFunctions;

$dbConnection = DbConnection::getInstance();

$member = new memberController();
$securities = new dataController();
$accounts = new accountController();
$trans = new transactionController();
$url = new commonFunctions();

if (isset($_GET['acid'])) {
    $account_no = $url->decryptStringArray(filter_var($_GET['acid']), '7800');
}

list($agent_no, $cat_no, $mem_no, $sec_code) = explode("-", $account_no, 4);
$id = $_GET['id'];
//$QryStr
//check if transaction exits
$ChkQuery = "SELECT * FROM TRANS WHERE ACCOUNT_NO=:accno AND CONFIRMED IS NOT NULL AND DELETED IS NULL AND REVERSED IS NULL order by TRANS_DATE asc";
try {
    $stmt = $dbConnection->dbConn->prepare($ChkQuery);
    $stmt->bindparam(":accno", $account_no);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (is_array($result)) {
        $member_details = $member->getClientDetails($mem_no);
        $sec_details = $securities->getSecurityDetails($sec_code);
        $bank_details = $accounts->getMemberBankDetails($mem_no);

    } else {
        echo("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Sorry, No matching transactions found for this member, please try again later	.')
            window.location.href='individual-account.php?id=$id'
        </SCRIPT>");
    }
} catch (PDOException $exc) {
    echo $exc->getTraceAsString();
}
$market_value = $trans->calcRunningBalance($account_no)

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="text-center">
            Funds Withdrawal <?php //var_dump($market_value); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Withdrawal</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box">

                    <div class="box-header with-border">
                        WITHDRAWING FUNDS FOR : <?= $member_details->allnames; ?>
                    </div>
                    <div class="box body with-border">
                        <div class="panel-body">
                            <fieldset style="-moz-background-origin: #ff6600;">
                                <div id="waiting" style="display:none;">
                                    <center><img src='../assets/images/loading.gif'> Processing...</center>
                                </div>
                                <div class="alert " style="display:none;"></div>

                                <div class="col-lg-3">

                                </div>
                                <div class="col-lg-6">
                                    <table border="0" class="table table-bordered">
                                        <tbody>


                                        <tr bgcolor="#FFFFFF">
                                            <td width="39%" align="right" valign="middle" class="alert-dismissable">
                                                Account
                                                Name
                                            </td>
                                            <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                            <td width="60%" align="left"><?= $member_details->allnames; ?> </td>
                                        </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="39%" align="right" valign="middle" class="alert-dismissable">
                                                Account
                                                Number
                                            </td>
                                            <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                            <td width="60%" align="left"><?= $account_no ?></td>

                                        </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="39%" align="right" valign="middle" class="alert-dismissable">Fund
                                                Name
                                            </td>
                                            <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                            <td width="60%" align="left"><?= $sec_details->descript; ?></td>

                                        </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="39%" align="right" valign="middle" class="alert-dismissable">Fund
                                                Balance
                                            </td>
                                            <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                            <td width="60%" align="left"><?= $market_value['mktvalue'] ?></td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-3">

                                </div>
                                <form id="withdrawal" data-togle="validator" method="post" action=""
                                      enctype="multipart/form-data">
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <legend>Transaction Details</legend>
                                            <input type="hidden" name="name" id="name"
                                                   value="<?= $member_details->allnames; ?>"/>
                                            <input type="hidden" name="acct_no" id="acct_no"
                                                   value="<?= $account_no; ?>"/>
                                            <input type="hidden" name="member_no" id="member_no"
                                                   value="<?= $mem_no; ?>"/>
                                            <input type="hidden" name="desc" id="desc" value="<?=
                                            $sec_details->descript;
                                            ?>"/>
                                            <input type="hidden" name="seccode" id="seccode" value="<?= $sec_code; ?>"/>
                                            <input type="hidden" name="acct_balance" id="acct_balance"
                                                   value="<?= $market_value['mktvalue']; ?>"/>

                                            <div class="form-group">
                                                <label class="control-label" for="payment_mode">Payment Mode:</label>
                                                <select name="payment_mode" id="payment_mode" class="form-control">
                                                    <option value="">--Select payment Mode--</option>
                                                    <option value="RTGS">RTGS</option>
                                                    <option value="EFT">EFT</option>
                                                    <option value="Cheque">Cheque</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="bank_details">Bank Details:</label>
                                                <input type="text" name="bank_details" id="bank_details"
                                                       value="<?php echo $bank_details->bankname; ?>"
                                                       class="form-control" required="required" readonly="readonly"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="reason">Reason</label>
                                                <select name="reason" id="reason" class="form-control">
                                                    <option value="">---Select Reason--</option>
                                                    <option value="Market Changes">Market Changes</option>
                                                    <option value="Medical Bills">Medical Bills</option>
                                                    <option value="School Fees">School Fees</option>
                                                    <option value="Personal">Personal</option>
                                                </select>
                                            </div>
                                        </fieldset>


                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <legend>Redemption Details</legend>
                                            <div class="form-group-sm">
                                                <label class="control-label">Transaction Type</label>

                                                <div class="checkbox icheck">
                                                    <div class="col-xs-12">
                                                        <div class="col-xs-6">
                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                                                  id="t_type"
                                                                                                  name="t_type"
                                                                                                  value="Partial">Partial</label>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                                                  id="t_type"
                                                                                                  name="t_type"
                                                                                                  value="Full">Full</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">AMOUNT</label>
                                                <input type="number" id="amount" name="amount" class="form-control"
                                                       required="required"
                                                       title="Please fill in the amount to withdraw, must not be less than 0sh,"
                                                       pattern="[0-9]" autocomplete="off"/>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <button type="submit" id="submit" class="btn btn-primary">Withdraw
                                            </button>
                                            <a href="individual-account?id=<?= $url->encryptStringArray($mem_no, '7800'); ?>"
                                               class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>

                            </fieldset>


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
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a
            href="https://clients.cic.co.ke"><?php echo $_SESSION['comp_name']; ?>
        </a>.</strong> All rights reserved.
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
<!--Jquery UI Validator-->
<script src="../assets/bootstrap/js/validator.min.js"></script>
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
<!--Data Table js-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#withdrawal").submit(function () {
            $("#waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: "../helpers/withdrawalHelper.php",
                data: $("#withdrawal").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $("#waiting").slideUp();
                    if (response === "transacted") {
                        $(".alert").attr("class", "alert alert-success alert-dismissable");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>The transaction has been completed successfully!</strong>");
                    } else if (response === "failed") {
                        $(".alert").attr("class", "alert alert-danger alert-dismissable");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>The was an errror proccesing your transaction. Please try again</strong>");
                    } else if (response === "less_balance") {
                        $(".alert").attr("class", "alert alert-info alert-dismissable");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Sorry, Your fund balance is less than the amount to be withdrawn!</strong>");
                        // $("#waiting").html("<div class='alert alert-danger'><strong>ERROR!! </strong>" + response + "</div>");

                    } else {
                        $(".alert").attr("class", "alert alert-info alert-dismissable");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Sorry! you cannot withdraw less than KSH. 100.00, Please try again</strong>");
                    }
                    console.log(response);
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
