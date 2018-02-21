<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
error_reporting(1);
require ('../app/Loader.php');

use application\controller\documentController;

$doc_obj = new documentController();

/*
 * receive docs  details
 *
 * */
$user_category = $_SESSION['category'];
$document_type = $_POST['document_type'];

$documents_ress = $doc_obj->uploadFiles($_FILES);

$data_result = json_decode($documents_ress);

if (empty($data_result->errors)) {


    $save_file = $doc_obj->save_trust_deeds($data_result->file_name);
    
    if ($save_file) {
        $response['status'] = 'success';
        $response['message'] = 'File uploaded successfully';
        $response['location'] = 'trust-deeds';
        $response['errors '] = '';

        echo json_encode($response);
    } else {
        $response['status'] = 'success';
        $response['message'] = 'File not uploaded successfully ';
        $response['location'] = 'trust-deeds';
        $response['errors'] = $data_result->errors;

        echo json_encode($response);
    }
} else {
    echo $data_result;
}
