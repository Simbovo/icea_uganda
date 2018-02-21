<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

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
switch ($user_category) {
    case 'staff':
        # code...

        if (is_null($data_result->errors)) {


            $save_file = $doc_obj->saveClientDocument($_POST['member_no'], $data_result->file_name, $document_type);

            if ($save_file) {
                $response['status'] = 'success';
                $response['message'] = 'File uploaded successfully';
                $response['location'] = 'document-upload';
                $response['errors '] = '';

                echo json_encode($response);
            } else {
                $response['status'] = 'success';
                $response['message'] = 'File not uploaded successfully ';
                $response['location'] = 'document-upload';
                $response['errors'] = $data_result->errors;

                echo json_encode($response);
            }
        }else{
            echo $data_result;
        }
        break;

    default:
        # code...
        if (is_null($data_result->errors)) {


            $save_file = $doc_obj->saveClientDocument($_SESSION['username'], $data_result->file_name, $document_type);

            if ($save_file) {
                $response['status'] = 'success';
                $response['message'] = 'File uploaded successfully';
                $response['location'] = 'client-documents';
                $response['errors '] = '';

                echo json_encode($response);
            } else {
                $response['status'] = 'success';
                $response['message'] = 'File not uploaded successfully ';
                $response['location'] = 'client-documents';
                $response['errors'] = $data_result->errors;

                echo json_encode($response);
            }
        } else {
            echo $data_result;
        }
        break;
}




