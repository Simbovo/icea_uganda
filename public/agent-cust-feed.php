<?php
/**
* Created by PhpStorm.
* User: Allan Wiz
* Date: 11/10/15
* Time: 8:29 PM
*/
session_start();


require('header.php');

use application\controller\feedsController;

$agent_no = $_SESSION['ref_no'];
$data = new feedsController();

$feeds = $data->agentFeedsDetails($agent_no);

//print_r($feeds);
?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mailbox
            <small>Your client feedbacks</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
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
                        <table class="table table-condensed table-responsive table-bordered" id="feedback">
                            <thead>
                                <tr>
                                    <th>SUBMISSION DATE</th>
                                    <th>SUBJECT</th>
                                    <th>MEMBER NUMBER</th>
                                    <th>STATUS</th>
                                    <th>RESPONDED BY</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($feeds as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y', strtotime($row->submission_date)); ?></td>
                                        <td><?php echo $row->subject; ?></td>
                                        <td><?php echo $row->member_no; ?></td>
                                        <?php if($row->responded_to !="") {?>
                                            <td><span class="label label-success">Responded</span></td>
                                            <td><?php echo $row->responded_by; ?></td>
                                            <?php }else{
                                                ?>
                                                <td><span class="label label-warning">Pending..</span></td>
                                                <td> <button type="button" class="btn btn-info text-center" data-toggle="modal"
                                                    data-target="#feed_contents"
                                                    data-feedId="<?= $row->id; ?>"
                                                    data-description="<?php echo $row->description; ?>">
                                                    <i class="fa fa-eye"> View details</i>
                                                </td>
                                                <?php
                                            }
                                            ?>                                        
                                        </tr>
                                        <?php
                                    }
                                    ?>


                                </tbody>
                            </table>
                            <!-- /.mail-box-messages -->
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
<!--Validator JS-->
<script src="../assets/bootstrap/js/validator.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
<!--Data Table js-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#feed_contents').on('show.bs.modal', function (event) {
            var id = $(this).attr('id');
    // id of the modal with event
    var button = $(event.relatedTarget) // 
    var id = button.attr('data-feedId') // Extract info from data-* attributes
    var feed_description = button.attr('data-description')
    var title = "Content of the feedback";
    // Update the modal's content.
    var modal = $(this)
    modal.find('.modal-title').text(title)
    modal.find('.modal-body').text(feed_description)
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
                    url: '../helpers/responder?id=' + id,
                    data: $("#modal-feedback").serialize(),
                    success: function (response) {
                        if (response = "success") {
                            alert("Response has been forwarded");
                            window.location.href = ('agent_Cust_Feedback.php');
                        } else {
                            alert("There was an error responding. Please try again later");
                            window.location.href = ('agent_Cust_Feedback.php');
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
        $("#feedback").dataTable({
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

<!-- Feedback modal -->
<div id="feed_contents" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="CustModal"
aria-hidden="false">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 class="modal-title" id="CustModalLabel">Contents of the feedback</h3>
        </div>
        <div class="modal-body">
            <p id="content">

            </p>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>
</div>
<div id="RespondTofeedback" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="respondmodal"
aria-hidden="false">
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 id="myModalLabel">Please reply to this </h3>
        </div>
        <div class="modal-body">

            <div class="modal-body">
                <form id="modal-feedback" name="modal-feedback" action=""
                method="post">
                <div class="form-group">
                    <label for="subject">Message: </label>
                    <textarea class="form-control custom-control" rows="3" style="resize:none" id="response"
                    name="response" required>
                </textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Submit Feedback</button>
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