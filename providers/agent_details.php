<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 15/07/16
 * Time: 16:57
 */

require('../app/Loader.php');

use app\application\controller\agentController;

$agent_no = decryptStringArray($_GET['agent_id'], '7800');


$agent = new agentController();

$agent_details = $agent->agentDetails($agent_no);



?>
<div class="box-header"><h3 class="text-center"><i class="fa fa-user"></i> &nbsp;&nbsp;<?=$agent_details->agent_name; ?> </h3> </div>
<div class="col-lg-6">

    <div class="form-group ">
        <label class="control-label">Agent Number</label>
        <input type="text" value="<?php echo $agent_details->agent_no; ?>" readonly
               class="form-control"/>
        <input type="hidden" name="agent_no" value="<?php echo $agent_details->agent_no;  ?>" />
    </div>
    <div class="form-group ">
        <label class="control-label">Phone Number</label>
        <input type="text" value="<?php echo $agent_details->mobile; ?>" readonly
               class="form-control"/>
    </div>
    <div class="form-group ">
        <label class="control-label">Email Address</label>
        <input type="text" value="<?php echo $agent_details->e_mail; ?>"
               class="form-control" readonly/>
    </div>


</div>
<div class="col-lg-6">

    <div class="form-group ">
        <label class="control-label">Physical Address</label>
        <input type="text" value="<?php echo $agent_details->physical_address; ?>" readonly
               class="form-control"/>
    </div>

    <div class="form-group ">
        <label class="control-label">Postal Address</label>
        <input type="text" value="<?php echo $agent_details->post_address; ?>"
               class="form-control " readonly/>
    </div>
    <div class="form-group ">
        <label class="control-label">Town</label>
        <input type="text" value="<?php echo $agent_details->town; ?>" readonly
               class="form-control"/>
    </div>

</div>