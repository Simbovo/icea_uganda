<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require('../app/Loader.php');

use application\controller\memberController;
use app\application\controller\agentController;

$data_agents = new agentController();

$data_obj = new memberController();
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    if ($token == "clients") {
        $members = $data_obj->membersNotOnline();

        $json = array();
        foreach ($members as $data) {
            $json[] = array(
                $data['member_no'],
                $data['allnames'],
                $data['hse_no'],
                $data['e_mail']
            );
        }
        $response['success'] = true;
        $response['aaData'] = $json;
        echo json_encode($response);
    } else if ($token == "agents") {
        $agents = $data_agents->agentsNotOnline();
        $json = array();
        foreach ($agents as $data) {
            $json[] = array(
                $data['agent_no'],
                $data['agent_name'],
                $data['typename'],
                $data['catname'],
                $data['e_mail']
            );
        }
        $response['success'] = true;
        $response['aaData'] = $json;
        echo json_encode($response);
    } else {
        $response['success'] = fase;
        echo json_encode($response);
    }
}





    