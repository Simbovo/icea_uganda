<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require('../app/Loader.php');

use application\controller\dataController;

$data_obj = new dataController();
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    if ($token == "navs") {
        $data_navs = $data_obj->viewNavs();

        $json = array();
        foreach ($data_navs as $data) {
            $json[] = array(
                $data['nav_id'],
                date('d-M-Y', strtotime($data['nav_date'])),
                $data['descript'],
                number_format($data['amount'], 2, ".", ","),
                number_format($data['adm_fee'], 2, ".", ","),
                number_format($data['p_price'], 2, ".", ","),
                $data['staffname']
            );
        }
        $response['success'] = true;
        $response['aaData'] = $json;
       // var_dump($response);
        echo json_encode($response);
    } else if ($token == "rates") {
        $data_rates = $data_obj->viewRates();
        $json = array();
        foreach ($data_rates as $data) {
            $json[] = array(
                $data['rate_id'],
                number_format($data['rate_date'], 2, ".", ","),
                $data['descript'],
                number_format($data['rate'], 2, ".", ","),
                $data['staffname']
            );
        }
        $response['success'] = true;
        $response['aaData'] = $json;
        //var_dump($response);
        echo json_encode($response);
    } else {
        $response['success'] = false;
        echo json_encode($response);
    }
}





    