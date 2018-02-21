<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 31/10/2016
 * Time: 09:16
 */

namespace application\library;


use application\model\DbConnection;

class Role
{
    protected $permissions;
    private $dbh;

    protected function __construct()
    {
        $this->permissions = array();

    }

    //return a role object with associated permissions

    public static function genRolePerms($role_id)
    {
        $role = new Role();
        $dbh = DbConnection::getInstance();
        $QryStr = "SELECT t2.perm_desc FROM role_perm as t1
                JOIN permissions as t2 ON t1.perm_id = t2.perm_id
                WHERE t1.role_id = :role_id";
        try {
            $sth = $dbh->dbConn->prepare($QryStr);
            $sth->execute(array(":role_id" => $role_id));
            $rows = $sth->fetchAll(\PDO::FETCH_OBJ);
            foreach ($rows as $row) {
               // print_r($row);
                $role->permissions[$row->perm_desc] = true;
            }
            return $role;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    // check if a permission is set
    public function hasPerm($permission)
    {
        return isset($this->permissions[$permission]);
    }


}