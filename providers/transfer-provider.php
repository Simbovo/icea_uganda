<?php

require_once('../app/Loader.php');

use app\application\library\commonFunctions as Library;
use application\controller\employeeController as EmployeeClass;
use application\controller\dataController;


$lib = new Library();
$mem = new EmployeeClass();
$ctl = new dataController();

$user_id = $lib->decryptStringArray($_GET['ref_id'], 'equity1290');

$data = $mem->systemStaffById($user_id);

$branches = $ctl->getBankBranch();


/*foreach($data as $dt);{
    $employee_name = $data->FULLNAMES;
    $pf_no = $data->PDFNO;
}*/

?>


<div class="box-header"><h3 class="text-center"><i class="fa fa-user"></i> &nbsp;&nbsp;<?=$data->FULLNAMES;?> </h3> </div>
<div class="col-lg-6">

    <div class="form-group ">
        <label class="control-label">Staff Number</label>
        <input type="text" value="<?php echo $data->PFNO; ?>" readonly
               class="form-control"/>
        <input type="hidden" name="pf_no" value="<?php echo $data->PFNO;  ?>" />
        <input type="hidden" name="user_id" value="<?php echo $data->USER_ID;  ?>" />
    </div>
    <div class="form-group ">
        <label class="control-label">Phone Number</label>
        <input type="text" value="<?php echo $data->HTEL; ?>" readonly
               class="form-control"/>
    </div>
    <div class="form-group ">
        <label class="control-label">Email Address</label>
        <input type="text" value="<?php echo $data->EMAIL; ?>"
               class="form-control" readonly/>
    </div>


</div>
<div class="col-lg-6">

    <div class="form-group ">
        <label class="control-label">Current Branch</label>
        <input type="text" value="<?php echo $data->BRANCHNAME; ?>" readonly
               class="form-control"/>
    </div>

    <div class="form-group ">
        <label class="control-label">Destination Branch</label>
        <select name="destination_branch" id="destination_branch" class="form-control" required>
            <option value="">Please select a destination</option>
            <?php
            foreach($branches as $branch){
                echo "<option value='" . $branch->BRANCHID . "-" . $branch->BRANCHNAME . "'>" . $branch->BRANCHNAME . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group ">
        <label class="control-label">User type</label>
        <input type="text" value="<?php echo $data->USER_TYPE; ?>" readonly
               class="form-control"/>
    </div>

</div>


