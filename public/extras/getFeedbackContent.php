<?php
require('../../app/Loader.php');

use application\controller\feedsController;

$feed = new feedsController();

if (isset($_GET['id'])) {
    $feed_id = $_GET['id'];

    $QryStr = $feed->viewFeedsById($feed_id);

    $responded_to = $QryStr->responded_to;
    $submission_date = $QryStr->submission_date;
    $description = $QryStr->description;
    $response = $QryStr->responce;
    $response_date = $QryStr->response_date;
    $responded_by = $QryStr->responded_by;

    ?>
    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label">Content</label>
            <br>
            <table class="table table-bordered">
                <tr>
                    <td><?php echo $description; ?></td>
                </tr>
            </table>
        </div>
        <div class="form-group ">
            <label class="control-label">Submission Date</label>
            <br>
            <table class="table table-bordered">
                <tr>
                    <td><?php echo $submission_date; ?></td>
                </tr>
            </table>
        </div>

        <?php
        if ($responded_to == 1) {
            ?>
            <div class="form-group ">
                <label class="control-label">Response</label>
                <br>
                <table class="table table-bordered">
                    <tr>
                        <td><?= $response; ?></td>
                    </tr>
                </table>
            </div>
            <div class="form-group ">
                <label class="control-label">Response  Date</label>
                <br>
                <table class="table table-bordered">
                    <tr>
                        <td><?php echo $response_date; ?></td>
                    </tr>
                </table>
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
