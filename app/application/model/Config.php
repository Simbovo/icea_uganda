<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of config
 *
 * @author Allan Wiz
 */

namespace application\model;

class Config {

    //put your code here
    static $confArray;

    public static function read($name) {
        return self::$confArray[$name];
    }

    public static function write($name, $value) {
        self::$confArray[$name] = $value;
    }

}

//db params
Config::write('DBHOST', 'localhost');
Config::write('DBPORT', '3050');

Config::write('DBNAME', 'C:\Users\Allan\Documents\Database Workbench 5 Pro\NIC\UNITTRUST.FDB');
Config::write('DBUSER', 'SYSDBA');
Config::write('DBPASS', 'masterkey');
Config::write('DBSCHEMA', 'unitmaster');

/**
The User levels configuration

 */
Config::write('USER_LEVEL', 'customer');
Config::write('STAFF_LEVEL', 'staff');
Config::write('AGENT_LEVEL', 'agent');
Config::write('ADMIN_LEVEL', 'administrator');


/**
 *
 * End of description of settings
 *
 * This file entails details for connecting to the database
 *
 *
 */

?>
