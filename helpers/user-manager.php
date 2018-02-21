<?php


require('../app/Loader.php');

use app\application\library\commonFunctions;
use application\controller\memberController;


$user = new memberController();
$lib = new commonFunctions();


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



?>
