<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 29/08/2016
 * Time: 16:31
 */

require_once('../app/Loader.php');

use application\controller\documentController;

$doc_ctl = new documentController();

$file_id = $_GET['id'];
//die($file_id);
$result = $doc_ctl->unlink_doc($file_id);

if ($result) {
    header('Location: ../public/documents');
} else {
    header('Location: ../public/documents');
}