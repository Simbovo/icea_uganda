<?php
require_once('header.php');

use application\controller\dataController;
use app\application\controller\agentController;

$data = new dataController();
$agent_ctl = new agentController();

//
$countries = $data->countryList();
$banks = $data->getBankDetails();

//die(var_dump($banks));
$agents_category = $agent_ctl->getAgentCat();
$agent_types = $agent_ctl->getAgentTypes();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Agent Registration

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">  
                Agent Registration
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box">

                    <div class="box-header with-border">
                        Please fill in the agent details
                    </div>
                    <div class="box-body with-border">
                        <div id="waiting" style="display:none;">
                            <center><img src='../assets/images/loading.gif'> Processing...</center>
                        </div>
                        <div class="alert " style="display:none;"></div>
                        <form novalidate name="agent-form" data-toggle="validator" id="agent-form"
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
                                           maxlength="11" placeholder="A000000000X" class="form-control"
                                           id="kra_pin"
                                           data-error="Please input the correct KRA pin no." required="required">
                                    <span class="help-block with-errors"></span>

                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="agent_category">Agent Category: <span
                                            class=" glyphicon-asterisk"></span></label>

                                    <select name="agent_category" id="agent_category" class="form-control" required="required">
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
                                    <label class="control-label" for="bank_name">Bank Name: <span
                                            class="glyphicon-asterisk"></span>
                                    </label>
                                    <select name="bank_name" id="bank_name" class="form-control bank" required="required">
                                        <option value="">----Select Bank----</option>
                                        <?php
                                        foreach ($banks as $bank) {
                                            echo "<option value='" . $bank->bankcode . "-" . $bank->bankname . "'>" . $bank->bankname . "</option>";
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
                </div>
            </div>
    </section>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

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
<!-- JQuery Validatot JS -->
<script src="../assets/bootstrap/js/validator.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>

<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function (e) {
        $("#agent-form").submit(function () {
            $(".waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: "../helpers/add-agent-helper",
                data: $("#agent-form").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $(".waiting").slideUp();
                    if (response == "success") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>The agent has been registered successfully. </strong>");
                        setTimeout(function () {
                            window.location.href = 'add-agent';
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
                    //console.log(response);
                }
            })
            return false;
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
    $(document).on("change", '.bank', function (e) {
        $.ajax({
            type: "POST",
            data: $(".bank").serialize(),
            url: 'extras/getbnkbranch.php',
            success: function (response) {
                $("#branches").html(response);
            }
        });
        return false;
    });
</script>
</body>
</html>