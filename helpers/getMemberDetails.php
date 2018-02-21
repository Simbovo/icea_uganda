<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/10/15
 * Time: 10:23 PM
 */

require_once('../app/Loader.php');

use application\controller\memberController;

if (isset($_GET['member_id'])) {
    $member_no = $_GET['member_id'];

    $memberObj = new memberController();

    $data = $memberObj->getClientDetails($member_no);


 if ($member_type == "Joint Member" || $member_type == "Institutional Member") {
        $marital_status = "N/A";
    } else {
        $marital_status = $row->maritalstatus;
    }
}
?>
<div class="col-lg-4">
    <div class="form-group ">
        <label class="control-label">Member Number</label>
        <input type="text" name="number" id="number" class="form-control" value="<?= $member_no ?>" readonly/>
        <input type="hidden" name="member_number" value="<?php echo $member_no ?>"/>
    </div>
    <div class="form-group ">
        <label class="control-label">Member Type</label>
        <input type="text" name="names" class="form-control"
               value="<?php echo $data->hse_no; ?> " readonly/>
    </div>
    <div class="form-group ">
        <label class="control-label">Residence</label>
        <input type="text" class="form-control" value=" <?php echo $data->phys_address; ?>" readonly/>

    </div>
    <div class="form-group ">
        <label class="control-label">Civil Status</label>
        <input type="text" class="form-control" value=" <?php echo $data->marital_status; ?>"
               readonly/>

    </div>
    <div class="form-group ">
        <label class="control-label">Date of Birth</label>
        <input type="text" class="form-control" value=" <?php echo $data->dob; ?>"
               readonly/>

    </div>


</div>
<div class="col-lg-4">
    <div class="form-group ">
        <label class="control-label">Member Name</label>
        <input type="text" value="<?php echo $data->allnames; ?>" readonly
               class="form-control"/>
    </div>
    <div class="form-group ">
        <label class="control-label">ID Number</label>
        <input type="text" value="<?php echo $data->id_no; ?>" readonly
               class="form-control"/>
    </div>
    <div class="form-group ">
        <label class="control-label">Telephone Number</label>
        <input type="text" value="<?php echo $data->gsm_no; ?>"
               class="form-control" readonly/>
    </div>
    <div class="form-group ">
        <label class="control-label">Email Address</label>
        <input type="text" value="<?php echo $data->e_mail; ?>"
               class="form-control " readonly/>
    </div>
    <div class="form-group ">
        <label class="control-label">Gender</label>
        <input type="text" value="<?php echo $data->gender; ?>"
               class="form-control " readonly/>
    </div>

</div>
<div class="col-lg-4">

    <div class="form-group ">
        <label class="control-label">Registration Date</label>
        <input type="text" value="<?php echo $data->reg_date; ?>" readonly
               class="form-control"/>
    </div>
    <div class="form-group ">
        <label class="control-label">KRA PIN Number</label>
        <input type="text" value="<?php echo $data->pin_no; ?>" readonly
               class="form-control"/>
    </div>
    <div class="form-group ">
        <label class="control-label">Phone Number</label>
        <input type="text" value="<?php echo $data->tel_no; ?>"
               class="form-control" readonly/>
    </div>
    <div class="form-group ">
        <label class="control-label">Postal Address</label>
        <input type="text" value="<?php echo $data->post_address; ?>"
               class="form-control " readonly/>
    </div>
    <div class="form-group ">
        <label class="control-label">Town</label>
        <input type="text" value="<?php echo $data->town; ?>"
               class="form-control " readonly/>
    </div>
</div>
