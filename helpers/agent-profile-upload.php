<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 15/11/2016
 * Time: 12:43
 */

use application\model\DbConnection;

require_once('../app/Loader.php');
session_start();

$dbh = DbConnection::getInstance();
if (isset($_FILES)) {
    $file_name = $_FILES['avatar']['name'];
    $temp_name = $_FILES['avatar']['tmp_name'];
    $file_size = $_FILES['avatar']['size'];
    $file_type = $_FILES['avatar']['type'];

    if ($_FILES['errors'] != 0) {
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $exts = array('jpg', 'png', 'jpeg', 'gif');
        if (!in_array($file_ext, $exts)) {
            $response = array("status" => "file_ext", "message" => "File extension not allowed", "url" => "agent-profile");
        } else {
            $img = base64_encode(file_get_contents($file_name));
            try {
                $upl = "UPDATE agents set photo = :photo";
                $sth = $dbh->dbConn->prepare($upl);
                $sth->bindParam(":photo", $img);
                if ($sth->execute()) {
                    $response = array("status" => "uploaded", "message" => "Photo uploaded successfully", "url" => "agent-profile");
                } else {
                    $response = array("status" => "error", "message" => "Error uploading photo", "url" => "agent-profile");
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }

        }
    }
}

