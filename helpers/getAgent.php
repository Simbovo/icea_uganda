<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../app/Loader.php';
$category = $_SESSION['category'];

global $session, $database;

if (isset($_GET['agent_id'])) {
    $agent_no = $_GET['agent_id'];

    $mem = new \app\application\controller\agentController();

    $row = $mem->agentDetails($agent_no);
    $title = $row->title;
    $names = $row->agent_name;
    $post_address = $row->post_address;
    $tel_no = $row->tel_no;
    $phys_address = $row->phys_address;
    $town = $row->town;
    $member_type = $row->hse_no;
    $mobile_no = $row->gsm_no;
    $email = $row->e_mail;
    $id_no = $row->id_no;
    $pin_no = $row->pin_no;
}
?>


<div class="box-header"><h3 class="text-center"><i class="fa fa-user"></i> &nbsp;&nbsp;<?= $names; ?> </h3> </div>
<div class="col-lg-6">

    <div class="form-group ">
        <label class="control-label">Agent Username</label>
        <input type="text" value="" id="username" name="username" required="required" 
               class="form-control" data-min-length="4" data-max-length="8"/>
        <input type="hidden" name="user_type" id="user_type" value="agent" />
        <input type="hidden" name="ref_no" id="ref_no" value="<?=$agent_no?>" />
        <input type="hidden" name="name" id="name" value="<?=$names?>" />
        <input type="hidden" name="name" id="name" value="<?=$name?>" />
    </div>
    <div class="form-group ">
        <label class="control-label">Phone Number</label>
        <input type="text" value="<?php echo $mobile_no; ?>" readonly
               class="form-control"/>
    </div>
    <div class="form-group ">
        <label class="control-label">Email Address</label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>"
               class="form-control" readonly/>
    </div>
   


</div>
<div class="col-lg-6">

    <div class="form-group ">
        <label class="control-label">Physical Address</label>
        <input type="text" value="<?php echo $physical_address; ?>" readonly
               class="form-control"/>
    </div>

    <div class="form-group ">
        <label class="control-label">Postal Address</label>
        <input type="text" value="<?php echo $post_address; ?>"
               class="form-control " readonly/>
    </div>
    <div class="form-group ">
        <label class="control-label">Town</label>
        <input type="text" value="<?php echo $town; ?>" readonly
               class="form-control"/>
    </div>
    

</div>