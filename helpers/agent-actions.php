<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../app/Loader.php';

use app\application\library\commonFunctions;
use app\application\controller\agentController;

$agent = new agentController();
$lib = new commonFunctions();

$data = json_decode($_POST['data']);

$action = $lib->cleanInputs($data->action);
$agent_code = $lib->cleanInputs($data->agent_no);

if ($action == "delete") {
    $delete = $agent->deleteAgent($agent_code);
    if ($delete) {
        $response['Status'] = "Success";
        $response['Message'] = "Agent successfully deleted";
    } else {
        $response['Status'] = "Failed";
        $response['Message'] = "Agent not deleted";
    }
}else{
    $edit = $agent->registerAgent($data_);
}