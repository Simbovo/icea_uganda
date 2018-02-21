<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../app/Loader.php';
$category = $_SESSION['category'];

global $session, $database;

if (isset($_GET['member_id'])) {
    $member_no = $_GET['member_id'];

    $mem = new \application\controller\memberController();

    $row = $mem->membersByMemberNo($member_no);
    $title = $row->title;
    $names = $row->allnames;
    $name = $row->firstname . " " . $lastname;
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
        <label class="control-label">Member Number</label>
        <input type="text" name="username" id="username" value="<?php echo $member_no; ?>" readonly
               class="form-control"/>
        <input type="hidden" name="user_type" id="user_type" value="customer" />
        <input type="hidden" name="ref_no" id="ref_no" value="<?=$member_no?>" />
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
    <div class="form-group ">
        <label class="control-label">KRA Pin No</label>
        <input type="text" value="<?php echo $pin_no; ?>"
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
    <div class="form-group ">
        <label class="control-label">Member Type</label>
        <input type="text" value="<?php echo $member_type; ?>" readonly
               class="form-control"/>
    </div>

</div>