<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/10/15
 * Time: 3:25 PM
 */
session_start();
require_once('header.php');

use app\application\controller\agentController;
use application\controller\memberController;
use app\application\library\commonFunctions;
use app\application\controller\accountController;

$agent_no = $_SESSION['ref_no'];

$member_details = new memberController();
$lib = new commonFunctions();
$agentObj = new agentController();
$acc = new accountController();


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $member_no = $lib->decryptStringArray($_GET['id'], 'cicam1290');
    $data = $member_details->getClientDetails($member_no);
}


$account_details = $acc->getAccountDetails($member_no);
$bank_details = $acc->getMemberBankDetails($member_no);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clients

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Clients</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        Member Details
                    </div>
                    <div class="box body with-border">              
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-center">Member Number
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $member_no; ?></td>

                                </tr>
                                <tr>
                                    <td class="text-center">Full
                                        Name
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $data->allnames; ?></td>

                                </tr>
                                <tr>
                                    <td class="text-center">ID
                                        Number
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $data->id_no ?></td>

                                </tr>
                                <tr>
                                    <td class="text-center">Mobile
                                        No
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="82%" align="left"><?= $data->gsm_no ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">Email Address
                                    </td>
                                    <td width="1%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="82%" align="left"><?= $data->e_mail ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Account details</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body">

                        <table id="accounts" class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Account No</th>
                                    <th>Fund Name </th>
                                    <th>Statement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($account_details as $row) {
                                    ?>
                                    <tr class="alert-dismissable">
                                        <td><?= $row->account_no; ?></td>
                                        <td><?= $row->descript ?></td>

                                        <?php
                                        if ($row->fundtype == "Admin Fee") {
                                            ?>
                                            <td>
                                                <a href="long-term-fund?accNo=<?= $lib->encryptStringArray($row->account_no, '7800') ?>"
                                                   target="_blank" class="btn btn-info">Statement </a></td>
                                                <?php
                                            } else {
                                                ?>
                                            <td>
                                                <a href="market-fund?accNo=<?= $lib->encryptStringArray($row->account_no, '7800') ?>"
                                                   target="_blank" class="btn btn-info">Statement </a></td>
                                                <?php
                                            }
                                            ?>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>  

                <div class="box footer">                           
                </div>                            
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-info">
                    <div class="box-header">
                        Member bank account details
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-center">Account Name
                                    </td>
                                    <td width="10%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $bank_details->accountname; ?></td>

                                </tr>
                                <tr>
                                    <td class="text-center">Full
                                        Name
                                    </td>
                                    <td width="10%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $bank_details->fullnames; ?></td>

                                </tr>
                                <tr>
                                    <td class="text-center">Bank Name
                                    </td>
                                    <td width="10%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $bank_details->bankname ?></td>

                                </tr>
                                <tr>
                                    <td class="text-center">Bank Branch
                                    </td>
                                    <td width="10%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $bank_details->branch ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">Account No
                                    </td>
                                    <td width="10%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="860%" align="left"><?= $bank_details->accountno ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">Account Type
                                    </td>
                                    <td width="10%" align="center" class="formsBodyText"><strong>:</strong></td>
                                    <td width="60%" align="left"><?= $bank_details->accounttype ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">

                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<!-- /.box-footer-->
</div>
<!-- /.box -->
<!-- /.content -->
<!-- /.content-wrapper -->

<footer class="main-footer">
    <?php include 'extras/footnote.php'; ?>;
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
<!-- Demo -->
<!--<script src="../assets/dist/js/demo.js" type="text/javascript"></script>-->




</body>
</html>