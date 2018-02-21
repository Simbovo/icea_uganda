<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/22/15
 * Time: 10:01 AM
 */
include_once('header.php');


$ref_no = $_SESSION['ref_no'];
$category = $_SESSION['category'];

use application\controller\feedsController;

$feeds_obj = new feedsController();

$feedbacks = $feeds_obj->feedbackbycategory($ref_no, $category)
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mailbox
            <!--<small></small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Inbox</h3>
                        <a class="btn btn-primary pull-right" href="#sendFeedback" title="Create" data-toggle="modal"
                           data-target="#sendFeedback"><i class="icon ion-ios-compose-outline"></i> &nbsp;Make an Enquiry</a><!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-bordered table-hover" data-tables="true" id="feeds">
                            <thead>
                            <tr>
                                <th>Message ID:</th>
                                <th>Submission Date:</th>
                                <th>Subject:</th>
                                <th>Status:</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            foreach ($feedbacks as $row) {
                                $responded_to = $row['responded_to'];
                                echo "<tr>";
                                echo "<td class='mailbox-star'>" . $row['id'] . "</td>";
                                echo "<td mailbox-date>" . date('d-m-Y', strtotime($row['submission_date'])) . "</td>";
                                echo "<td class='mailbox-subject'><a href=#myModal?id=" . $row['id'] . " id='" . $row['id'] . "'  class='btncontent'>" . strtoupper($row['subject']) . "</a></td>";
                                if ($responded_to != "") {
                                    echo "<td   align=center><span class='label label-success'>Responded</span></td>";
                                } else {
                                    echo "<td   align=center><span class='label label-warning'>Pending</span></td>";
                                }
                                echo "</tr>";
                            }
                            ?>


                            </tbody>

                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">

                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->


<footer class="main-footer">
    <?php include 'extras/footnote.php' ?>
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
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>
<!--Datatables plugins-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!--WYSIWYG-->
<script src="../assets/plugins/wyeditor/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            //$(this).removeData();
            $("#content").html("");
        });
        $(".btncontent").click(function () {

            $("#myModal").modal({
                backdrop: true,
                keyboard: true

            });

            var id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: 'extras/getcontent.php?id=' + id,
                success: function (data) {
                    $("#content").append(data);
                }
            })
            return false;
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#my_feedback").submit(function () {
            $(".waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: '../helpers/add-feedback.php',
                data: $("#my_feedback").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $(".waiting").slideUp();
                    if (response == "forwarded") {
                        $(".alert").attr('class', 'alert alert-success');
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Forwarded: Your feedback has been forwarded. Thank you.</strong>")
                        setTimeout(function () {
                            window.location.href = 'inbox'
                        }, 2000)
                    } else if (response == "nforwarded") {
                        $(".alert").attr('class', 'alert alert-danger');
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Sorry: There was a problem submitting your feedback. Please try again later</strong>")
                    } else {
                        console.log(response);
                    }
                }
            })
            return false;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#feeds").dataTable({
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
<script>
    $(function () {
        //Add text editor
        $("#message").wysihtml5();
    });
</script>

<!-- Feedback modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Contents of your Feedback</h3>
            </div>
            <div class="modal-body" id="content">
               
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-folder-close"></span> Close
                </button>
            </div>
        </div>
    </div>
</div>

<div id="sendFeedback" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Please send us your Feedback</h3>
            </div>
            <form id="my_feedback" name="my_feedback" action="" method="post" data-toggle="validator">
                <div class="modal-body">
                    <div class="waiting" style="display:none;">
                        <center><img src="../assets/images/loading.gif"/>Processing ...</center>
                    </div>
                    <div class="alert" style="display:none;"></div>

                    <div class="form-group">

                        <input type="text" id="subject" class="form-control custom-control" name="subject" value=""
                               required autofocus placeholder="Subject" data-min-length="5" data-max-length="20"/>
                    </div>
                    <div class="form-group">

                        <textarea class="form-control custom-control" rows="4" cols="50" style="resize:none"
                                  id="message"
                                  name="message" required placeholder="Your Message">
                        </textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary pull-right">Submit Feedback</button>

                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>