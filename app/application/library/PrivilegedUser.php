<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 31/10/2016
 * Time: 09:55
 */

namespace application\library;


use application\controller\authController;
use application\model\DbConnection;

class PrivilegedUser extends authController
{

    private $roles;


    public function __construct()
    {
        parent::__construct();
    }

    // override User method
    public static function getByUsername($username)
    {
        $dbh = DbConnection::getInstance();
        $sql = "SELECT * FROM usersetup WHERE username = :username";
        $sth = $dbh->dbConn->prepare($sql);
        $sth->execute(array(":username" => $username));
        $result = $sth->fetchAll();
        //var_dump($result);
        if (!empty($result)) {
            $privUser = new PrivilegedUser();
            $privUser->user_id = $result[0]['user_id'];
            $privUser->username = $username;

            $privUser->initRoles();
            return $privUser;
        } else {
            return false;
        }
    }

    // populate roles with their associated permissions
    protected function initRoles()
    {
        $dbh = DbConnection::getInstance();
        $this->roles = array();
        $sql = "SELECT t1.role_id, t2.role_name FROM user_role as t1
                JOIN roles as t2 ON t1.role_id = t2.role_id
                WHERE t1.user_id = :user_id";
        $sth = $dbh->dbConn->prepare($sql);
        $sth->execute(array(":user_id" => $this->user_id));
        $roles = $sth->fetchAll(\PDO::FETCH_OBJ);
        while($role = $sth->fetch(\PDO::FETCH_OBJ)) {
            $this->roles[$role->role_name] = Role::genRolePerms($role->role_id);
        }
    }

    // check if user has a specific privilege
    public function hasPrivilege($perm)
    {
        foreach ($this->roles as $role) {
            if ($role->hasPerm($perm)) {
                return true;
            }
        }
        return false;
    }
}