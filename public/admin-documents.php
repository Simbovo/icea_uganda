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
            Documents Uploaded by clients

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
                <div class="col-md-10 col-md-offset-1">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            Documents uploaded
                             ><a href="document-upload" class="btn btn-link-outline pull-right"><i class="fa fa-upload"></i>&nbsp; Upload |Documents</a>
                        </div>
                        <div class="box body with-border">
                            <table class="table table-bordered" id="docs">
                                <thead>
                                <th>Member No</th>
                                <th>Document Name</th>
                                <th>Uploaded date</th>
                                <th>Document Type</th>                                
                                </thead>
                                <tbody>
                                <?php
                                $documents = $docs_obj->allDocs();
                                foreach ($documents as $docs) {
                                   
                                    echo "<tr>";
                                    echo "<td>" . $docs->client_no . "</td>";
                                    echo "<td>" . "<a href=../uploads/" . $docs->doc_name . "  target='_blank'><i class ='fa fa-download'></i>". $docs->doc_name . "</a>". "</td>";
                                    echo "<td>" . date('d-M-Y', strtotime($docs->added_date)) . "</td>";
                                    echo "<td>" . $docs->document_name . "</td>";
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
        $("#docs").dataTable({
           "responsive": true,
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
</body>
</html>