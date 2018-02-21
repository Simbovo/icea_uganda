<?php

require '../app/Loader.php';

foreach ($_POST as $key => $value) {
    $$key = $value;
}

$lib = new app\application\library\commonFunctions();
$agent_ctl = new \app\application\controller\agentController();

$email_address = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    //validate agent email
    echo $email_address . " is not a valid email. Please input the correct email";
} else {
    //check if the agent already exists
    $exitence = $agent_ctl->checkIfExists($email_address, $id_no);
    if (is_array($exitence)) {
        echo "The agent you are trying to register is already registered with no " . $exitence['agent_no'] . " and name is " . $exitence['agent_name'];
    } else {
        $data = json_encode($lib->cleanInputs($_POST));
        
        $save_data = $agent_ctl->registerAgent($data);
        if ($save_data) {
            echo "success";
        } else {
            echo "error";
        }
    }
}

