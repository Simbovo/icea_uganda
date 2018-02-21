<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/22/15
 * Time: 9:38 AM
 */
include_once('header.php');


$member_number = $_SESSION['username'];

use app\application\controller\transactionController;
use app\application\controller\accountController;
use app\application\library\commonFunctions;
use application\controller\memberController;


$member = new memberController();
$acc_obj = new accountController();
$lib = new commonFunctions();
$accounts = $acc_obj->client_agents();

$transobj = new transactionController();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Accounts 
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i>Home</a></li>

            <li class="active">Accounts</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Your UnitTrust Accounts</h3>
                        <div class="box body no-padding">

                            <table class="table table-stripped table-hover">
                                <tr class="info">
                                    <th>Account Number:</th>
                                    <th>Description:</th>
                                    <th>Financial Adviser:</th>
                                    <th>Statement:</th>
                                </tr>
                                <tbody>

                                    <?php
                                    foreach ($accounts as $account) {

                                        echo "<tr>";
                                        echo "<td>" . $account->account_no . "</td>";
                                        echo "<td>" . $account->descript . "</td>";
                                        echo "<td><a href=#agent-details?id=" . $lib->encryptStringArray($account->agent_no, '7800') . " id='" . $lib->encryptStringArray($account->agent_no, '7800'). "'  class='btnAgent'>" . $account->agent_no . "</a> <a class=tooltip href= >[?]<span class=info>Click on this link<br> to view more details about this agent</span></a></td>";
                                        if ($account->fundtype == "Rate Fee") {
                                            echo "<td align=center ><a href=market-fund?accNo=" . $lib->encryptStringArray($account->account_no, '7800') . "&secCode=" . $lib->encryptStringArray($account->security_code, '7800') . " target='_blank'>View Statement</a>";
                                        } else {
                                            echo "<td align=center ><a href=long-term-fund?accNo=" . $lib->encryptStringArray($account->account_no, '7800') . "&secCode=" . $lib->encryptStringArray($account->security_code, '7800') . " target='_blank'>View Statement</a>";
                                        }
                                        echo " </tr>";
                                    }
                                    ?>

                                </tbody>

                            </table>


                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">ACCOUNT BENEFICIARIES DETAILS</h3>

                    </div>
                    <div class="box body no-padding">

                        <table class="table table-stripped table-hover" id="trans">

                            <thead>
                                <tr class="info">

                                    <th align="center">NAME</th>
                                    <th align="center">POST ADDRESS</th>
                                    <th align="center">MOBILE NO</th>
                                    <th align="center">E-MAIL</th>                                    
                                    <th align="center">PHYSICAL ADDRESS</th>
                                    <th align="center">RELATIONSHIP</th>
                                    <th align="center">PERCENTAGE</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                
                                $beneficiaries = $member->beneficiariesInfo($member_number);
                               
                                foreach ($beneficiaries as $beneficiary) {
                                    echo "<tr>";
                                    echo "<td>" . $beneficiary->allnames . "</td>";
                                    echo "<td>" . $beneficiary->post_address . "</td>";
                                    echo "<td ".  $beneficiary->gsm_no . "</td>";
                                    echo "<td>" . $beneficiary->e_mail . "</td>";
                                    echo "<td>" . $beneficiary->phy_address . "</td>";
                                    echo "<td>" . $beneficiary->relationship . "</td>";
                                    echo "<td>" . $beneficiary->percentage . "</td>";
                                    echo " </tr>";
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
<!--<script src="../assets/dist/js/demo.js" type="text/javascript"></script>-->
<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            //$(this).removeData();
            $("#agent-details").html("");
        });
        $(".btnagent").click(function () {
            $("#agent-details").modal({
                backdrop: true,
                keyboard: true
            });
            var agent_id = $(this).attr('id');

            $.ajax({
                type: 'GET',
                url: '../providers/agent_details?agent_id=' + agent_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#agent_details").append(data);
                    //console.log(data);
                }
            });
        });

    });
</script>


<!-- 
<script type="text/javascript">
    $(document).ready(function () {
        $("#trans").dataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pagingType: 'full_numbers'
        });
    });
</script> -->
<div id="agent-details" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="false">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 id="myModalLabel">AGENT DETAILS</h3>
        </div>
        <div class="modal-body">

            <div class="modal-body">
                <form id="modal-feedback" name="modal-feedback" action=""
                method="post">
                <div class="form-group" id="agent_details">

                </div>
            </form>
        </div>

    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><span
            class="glyphicon glyphicon-folder-close"> Close</button>
        </div>
    </div>
</div>
</div>

</body>
</html>