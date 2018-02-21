<?php


session_start();

require_once('../vendor/autoload.php');

use application\controller\documentController;

$doc = new documentController();

if (isset($_FILES)) {
    $file_name = $_FILES['document']['name'];
    $file_size = $_FILES['document']['size'];
    $file_tmp = $_FILES['document']['tmp_name'];
    $file_type = $_FILES['document']['type'];
    $file_errors = $_FILES['document']['errors'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $valid_format = "pdf";
    $max_file_size = 5000000;
    $path = '../documents/kyc/';

    $member_no = filter_var($_POST['member_no'], FILTER_SANITIZE_STRING);

    if ($file_ext != $valid_format) {
        $response['status'] = 'error';
        $response['message'] = 'Please upload a valid pdf document';
        $response['location'] = '';
        $response['errors '] = '';
    } elseif ($file_size > $max_file_size) {
        $response['status'] = 'file_limit';
        $response['message'] = 'Document uploaded exceeds allowed limits';
        $response['location'] = '';
        $response['errors '] = '';
    } else {
        if (empty($file_errors)) {
            $new_file_name = preg_replace('/\s+/', '_', $file_name);
            $file_to_upload = $member_no . '_KYC_DOCUMENT.' . $file_ext;
            move_uploaded_file($file_tmp, $path . $file_to_upload);
            $file_type = 5;
            $save_document = $doc->saveClientDocument($member_no, $file_to_upload, $file_type);
            if ($save_document) {
                $response['status'] = 'success';
                $response['message'] = 'File uploaded successfully';
                $response['location'] = 'dashboard';
                $response['errors '] = '';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'File not uploaded successfully ';
                $response['location'] = 'document-upload';

            }
        }
    }
    echo json_encode($response);
}