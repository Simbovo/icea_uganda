<?php

require_once('header.php');

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Purchase

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Purchase</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Primary box -->
        <div class="box box-primary">
            <div class="box-header with-border">
               Search clients
            </div>
            <div class="box body with-border">
                <div class="panel-body">
                    <!-- search form -->
                    <form action="#" method="" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" id="q" class="form-control" placeholder="Search by member number, member name, or account number">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                        </div>
                    </form>
                </div>
            </div>
                <div class="box box-warning">
                    <div id="show-results">

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
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#q").keyup(function () {

            $.ajax({
                type: 'POST',
                url: '../providers/client-autocomplete-search',
                data: 'keyword=' + $(this).val(),
                beforeSend: function(){
                    $("#q").css("background","#FFF url(../assets/images/loading.gif) no-repeat 165px");
                },
                error: function (err) {
                    console.log(err);
                },
                success: function (response) {
                    $("#show-results").show();
                    $("#show-results").html(response);
                    $("#q").css("background","#FFF");
                }
            });
            return false
        });
    });

    //To select country name
    function selectCountry(val) {
        $("#q").val(val);
        $("#show-results").hide();
    }
</script>
</body>
</html>

