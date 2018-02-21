<?php

ob_start();
include 'header.php';

use app\application\controller\accountController;use app\application\controller\agentController;use app\application\library\commonFunctions;use application\controller\dataController;use application\controller\memberController;

$datactl = new dataController();
$acc = new accountController();
$member = new memberController();
$url = new commonFunctions();
$agent_ctl = new agentController();

/**
 * Get the member number from the url
 * and decrypt 
 */
$member_number = $url->decryptStringArray(filter_var($_GET['id']), '7800');
$acc_existence  = $acc->BankAccountExist($member_number);
if (!is_array($acc_existence)) {

    $member_details = $member->clientProfile($member_number);
    $account_details = $acc->getAccountDetails($member_number);
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Client account information
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i>Home</a></li>

                <li class="active">Transaction Panel</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <h3>Transactions Panel </h3>
                            <a href="#um-modal" role="button" class="btn btn-large btn-primary" data-toggle="modal"
                               class="text-center">Add New Account</a>
                            <a href="registered-members" role="button" class="btn btn-large btn-primary"
                               class="text-center">View
                                Members</a>
                        </div>
                        <div class="box body with-border">

                            <div class="panel-body">
                                <fieldset style="-moz-background-origin: #ff6600">
                                    <div id="waiting" style="display:none;">
                                        <center><img src='../assets/images/loading.gif'> Verifying...</center>
                                    </div>

                                    <div class="col-lg-6">
                                        <table class="table table-bordered">
                                            <tbody>

                                                <tr>
                                                    <td  align="right" valign="middle" class="alert-dismissable">
                                                        Member
                                                        No
                                                    </td>
                                                    <td align="center" class="formsBodyText"><strong>:</strong></td>
                                                    <td align="left"><?= $member_number; ?></td>

                                                </tr>
                                                <tr>
                                                    <td align="right" valign="middle" class="alert-dismissable">Full
                                                        Name
                                                    </td>
                                                    <td  align="center" class="formsBodyText"><strong>:</strong></td>
                                                    <td align="left"><?= $member_details->allnames; ?></td>

                                                </tr>
                                                <tr>
                                                    <td align="right" valign="middle" class="alert-dismissable">ID
                                                        Number
                                                    </td>
                                                    <td align="center" class="formsBodyText"><strong>:</strong></td>
                                                    <td align="left"><?= $member_details->id_no ?></td>

                                                </tr>
                                                <tr>


                                                    <td align="right" valign="middle" class="alert-dismissable">
                                                        Mobile
                                                        No
                                                    </td>
                                                    <td align="center" class="formsBodyText"><strong>:</strong></td>
                                                    <td align="left"><?= $member_details->e_mail ?></td>
                                                </tr>


                                            </tbody>

                                        </table>

                                    </div>
                                    <div class="col-lg-3">
                                        <legend>Picture</legend>
                                        <table class="table table-bordered">

                                        </table>
                                    </div>
                                    <div class="col-lg-3">
                                        <legend>Signature</legend>
                                        <table class="table table-bordered"></table>

                                    </div>
                                </fieldset>
                                <table class="table table-condensed table-bordered table-stripped">
                                    <thead class="btn-warning">
                                        <tr>
                                            <th>Account no</th>
                                            <th>Agent Name</th>
                                            <th>Fund Name</th>
                                            <th>View</th>
                                            <th>Make</th>
                                            <th>Make</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($account_details as $row) {
                                            ?>
                                            <tr class="alert-dismissable">
                                                <td><?= $row->account_no; ?></td>
                                                <td><?= $row->agent_name; ?></td>
                                                <td><?= $row->descript ?></td>

                                                <?php
                                                if ($row->fundtype == "Admin Fee") {
                                                    ?>
                                                    <td>
                                                        <a href="long-term-fund?accNo=<?= $url->encryptStringArray($row->account_no, '7800') ?>"
                                                           target="_blank" class="btn btn-info">Statement </a></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                    <td>
                                                       <a href="market-fund?accNo=<?= $url->encryptStringArray($row->account_no, '7800') ?>"
                                                           target="_blank" class="btn btn-info">Statement </a></td>

                                                        <?php

                                                    }
                                                    ?>
                                                <td>
                                                    <a href="withdrawals?acid=<?= $url->encryptStringArray($row->account_no, '7800') ?>&id=<?= $url->encryptStringArray($member_number, '7800') ?>"
                                                       class="btn btn-danger">Withdrawal </a></td>
                                                <td>
                                                    <a href="purchases?acid=<?= $url->encryptStringArray($row->account_no, '7800') ?>&id=<?= $url->encryptStringArray($member_number, '7800') ?>"
                                                       class="btn btn-success">Purchase </a></td>
                                            </tr>
                                            <?php
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
        <?php include 'extras/footnote.php'; ?>
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
            $("#acctform").submit(function () {
                var data = new Object();
                data.add_cat = $("#add_cat").val();
                data.add_type = $("#add_type").val();
                data.agent_no = $("#agent_no").val();
                data.memno = $("#memno").val();
                $("#waiting").slideDown();
                $.ajax({
                    type: "POST",
                    url: "../helpers/add-umaccount.php",
                    data: "data=" + JSON.stringify(data),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $("#waiting").slideUp();
                        if (response === "account_exists") {
                            $(".alert").attr("class", "alert alert-info fade in");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The account already exists, please input another account number id!</strong>");
                        } else if (response === "failed") {
                            $(".alert").attr("class", "alert alert-info fade in");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The was an error saving the account. Please contact Admin!</strong>");
                        } else if (response === "registered") {
                            $(".alert").attr("class", "alert alert-success fade in");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The has been registered successfully!</strong>");
                            window.location.reload();
                        } else if (response == "application_error") {
                            $(".alert").attr("class", "alert alert-info fade in");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Application error. Please contact Admin!</strong>");
                        } else {
                            console.log(response);
                        }
                    }
                })
                return false;
            });
        });
    </script>
    <div id="um-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Add Member Account</h3>
                </div>
                <div class="modal-body">


                    <form class="form-horizontal col-sm-12" action="" method="post"
                          role="form" data-toggle="validator" id="acctform">
                        <div id="waiting" style="display:none;">
                            <center><img src='../assets/images/loading.gif'> Processing... Please wait</center>
                        </div>
                        <div id="alert" class="alert alert-dismissable" style="display: none"></div>
                        <div class="form-group">
                            <input type="hidden" name="memno" value="<?= $member_number ?>" id="memno" class="form-control"/>

                        </div>
                        <div class="form-group">
                            <label class="control-label">Fund Name</label>
                            <select name="add_type" type="text"  id="add_type" class="form-control col-xs-6">
                                <option value="">--Please select Fund -- </option>
                                <?php
                                $securities = $datactl->getSecDetails();
                                foreach ($securities as $sec) {

                                    echo "<option value='" . $sec->security_code . "'>" . $sec->descript . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Agent Name</label>
                            <select name="agent_no" id="agent_no" class="form-control" required="required">
                                <option value="-">--Please Select Agent</option>
                                <?php
                                $agents = $agent_ctl->viewAgents();
                                foreach ($agents as $agent) {
                                    echo "<option value='" . $agent->agent_no . "'>" . $agent->agent_name . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <select name="add_cat" type="text" id="add_cat" class="form-control col-xs-6">
                                <option value="">--Please Select client Category -- </option>
                                <?php
                                $cats = $datactl->getCatSecDetails();
                                foreach ($cats as $cat) {

                                    echo "<option value='" . $cat->catno . "'>" . $cat->description . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Add Account!</button>
                            <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not
                                valid. </p>
                            <button class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Cancel</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    </body>
    </html>

    <?php
} else {
    //header("Location: addBankaccount.php?id=".$member_number."");
    $mem_no = $_GET['id'];
    echo("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Sorry Member Bank  Details were not captured, please add Bank Account Details before you proceed.')
	window.location.href='bank-account.php?id=$mem_no'
	</SCRIPT>");
}
?>


<?php
ob_end_flush();
?>