<?php

require('../app/Loader.php');

use application\model\DbConnection;

$dbh = DbConnection::getInstance();

$user_level = $_SESSION['user_level'];
try {
    $QryStr = "SELECT menu_id as menu_item_id, parent_id as menu_parent_id, title as menu_item_name,
        url,menu_order,icon FROM dynamic_menu where user_level = :user_level ORDER BY menu_order";

    $stmt = $dbh->dbConn->prepare($QryStr);
    $stmt->execute(array(":user_level"=>$user_level));

} catch (PDOException $ex) {
    echo $ex->getMessage();
}

?>

<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['username'];?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php
        $refs = array();
        $list = array();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $thisref = $refs[$data['menu_item_id']];
            $thisref['menu_parent_id'] = $data['menu_parent_id'];
            $thisref['menu_item_name'] = $data['menu_item_name'];
            $thisref['url'] = $data['url'];
            $thisref['icon'] = $data['icon'];
            if ($data['menu_parent_id'] == 0) {
                $list[$data['menu_item_id']] = $thisref;
            } else {
                $refs[$data['menu_parent_id']]['children'][$data['menu_item_id']] = $thisref;
            }
        }
        

        function create_list($arr, $child) {
            if ($child == 0) {
                $html = "\n<ul class='sidebar-menu'>\n";
            } else {
                $html = "\n<ul class='treeview-menu'>\n";
            }
            foreach ($arr as $key => $v) {
                if (array_key_exists('children', $v)) {
                    $html .= "<li class='treeview'>\n";
                    $html .= '<a href="#">
                                <i class="' . $v['icon'] . '"></i>
                                <span>' . $v['menu_item_name'] . '</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>';

                    $html .= create_list($v['children'], 1);
                    $html .= "</li>\n";
                   // $html .= '<hr>';
                } else {
                    $html .= '<li><a href="' . $v['url'] . '">';
                    if ($child == 0) {
                        $html .= '<i class="' . $v['icon'] . '"></i>';

                    }
                    if ($child == 1) {
                        $html .= '<i class="fa fa-angle-double-right"></i>';
                    }
                    $html .= $v['menu_item_name'] . "</a></li>\n";
                    //$html .= '<hr>';
                }
            }
            $html .= "</ul>\n";
            return $html;
        }

        echo create_list($list, 0);
        ?>
    </section>
</aside>



