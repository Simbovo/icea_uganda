<?php
require 'header.php';

use app\application\controller\agentController;
use app\application\library\commonFunctions;
use application\controller\dataController;

$lib = new commonFunctions();
$agent_ctl = new agentController();
$agents = $agent_ctl->viewAgents();
$data = new dataController();


//
$countries = $data->countryList();
$banks = $data->getBankDetails();
$agents_category = $agent_ctl->getAgentCat();
$agent_types = $agent_ctl->getAgentTypes();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Agent Listing

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Agent listing</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Agents</h3>
                                 <a href="add-agent" class="btn btn-primary glossy-clear pull-right">
                                    <i class="fa fa-plus"></i>Add new agent
                                </a>
                            </div>
                            <!-- /.box-header -->

                            <div class="box body table-responsive no-padding">
                                <table class="table table-hover table-condensed table-striped" id="agent-list">
                                    <thead>
                                        <tr>
                                            <th>Agent NO</th>
                                            <th>Agent Name</th>
                                            <th>ID No</th>
                                            <th>Phone No</th>
                                            <th>Email Address</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($agents as $agent) {
                                            ?>
                                            <tr>
                                                <td><?php echo $agent->agent_no ?></td>
                                                <td><?php echo $agent->agent_name ?></td>
                                                <td><?php echo $agent->id_no ?></td>
                                                <td><?php echo $agent->gsm_no ?></td>
                                                <td><?php echo $agent->e_mail ?></td>
                                                <td><?php echo $agent->catname ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#editAgentModal" 
                                                            data-agentNo="<?php echo $agent->agent_no; ?>"><i class="fa fa-edit"></i></button>

                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#deleteAgentModal"
                                                            data-agentNo="<?= $agent->agent_no; ?>"
                                                            data-agentName="<?php echo $agent->agent_name; ?>"><i
                                                            class="fa fa-remove"></i>
                                                    </button>
                                                </td>

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
        </div>
        <!-- /.row -->
    </section>
    <!-- /.box-footer-->
</div>
<!-- /.box -->


<!-- /.content -->
<!-- /.content-wrapper -->

<footer class="main-footer">
    <?php
    include('extras/footnote.php');
    ?>
</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>


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
<script type="text/javascript">
    $(document).ready(function () {
        $("#agentform").submit(function () {
            $("#waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: '../helpers/add-agent-helper.php',
                data: $("#agentform").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $("#waiting").slideUp();
                    if (response == "success") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>The agent has been registered successfully. </strong>");
                        setTimeout(function () {
                            window.location.href = 'agents';
                        }, 2000);
                    } else if (response == "error") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Agent registration ended with an error. Please contact adminitrator </strong>");
                    } else {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>ERROR!! </strong>" + response + "");
                    }
                }
            });
            return false;
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#deleteAgentModal').on('show.bs.modal', function (event) {
            // id of the modal with event
            var button = $(event.relatedTarget) // 
            var agentNo = button.attr('data-agentNo') // Extract info from data-* attributes
            var agentName = button.attr('data-agentName')

            var title = 'Confirm Delete agent #' + agentNo
            var content = 'Are you sure want to delete ' + agentName + '?'

            // Update the modal's content.
            var modal = $(this)
            modal.find('.modal-title').text(title)
            modal.find('.modal-body').text(content)

            //  pass the agentno to modal's 'Yes' button for further processing
            modal.find('button.btn-danger').val(agentNo)



            $("#delete").click(function () {
                var data = new Object;
                data.agent_no = agentNo;
                data.action = "delete";
                $.ajax({
                    url: '../helpers/agent-actions.php',
                    type: 'POST',
                    data: 'data=' + JSON.stringify(data),
                    error: function (error) {
                        errors = JSON.parse(error);
                        alert('Error with ' + error);
                    },
                    success: function (response) {
                        alert('Success' + response)
                    }
                });
                return false;
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
//        $("#editAgentModal").onShow('show.bs.modal', function (event))
//        {
//            var button = $(event.relatedTarget) // Button that triggered the modal
//            var agentNo = button.attr('data-agentNo') // Extract info from data-* attributes
//            var agentName = button.attr('data-agentName')
//
//            var title = 'Confirm Delete agent # ' + agentNo
//            var content = 'Are you sure want to delete ' + agentName + '?'
//
//            // Update the modal's content.
//            var modal = $(this)
//            modal.find('.modal-title').text(title)
//            modal.find('.modal-body').text(content)
//
//            //  pass the agentno to modal's 'Yes' button for further processing
//            modal.find('button.btn-danger').val(agentNo)
//        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#agent-list").DataTable({
            "responsive": true,
            "bProcessing": true,
            "bPaginate": true,
            "sScrollY": "310px",
            "bRetrieve": true,
            "bFilter": true,
            "bAutoWidth": false,
            "bInfo": true,
            "fnPreDrawCallback": function () {
                $("#details").hide();
                $("#loading").show();
                //alert("Pre Draw");
            },
            "fnDrawCallback": function () {
                $("#details").show();
                $("#loading").hide();
                //alert("Draw");
            },
            "fnInitComplete": function () {
                //alert("Complete");
            }

        });
    });
