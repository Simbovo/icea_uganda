<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 10/6/15
 * Time: 8:10 AM
 */
include('header.php');
use application\model\DbConnection;
use application\controller\feedsController;


$feedback = new feedsController();
$Connection = DbConnection::getInstance();

$feeds = $feedback->viewAllFeedback();

$QryStr = "select count(*) AS TOTALS FROM feedbacks where responded_to is null";
try {
    $stmt = $Connection->dbConn->prepare($QryStr);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

} catch (PDOException $ex) {
    echo $ex->getMessage();
}



?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mailbox
            <small>13 new messages</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
            
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Inbox</h3>

                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <input type="text" class="form-control input-sm" placeholder="Search Mail"/>
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                            </button>
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                                <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                            </div>
                            <!-- /.btn-group -->
                            <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>

                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped" id="feedback">
                                <thead style="background-color: #f5f5f5">
                                <th>ID</th>
                                <th>DATE</th>
                                <th>SUBJECT</th>
                                <th>MEMBER ID</th>
                                <th>CATEGORY</th>
                                <th>STATUS</th>
                                <th>RESPONDED BY</th>
                                </thead>
                                <tbody>

                                <?php
                                foreach ($feeds as $feed) {
                                    $responded_to = $feed->responded_to;
                                    echo "<tr>";

                                    echo "<td class='mailbox-star'><a href=''><i class='fa fa-star text-yellow'></i></a>";
                                    "</td>";
                                    echo "<td class='mailbox-date'>" . date('d-m-Y', strtotime($feed->submission_date)) . "</td>";
                                    echo "<td class='mailbox-name'><a href=#CustFeedback?id=" . $feed->id . " id='" . $feed->id . "
                                    '  class='btnCustContent'></i>  " . $feed->subject . "</a></td>";
                                    echo "<td >" . $feed->member_no . "</td>";
                                    echo "<td>" . $feed->category . "</td>";
                                    if ($responded_to != "") {
                                        echo "<td align=center><span class='label label-success'>Responded</span></td>";
                                        echo "<td>" . $feed->responded_by . "</td>";
                                    } else {
                                        echo "<td   align=center><span class='label label-warning'>Pending</span></td>";
                                        echo "<td><a href=#RespondTofeedback  id='" . $feed->id . "' class='btnRespond'    ><i class='fa fa-reply'></i> Respond</a></td>";
                                    }
                                    echo "</tr>";
                                }
                                ?>


                                </tbody>


                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                            </button>
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                                <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                            </div>
                            <!-- /.btn-group -->
                            <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                            <div class="pull-right">
                                
                                <div class="btn-group">
                                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<footer class="main-footer">
    <?php include 'extras/footnote.php';?>
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
<!--Validator JS-->
<script src="../assets/bootstrap/js/validator.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
<!--Data Table js-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<!--CKEDITOR-->
<script src="../assets/plugins/wyeditor/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {

            $("#content").html("");
        });

        $(".btnCustContent").click(function () {

            $("#CustFeedback ").modal({

                backdrop: true,
                keyboard: true

            });

            var id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: 'extras/getFeedbackContent.php?id=' + id,
                success: function (data) {
                    $("#content").append(data);
                }

            });
            return false;

        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".btnRespond").click(function () {
            $("#RespondTofeedback").modal({
                backdrop: true,
                keyboard: true
            });
            var id = $(this).attr('id');
            $("#modal-feedback").submit(function () {

                $.ajax({
                    type: 'POST',
                    url: '../helpers/respondHelper.php?id=' + id,
                    data: $("#modal-feedback").serialize(),
                    success: function (response) {
                        if (response = "success") {
                            alert("Response has been forwarded");
                            window.location.href = ('client_feedback');
                        } else {
                            alert("There was an error responding. Please try again later");
                            window.location.href = ('client_feedback');
                        }

                    }

                })
                return false;
            })
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#feedback').DataTable({
            responsive: true
        });


    });
</script>
<!-- iCheck -->
<script src="../assets/plugins/iCheck/icheck.js" type="text/javascript"></script>
<!-- Page Script -->
<script>
    $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
            e.preventDefault();
            //detect type
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");

            //Switch states
            if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
            }

            if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
            }
        });
        $(function () {
            //Add text editor
            $("#response").wysihtml5();
        });
    });
</script>
<div id="CustFeedback" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Contents of the feedback</h3>
            </div>
            <div class="modal-body">
                <div class="form-group" id="content">

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="RespondTofeedback" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Please respond to Feedback</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <form id="modal-feedback" name="modal-feedback" action=""
                          method="post">
                        <div class="form-group">
                            <label for="subject">Message: </label>
                            <textarea class="form-control custom-control" rows="5" style="resize:none" id="response"
                                      name="response" required>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">Submit Feedback</button>
                            <a href="client_feedback" class="btn btn-danger pull-right"><i class="fa fa-close"></i>Close</a>
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
