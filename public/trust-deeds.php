<?php


require('header.php');

use application\controller\documentController;

$docs_obj = new documentController();

$doc_types = $docs_obj->getDocumentTypes();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Document Upload

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i>Home</a></li>

            <li class="active">Client Documents</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        Upload your documents
                    </div>
                    <form id="document_upload" action="" method="POST" accept-charset="UTF-8" class="form-horizontal"
                          autocomplete="off" enctype="multipart/form-data">

                        <div class="box-body">
                            <div id="waiting" style="display: none">
                                <center><img src="../assets/images/ajax-loader-bar.gif"/></center>
                            </div>
                            <div class="alert" style="display: none"></div>
                            <div class="form-group">
                                <label for="document" class="col-sm-3 control-label">Document</label>

                                <div class="col-sm-9">
                                    <input name="document" type="file" id="avatar">
                                </div>
                            </div>
                           
                        </div>
                        <div class="box-footer">
                            <a href="dashboard" title="Back" class="btn btn-default">Back</a>
                            <input class="btn btn-primary pull-right" title="Save" type="submit" value="Upload">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                           Trust Deeds uploaded
                        </div>
                        <div class="box body with-border">
                            <div class="table table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <th>Document Type</th>
                                <th>Document Name</th>
                                <th>Uploaded Date</th>
                                <th>Delete date</th>
                                </thead>
                                <tbody>
                                <?php
                                $documents_uploaded = $docs_obj->viewTrustDeeds();
                                foreach ($documents_uploaded as $docs) {

                                    echo "<tr>";
                                    echo "<td>" . $docs['doc_type'] . "</td>";
                                    echo "<td>" . $docs['doc_name'] . "</td>";
                                    echo "<td>" . date('d-M-Y', strtotime($docs['uploaded_date'])) . "</td>";
                                    echo "<td>" . "<a href=../helpers/unlink?id=" . $docs['doc_id'] . "  id='delete'><i class ='fa fa-delete'></i>Delete</a>" . "</td>";
                                    echo "</tr>";
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
        $("#document_upload").submit(function () {
            $("#waiting").slideDown();
            var form_data = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '../helpers/deeds_uploads',
                data: form_data,
                async: false,
                processData: false,
                contentType: false,
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $("#waiting").slideUp();
                    response_ = JSON.parse(response)
                    if (response_.status == "success") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Success</strong>" + response_.message);
                        setTimeout(function () {
                            window.location = response_.location;
                        }, 2000);
                    } else {
                        $(".alert").attr("class", "alert alert-info");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Error</strong>" + response_.message);
                        setTimeout(function () {
                            window.location = response_.location;
                        }, 2000);
                    }
                }
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        function delete_func(){
            var doc_id = document.getElementById('')
            $("#delete").onclick(function () {
               alert('Do you really want to delete this file?')
                });

                $.ajax{
                    type: 'POST',
                    url: '../helpers/unlink?id='+doc_id
                }
            })
        }
    })
</script>
</body>
</html>