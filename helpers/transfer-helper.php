<?php

require('../app/Loader.php');

use application\controller\employeeController;

$empl = new employeeController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}
list($branch_id, $branch_name) = explode("-", $destination_branch, 2);
$transfer_result= $empl->transferUser($branch_id, $branch_name, $user_id);

if ($transfer_result) {
    echo "transferred";
} else {
    echo "failed";

}
die;
if (empty($email)) {
    echo "empty_details";
} else {
    /* else {
        //SEND EMAIL HERE
        $subject = "Welcome to unitTrust Online";
        $mail = new Email ("", $email, $subject);

        $mail->template = "../mailTemplates/registration.html";
    //The array holds the settings for the template
        $mail->template_vars = array("#names#" => $name,
            "#branch#" => $branch_name
        );


    //We send the e-mail here!!
        $ok = $mail->send();
        if (!$ok) {
            echo "mailError";
            exit;
        } else {*/
/////////////////////////////////////////////////////

}