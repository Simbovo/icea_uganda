<?php
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

include('header.php');
use app\application\controller\agentController;

$url = new \app\application\library\commonFunctions();

$data_agents = new agentController();
$agents = $data_agents->agentsNotOnline();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Online Agent registration

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>

            <li class="active">Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">REGISTER AGENTS FOR ONLINE PORTAL</h3>

                    </div>
                    <!-- /.box-header -->

                    <div class="box body table-responsive no-padding">
                        <table class="table table-condensed table-bordered table-hover" id="agent-list">
                            <thead style="background-color: #f5f5f5">
                            <tr>
                                <th>Agent NO</th>
                                <th>Agent Name</th>
                                <th>Agent Type</th>
                                <th>Category</th>
                                <th>Email Address</th>
                            </tr>

                            </thead>
                            <tbody>
                            <?php
                            foreach ($agents as $agent) {
                                ?>
                                <tr>
                                    <td><?php echo $agent['agent_no'] ?> </td>
                                    <td><?php echo $agent['agent_name'] ?> </td>
                                    <td><?php echo $agent['catname'] ?> </td>
                                    <td><?php echo $agent['e_mail'] ?> </td>
                                    <td>
                                      
                                            <a href=#register_agent?id="<?= $url->encryptStringArray($agent['agent_no'],
                                                '7800') . " id=" . $agent['agent_no'] ?>" class='btnclient'
                                                >Register
                                            </a>
                                      
                                  
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- /.row -->
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
    <?php include('extras/footnote.php'); ?>
</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
</div>

<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!--Datatables plugins-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables/responsive.booststrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>

<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            $("#details").html("");
        });
        $('.btnclient').click(function () {
            $("#register_agent").modal({
                backdrop: true,
                keyboard: true
            });
            var agent_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '../helpers/getAgent.php?agent_id=' + agent_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#details").append(data);
                }
            });
            $("#modalclient").submit(function () {
                $("#waiting").slideDown();
                $.ajax({
                    type: 'POST',
                    url: '../helpers/client-reg',
                    data: $("#modalclient").serialize(),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $("#waiting").slideUp();
                        if (response == "registered") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The username is either already in use OR the email address associated with that user is already in use.!</strong>");
                            //window.location.href = "register_client.php";
                        } else if (response == "failed") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The registration was not successful. Please double check that the details are correct.!</strong>");
                            //window.location.href = "register_client.php";
                        } else if (response == "mail_error") {
                            $(".alert").attr("class", "alert alert-info");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>There was an error sending email. Please contact your network administrator for assistance.!</strong>");
                            //window.location.href = "register_client.php";
                        } else if (response == "success") {
                            $(".alert").attr("class", "alert alert-success");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>The user has been successfully registered.!</strong>");
                            setTimeout(function () {
                                window.location.href = "register-agent";
                            }, 2000);
                        } else {
                            console.log(response);
                        }
                    }
                });
                return false;

            });

        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#agent-list').dataTable({
            "bProcessing": true,
            "responsive": true,
            /*"sAjaxSource": '../providers/agents-clients-minion.php?token=agents',
             "fnRowCallback": function (nRow, aData, iDisplayIndex) {
             $('td:eq(1)', nRow).html('<a href="" data-toggle="modal" data-target="#mem-sign-up" data-id=' + aData[0] + '">' +
             aData[1] + '</a>');
             return nRow;
             },*/
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pagingType: 'full_numbers'
        });
    });
</script>
<div id="register_agent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="MemberSignUpModal"
     aria-hidden="false">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Agent Details</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div id="waiting" style="display: none"><h5 class="text-center"><img
                                src="../assets/images/loading.gif">Processing ... Please wait</h5></div>
                    <div class="alert" style="display:none;"></div>

                    <form id="modalclient" name="modal-feedback" action=""
                          method="post">
                        <div class="form-group" id="details">


                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="glyphicon glyphicon-edit"></i> REGISTER
                            </button>
                            <a href="register-agent" class="btn btn-danger pull-right"> <i class="fa fa-close"></i>
                                Close</a>

                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>

</body>
</html>
