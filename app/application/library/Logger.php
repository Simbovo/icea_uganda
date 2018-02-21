<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\library;

use application\model\DbConnection;

/**
 * Description of Logger
 *
 * @author Allan Wiz
 */
class Logger
{

    private $dbh, $username, $branch_code, $branch_name, $log_file, $file_pointer;


    function __construct() {
        @session_start();
        $this->dbh = DbConnection::getInstance();
    }

    public function lfile($path) {
        $this->log_file = $path;
    }

    // write message to the log file
    public function lwrite($message) {
        // if file pointer doesn't exist, then open log file
        if (!is_resource($this->fp)) {
            $this->lopen();
        }
        // define script name
        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        // define current time and suppress E_WARNING if using the system TZ settings
        // (don't forget to set the INI setting date.timezone)
        $time = @date('[d/M/Y:H:i:s]');
        // write current time, script name and message to the log file
        fwrite($this->fp, "$time ($script_name) $message" . PHP_EOL);
    }

    // close log file (it's always a good idea to close a file when you're done with it)
    public function lclose() {
        fclose($this->fp);
    }

    // open log file (private method)
    private function lopen() {
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = 'c:/xampp/php/logs/logfile.txt';
        } // set default log file for Linux and other systems
        else {
            $log_file_default = '/tmp/logfile.txt';
        }
        // define log file from lfile method or use previously set default
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
        // open log file for writing only and place file pointer at the end of the file
        // (if the file does not exist, try to create it)
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }

    public function write_to_log($message) {

        $this->branch_code = $_SESSION['branch_code'];
        $this->branch_name = $_SESSION['branch_name'];
        $this->username = $_SESSION['username'];
        // Get IP address
        if (($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
            $remote_addr = "REMOTE_ADDR_UNKNOWN";
        }

        // Get requested script
        if (($request_uri = $_SERVER['REQUEST_URI']) == '') {
            $request_uri = "REQUEST_URI_UNKNOWN";
        }

        $QryStr = "INSERT INTO WEB_ACTION_LOG(remote_address, username, branch_name, branch_id, user_action,log_date, request_uri)
                  VALUES(:remote_address, :username, :branch_name, :branch_id, :user_action, CURRENT_TIMESTAMP, :request_uri)";

        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $sth->bindParam(":remote_address", $remote_addr);
            $sth->bindParam(":request_uri", $request_uri);
            $sth->bindParam(":username", $this->username);
            $sth->bindParam(":branch_name", $this->branch_name);
            $sth->bindParam(":branch_id", $this->branch_code);
            $sth->bindParam(":user_action", $message);

            $return = $sth->execute();
            if ($return) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function displayLog() {
        $QryStr = "SELECT * FROM WEB_ACTION_LOG";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function logErrors($message) {

    }
}
