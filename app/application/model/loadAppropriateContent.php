<?php



namespace app\application\model;
use application\model\Config;


class loadAppropriateContent
{
    var $category;

    public function __construct()
    {
        $this->category = $_SESSION['category'];
    }



    public function isStaff($category)
    {
        return $this->category == Config::read('STAFF_LEVEL');
    }

    public function isAgent($category)
    {
        return $this->category == Config::read('AGENT_LEVEL');
    }

    public function isClient($category)
    {

        return $this->category == Config::read('USER_LEVEL');
    }
    public function loadPages()
    {
        if ($this->isStaff($this->category)) {
            include('staff-dashboard.phtml');
        } else if ($this->isAgent($this->category)) {
            include('agent-dashboard.phtml');
        } else if ($this->isClient($this->category)) {
            include('client-dash.php');
        } else {
            include('admin-dash.php');
        }
    }

}

