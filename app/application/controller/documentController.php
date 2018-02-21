<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of documentController
 *
 * @author Allan Wiz
 */

namespace application\controller;

use application\model\DbConnection;

class documentController
{

    private $dbh, $ref_no;

    function __construct() {
        @session_start();
        $this->dbh = DbConnection::getInstance();
        $this->configure();
        /* if($_SESSION['category']  == 'staff'){
             $this->ref_no = null;
         }*/
        $this->ref_no = $_SESSION['ref_no'];
    }

    private function configure() {
        $this->max_file_size = 5000000;
        $this->count = 0;
        $this->path = '../documents/deeds/';
        $this->valid_format = 'pdf';
    }

    /**
     *
     * @param type file
     * @return string
     */
    public function uploadFiles($name) {
        $errors = array();
        foreach ($name as $file) {
            $file_name = $file['name'];
            $file_size = $file['size'];
            $file_tmp = $file['tmp_name'];
            $file_type = $file['type'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if ($file_ext != $this->valid_format) {
                $errors[] = "File type not allowed, please upload a pdf file";
            }
            if ($file_size > $this->max_file_size) {
                $errors[] = "file size not allowed";
            }
            if (empty($errors) == true) {

                $new_file_name = preg_replace('/\s+/', '_', $file_name);
                if ($_SESSION['category'] == 'staff') {
                    $file_to_upload = $new_file_name;
                } else {
                    $file_to_upload = $this->ref_no . '_' . $new_file_name;
                }


                move_uploaded_file($file_tmp, $this->path . $file_to_upload);
            } else {
                //print_r(json_encode($errors));
            }
            $response['status'] = 'success';
            $response['file_name'] = $file_to_upload;
            $response['errors'] = $errors;
            return json_encode($response);
        }
    }

    public function viewClientDocs($ref_no = NULL) {
        if (!is_null($ref_no)) {
            $ref_no = $ref_no;
        } else {
            $ref_no = $this->ref_no;
        }
        try {
            $QryStr = "SELECT c.member_no, d.type_name, c.doc_name, c.uploaded_date
                    from client_documents c 
                    inner join document_types d
                    on c.doc_type = d.id
                    where member_no = :ref_no and  deleted is null";
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $sth->bindParam(":ref_no", $ref_no, \PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Function to de-link uploaded files from an account
     *
     */
    public function deleteFile() {

    }

    public function getDocumentTypes() {
        $QryStr = "SELECT * FROM document_types order by id";
        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $sth->execute();
            $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function saveClientDocument($member_no, $file_name, $file_type) {
        $QryStr = "INSERT INTO client_documents(member_no, doc_type, doc_name)"
            . "values(:member_no, :doc_type, :doc_name)";
        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $result = $sth->execute(array(":member_no" => $member_no, ":doc_type" => $file_type, ":doc_name" => $file_name));

            if ($result) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function unlink_doc($doc_id) {
        $QryStr = "SELECT * FROM client_documents WHERE doc_id = :doc_id";
        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $sth->bindParam(":doc_id", $doc_id);

            $sth->execute();

            $result = $sth->fetch(\PDO::FETCH_OBJ);
            $file = $this->path . "" . $result->doc_name;
            $unlink = unlink($file);
            if ($unlink) {
                $Qry = "UPDATE client_documents SET deleted = 1 WHERE doc_id = :doc_id";

                $stmt = $this->dbh->dbConn->prepare($Qry);
                $stmt->bindParam(":doc_id", $doc_id);
                $stmt->execute();
                return true;
            } else {
                return false;
            }

        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function allDocs() {


        $QryStr = "SELECT c.member_no, d.type_name, c.doc_name, c.uploaded_date, m.allnames
                    from client_documents c
                    inner join document_types d
                    on c.doc_type = d.id
                    inner join MEMBERS m  on
                    m.member_no = c.MEMBER_NO
                    where deleted is null";

        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);

            $sth->execute();
            $docs = $sth->fetchAll(\PDO::FETCH_ASSOC);

            return $docs;

        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function docsForClients() {
        $QryStr = "SELECT * from client_documents
                    where deleted is null and doc_type  = 0";


    }


    public function viewTrustDeeds() {
        $QryStr = "SELECT * FRoM trust_deeds where deleted is null";

        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $sth->execute();
            $docs = $sth->fetchAll(\PDO::FETCH_ASSOC);

            return $docs;

        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function save_trust_deeds($file_name) {
        $QryStr = "INSERT INTO trust_deeds(doc_type, doc_name)"
            . "values(:doc_type, :doc_name)";
        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $result = $sth->execute(array(":doc_type" => "Trust deed", ":doc_name" => $file_name));

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }


}
