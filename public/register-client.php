<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('header.php');
$sql = new \application\controller\memberController();
$url = new \app\application\library\commonFunctions();

$data = $sql->membersNotOnline();

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Online Client registration

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
                    <div class="box-header with-border">

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">REGISTER CLIENTS FOR ONLINE PORTAL</h3>

                            </div>
                            <!-- /.box-header -->

                            <div class="box body table-responsive no-padding">
                                <table class="table table-striped table-bordered nowrap" id="userList" cellspacing="0" width="100%">
                                    <thead style="background-color: #f5f5f5">
                                        <tr>
                                            <th>Member NO.</th>
                                            <th>Name</th>
                                            <th>Member Type</th>
                                            <th>Register</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php                                    
                                        foreach ($data as $member) {
                                        # code...
                                            echo "<tr >";
                                            echo "<td>" . $member['member_no'] . "</td>";
                                            echo "<td>" . $member['allnames'] . "</td>";
                                            echo "<td>" . $member['hse_no'] . "</td>";
                                            echo "<td><a href=#register_member?id=" . $url->encryptStringArray($member['member_no'], '7800') . " id=" . $member['member_no'] . " class='btnclient' >Register</a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
<script src="../assets/dist/js/modernizr-jquery.min.js"></script>

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

<!--Datatables plugins-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.responsive.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            $("#details").html("");
        });
        $('.btnclient').click(function () {
            $("#register_member").modal({
                backdrop: true,
                keyboard: true
            });
            var member_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '../helpers/getClient.php?member_id=' + member_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#details").append(data);
                    //console.log(data);
                }
            });
            $("#modalclient").submit(function () {
                $()
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
                                window.location.href = "register-client";
                            }, 2000);
                        } else {
                            console.log(response);
                        }

                    }
                });
                return false;
            });
        });
    });</script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#userList').dataTable({
                "bProcessing": true,
                "responsive": true,
                /*"sAjaxSource": '../providers/agents-clients-minion.php?token=clients',
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $('td:eq(1)', nRow).html('<a href="#member_online" data-toggle="modal" data-target="#member_online" data-id=' + aData[0] + '">' +
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
    <div id="register_member" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Label"
    aria-hidden="false">
    <div class="modal-dialog"  style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="Label">Member Details</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div id="waiting" style="display: none"><h5 class="text-center"><img
                        src="../assets/images/ajax-loader-bar.gif">Processing ... Please wait</h5></div>
                        <div class="alert" style="display:none;"></div>

                        <form id="modalclient" name="modal-feedback" action=""
                        method="post">
                        <div class="form-group" id="details">


                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                class="glyphicon glyphicon-edit"></i> REGISTER
                            </button>
                            <a href="register-client" class="btn btn-danger pull-right"> <i class="fa fa-close"></i> Close</a>

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
