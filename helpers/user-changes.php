<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 25/05/16
 * Time: 15:23
 */

require_once('../app/Loader.php');
use app\application\library\commonFunctions;
use application\controller\employeeController as EmployeeClass;

$empl = new EmployeeClass();
$lib = new commonFunctions();

if (isset($_GET['token'])) {
    $ref_id = $lib->decryptStringArray($_GET['token'], 'equity1290');
    $action = $lib->cleanInputs($_GET['action']);

    switch ($action) {
        case "EDITED":
            $user_upd = $empl->confirmRevokedUser($ref_id);
            if ($user_upd) {
                echo "updated";
            } else {
                echo "error_updating";
            }
            break;
        case "DELETED":
            $user_del = $empl->confirmDeletedUser($ref_id);
            if ($user_del) {
                echo "deleted";
            } else {
                echo "error_deleting";
            }
            break;
        default:
            exit;
    }
}

