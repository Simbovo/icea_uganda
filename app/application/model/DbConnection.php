<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DbConnection
 *
 * @author Allan Wiz
 */

namespace application\model;

use PDO;
ini_set('error_reporting', 1);
class DbConnection
{

    //Declare variables
    private static $instance;
    public $dbConn;

    private function __construct()
    {

        //building the connection string
        $dsn = 'firebird:host='.Config::read('DBHOST').';dbname='.Config::read('DBNAME').'; charset=utf8';

        $this->dbConn = new PDO($dsn, Config::read('DBUSER'), Config::read('DBPASS'));
        $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->dbConn->setAttribute(\PDO::ATTR_CASE, \PDO::CASE_LOWER);
        $this->dbConn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\ PDO::FETCH_ASSOC);
        //$this->dbConn->exec('SET search_path TO ' . Config::read('DBSCHEMA'));
      
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

}