</script>
<script type="text/javascript">
    $(document).on("change", '#country', function (e) {
        $.ajax({
            type: "POST",
            data: $("#country").serialize(),
            url: 'extras/getTownName',
            //dataType: 'json',
            success: function (response) {
                $("#options").html(response);
            }
        });
        return false;
    });
</script>
<script>
    $(document).on("change", '#bank_name', function (e) {
        $.ajax({
            type: "POST",
            data: $("#bank_name").serialize(),
            url: 'extras/getbnkbranch.php',
            success: function (response) {
                $("#branches").html(response);
            }
        });
        return false;
    });
</script>
<!--Modal for editing agent details -->
<div class="modal fade" id="editAgentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Register new agent</h4>
            </div>
            <div class="modal-body">
                <form name="agentform" data-toggle="validator" id="agentform"
                      method="post"
                      role="form">
                    <div class="col-lg-4">
                        <div class="form-group required">
                            <label class="control-label" for="agent_name">Agent Name: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="agent_name" class="form-control" id="agent_name"
                                   data-error="Name should not contain numerical values." required>
                            <span class="help-block with-errors"></span>

                        </div>

                        <div class="form-group required">
                            <label class="control-label" for="id_no">ID/Passport NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="id_no" pattern="[0-9]{8}"
                                   class="form-control"
                                   id="id_no"
                                   data-error="ID NO should not contain characters." required>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="mobile_no">Mobile NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="mobile_no" pattern="[+254|0]+[0-9]{9}"
                                   data-min-length="10"
                                   data-max-length="13" placeholder="+254700000000" class="form-control"
                                   id="mobile_no"
                                   data-error="Please input the correct mobile number." required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="kra_pin">KRA Pin NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="kra_pin" pattern="[A-Z|0-9|A-Z]{11}"
                                   maxlength="11" placeholder="+254700000000" class="form-control"
                                   id="kra_pin"
                                   data-error="Please input the correct KRA pin no." required="required">
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="agent_category">Agent Category: <span
                                    class=" glyphicon-asterisk"></span></label>

                            <select name="agent_category" id="agent_category" class="form-control"
                                    required="required">
                                <option value="">----Select Agent category----</option>
                                <?php
                                foreach ($agents_category as $cat) {
                                    echo "<option value='" . $cat->transno . "-" . $cat->catname . "'>" . $cat->catname . "</option>";
                                }
                                ?>
                            </select>
                            <span class="help-block with-errors"></span>


                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="form-group required">
                            <label class="control-label" for="sname">Postal Address: <span
                                    class="glyphicon-asterisk"></span></label>
                            <input type="text" name="postal_address"
                                   class="form-control"
                                   id="postal_address"
                                   data-error="Name should not contain numerical values." required="required">
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="email">Email address: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input class="form-control" name="email" id="email" type="email"
                                   data-error="invalid email address" placeholder="example: email@email.com"
                                   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group required">
                            <label class="control-label" for="country">Country: <span
                                    class="glyphicon-asterisk"></span></label>
                            <select name="country" id="country" class="form-control" required="required">
                                <option value="">----Select country----</option>
                                <?php
                                foreach ($countries as $country) {
                                    echo "<option value='" . $country->country . "'>" . $country->country . "</option>";
                                }
                                ?>
                            </select>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required" id="options2">
                            <label class="control-label" for="town">Town: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <select name="town" id="town" class="form-control" required="required">
                                <option value="">----Select type----</option>
                                <?php
                                ?>
                            </select>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="phys_address">Physical/Residence Address: <span
                                    class="glyphicon-asterisk"></span></label>
                            <input type="text" name="phys_address"
                                   class="form-control"
                                   id="phys_address"
                                   data-error="Name should not contain numerical values." required="required">
                            <span class="help-block with-errors"></span>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group required">
                            <label class="control-label" for="Bank">Bank Name: <span
                                    class=glyphicon-asterisk"></span>
                            </label>
                            <select name="bank_name" id="bank_name" class="form-control" required="required">
                                <option value="">----Select Bank----</option>
                                <?php
                                foreach ($banks as $bank) {
                                    echo "<option value='" . $bank->bankcode . "-" . $bank->bankname . "'>" . $bank->bankname . "</option>";
                                }
                                ?>
                            </select>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required" id="branches2">

                            <label class="control-label" for="bank_branch">Bank Branch <span
                                    class=" glyphicon-asterisk"></span></label>

                            <select name="bank_branch" id="bank_branch" class="form-control" required="required">
                                <option value="">----Select Branch----</option>

                            </select>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group required">
                            <label class="control-label" for="account_no">Bank Account NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" class="form-control" name="account_no" id="account_no"
                                   data-error="Please input the correct account no" required>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div>
                            <div class="form-group required">
                                <label class="control-label" for="agent_type">Agent Type: <span
                                        class=" glyphicon-asterisk"></span></label>
                                <select name="agent_type" id="agent_type" class="form-control" required="required">
                                    <option value="">----Select agent type----</option>
                                    <?php
                                    foreach ($agent_types as $type) {
                                        echo "<option value='" . $type->typeid . "-" . $type->typename . "'>" . $type->typename . "</option>";
                                    }
                                    ?>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn btn-success"
                                        type="submit"><span class="fa fa-plus"></span> Save Agent Details
                                </button>
                                <input type="reset" class="btn btn-warning pull-right" name="reset" value="Reset">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!--Modal for adding a new agent -->
