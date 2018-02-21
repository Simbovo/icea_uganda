<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use application\controller\feedsController;

$feed_obj =  new feedsController();
$id = $_GET['id'];
$feeds =  $feed_obj->viewFeedsById($id);
?>
<div class="col-sm-12">
        <div class="form-group">
            <label class="control-label">Content</label>
            <textarea disabled name="content" rows="2" cols="5" class="form-control"><?php echo $description; ?></textarea>
        </div>
        <div class="form-group ">
            <label class="control-label">Submission Date</label>
            <input type="text" name="names" class="form-control"
                   value="<?php echo $submission_date; ?> " readonly/>
        </div>

        <?php
        if ($responded_to != "") {
            ?>
            <div class="form-group ">
                <label class="control-label">Response</label>
                <textarea disabled name="content" rows="2" cols="5" class="form-control"><?php echo $response; ?></textarea>
            </div>
            <div class="form-group ">
                <label class="control-label">Response date Date</label>
                <input type="text" name="names" class="form-control"
                       value="<?php echo $response_date; ?> " readonly/>
            </div>
        <?php
        } else {
            ?>
            <div class="form-group">
                <div class="alert alert-warning alert-dismissable">
                    This feedback has not been responded to
                </div>
            </div>
        <?php
        }
        ?>
    </div>

