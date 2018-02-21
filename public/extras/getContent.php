<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 10/22/15
 * Time: 5:44 PM
 */
session_start();

require('../../app/Loader.php');

use application\controller\feedsController;

$obj = new feedsController();

$member_no = $_SESSION['ref_no'];
$category = $_SESSION['category'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $feeds = $obj->clientFeedBack($member_no, $id, $category);

    
    ?>
    <div class="col-sm-10">
        <div class="form-group">
            <label class="control-label">Content</label>
            <textarea disabled name="content" rows="2" cols="5" class="form-control"><?php echo $feeds->description; ?></textarea>
        </div>
        <div class="form-group ">
            <label class="control-label">Submission Date</label>
            <input type="text" name="names" class="form-control"
                   value="<?php echo date('d-m-Y', strtotime($feeds->submission_date)); ?> " readonly/>
        </div>

        <?php
        if ($feeds->responded_to != "") {
            ?>
            <div class="form-group ">
                <label class="control-label">Response</label>
                <textarea disabled name="content" rows="2" cols="5" class="form-control"><?php echo $feeds->response; ?></textarea>
            </div>
            <div class="form-group">
                <label class="control-label">Response date Date </label>
                <input type="text" name="names" class="form-control"
                       value="<?php echodate('d-m-Y', strtotime($feeds->response_date)); ?>" readonly/>
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
<?php
}
?>

