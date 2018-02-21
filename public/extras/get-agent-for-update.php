<?php

require '../../app/Loader.php';

use app\application\controller\agentController;


$agent_ = new agentController();

$agent_no = filter_var($_GET['agent_no'], FILTER_VALIDATE_INT);

$agent_data = $agent_->agentDetails($agent_no);

?>

<form name="agentEdit" data-toggle="validator" id="agentEdit"
      method="post"
      role="form">
    <div class="col-lg-4">
        <div class="form-group required">
            <label class="control-label" for="agent_name">Agent Name: <span
                    class=" glyphicon-asterisk"></span></label>
            <input type="text" name="agent_name" class="form-control" id="agent_name" value="<?=$agent_data->agent_name; ?>"
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