<div class="modal fade" id="addAgentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Register new agent</h4>
            </div>
            <div class="modal-body">
                <div id="waiting" style="display:none;">
                    <center><img src='../assets/images/loading.gif'> Processing...</center>
                </div>
                <div class="alert " style="display:none;"></div>
                <form name="agentform" data-toggle="validator" id="agentform"
                      method="post"
                      role="form">
                    <div class="col-lg-4">
                        <div class="form-group required">
                            <label class="control-label" for="agent_name">Agent Name: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="agent_name" class="form-control" id="agent_name"
                                   data-error="Name should not contain numerical values." required>
                            <span class="help-block with-errors"></span>

                        </div>

                        <div class="form-group required">
                            <label class="control-label" for="id_no">ID/Passport NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="id_no" pattern="[0-9]{8}"
                                   class="form-control"
                                   id="id_no"
                                   data-error="ID NO should not contain characters." required>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="mobile_no">Mobile NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="mobile_no" pattern="[+254|0]+[0-9]{9}"
                                   data-min-length="10"
                                   data-max-length="13" placeholder="+254700000000" class="form-control"
                                   id="mobile_no"
                                   data-error="Please input the correct mobile number." required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="kra_pin">KRA Pin NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="kra_pin" pattern="[A-Z|0-9|A-Z]{11}"
                                   maxlength="11" placeholder="+254700000000" class="form-control"
                                   id="kra_pin"
                                   data-error="Please input the correct KRA pin no." required="required">
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="agent_category">Agent Category: <span
                                    class=" glyphicon-asterisk"></span></label>

                            <select name="agent_category" id="agent_category" class="form-control"
                                    required="required">
                                <option value="">----Select Agent category----</option>
                                <?php
                                foreach ($agents_category as $cat) {
                                    echo "<option value='" . $cat->transno . "-" . $cat->catname . "'>" . $cat->catname . "</option>";
                                }
                                ?>
                            </select>
                            <span class="help-block with-errors"></span>


                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="form-group required">
                            <label class="control-label" for="sname">Postal Address: <span
                                    class="glyphicon-asterisk"></span></label>
                            <input type="text" name="postal_address"
                                   class="form-control"
                                   id="postal_address"
                                   data-error="Name should not contain numerical values." required="required">
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="email">Email address: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input class="form-control" name="email" id="email" type="email"
                                   data-error="invalid email address" placeholder="example: email@email.com"
                                   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group required">
                            <label class="control-label" for="country">Country: <span
                                    class="glyphicon-asterisk"></span></label>
                            <select name="country" id="country" class="form-control" required="required">
                                <option value="">----Select country----</option>
                                <?php
                                foreach ($countries as $country) {
                                    echo "<option value='" . $country->country . "'>" . $country->country . "</option>";
                                }
                                ?>
                            </select>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required" id="options">
                            <label class="control-label" for="town">Town: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <select name="town" id="town" class="form-control" required="required">
                                <option value="">----Select type----</option>
                                <?php
                                ?>
                            </select>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="phys_address">Physical/Residence Address: <span
                                    class="glyphicon-asterisk"></span></label>
                            <input type="text" name="phys_address"
                                   class="form-control"
                                   id="phys_address"
                                   data-error="Name should not contain numerical values." required="required">
                            <span class="help-block with-errors"></span>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group required">
                            <label class="control-label" for="Bank">Bank Name: <span
                                    class=glyphicon-asterisk"></span>
                            </label>
                            <select name="bank_name" id="bank_name" class="form-control" required="required">
                                <option value="">----Select Bank----</option>
                                <?php
                                foreach ($banks as $bank) {
                                   
                                    // echo "<option value='".$bank->bank_code."'>".$bank->bank_name."</option>";
                                    echo "<option value='".$bank->bank_code."-".$bank->bank_name."'>".$bank->bank_name."</option>";
                               
                                   // echo "<option value='" . $bank->bank_code . "'>" . $bank->bank_name . "</option>";
                               
                                    
                                    
                                }
                                ?>
                            </select>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required" id="branches">

                            <label class="control-label" for="bank_branch">Bank Branch <span
                                    class=" glyphicon-asterisk"></span></label>

                            <select name="bank_branch" id="bank_branch" class="form-control" required="required">
                                <option value="">----Select Branch----</option>

                            </select>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group required">
                            <label class="control-label" for="account_no">Bank Account NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" class="form-control" name="account_no" id="account_no"
                                   data-error="Please input the correct account no" required>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div>
                            <div class="form-group required">
                                <label class="control-label" for="agent_type">Agent Type: <span
                                        class=" glyphicon-asterisk"></span></label>
                                <select name="agent_type" id="agent_type" class="form-control" required="required">
                                    <option value="">----Select agent type----</option>
                                    <?php
                                    foreach ($agent_types as $type) {
                                        echo "<option value='" . $type->typeid . "-" . $type->typename . "'>" . $type->typename . "</option>";
                                    }
                                    ?>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn btn-success"
                                        type="submit"><span class="fa fa-plus"></span> Save Agent Details
                                </button>
                                <input type="reset" class="btn btn-warning pull-right" name="reset" value="Reset">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteAgentModal" tabindex="-1" role="dialog" aria-labelledby="deleteAgentModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteAgentModalLabel">Confirm Delete</h4>
            </div>

            <div class="modal-body">
                <form name="reason" id="reason" action="" method="post">
                    <div class="form-group">
                        <label class="control-label" for="delete_reason">Deletion reason</label>
                        <textarea class="form-control" required id="delete_reason" name="delete_reason" rows="60"
                                  cols="5"></textarea>
                    </div>
                    <div class="form-group">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="delete" class="btn btn-danger btn-ok">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>