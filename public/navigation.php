<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/13/15
 * Time: 12:12 PM
 */
$category = $_SESSION['category'];
$member_no = $_SESSION['ref_no'];

use app\application\model\loadAppropriateContent as Content;
use app\application\model\staffSetUp;
use application\controller\dataController;

$data = new dataController();
$userLevel = new Content();
$staff = new staffSetUp();
if ($userLevel->isStaff($category)) {

    if ($staff->LoginTimeNotExpired() && $staff->loginDay()) {
        ?>

        <aside class="main-sidebar">
            <section class="sidebar">

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <a href="dashboard.php">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>

                    </li>
                    <li class="divider"></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="glyphicon glyphicon-ok"></i>
                            <span>NAVS & RATES</span>
                            <span class="label label-primary pull-right"></span><i
                                class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="navs"><i class="fa fa-circle-o"></i> Net Asset Values</a></li>
                            <li class="divider"></li>
                            <li><a href="rates"><i class="fa fa-circle-o"></i> Interest Rates </a></li>
                            <li class="divider"></li>
                        </ul>
                    </li>
                    <li class="divider"></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="glyphicon glyphicon-edit"></i>
                            <span>Members & Agents</span>
                            <span class="label label-primary pull-right"></span><i
                                class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="registered-members"><i class="glyphicon glyphicon-edit"></i>Member Registration
                                </a></li>

                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-edit"></i>Register </a></li>
                            <li class="divider"></li>
                            <li><a href="agents"><i class="fa fa-file"></i> Registered Agents </a>
                            </li>
                            <li class="divider"></li>


                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="glyphicon glyphicon-edit"></i>
                            <span>Portal Access Registration</span>
                            <span class="label label-primary pull-right"></span><i
                                class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="register-client">
                                    <i class="fa fa-pencil-square-o"></i>Client
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="register-agent">
                                    <i class="fa fa-pencil-square-o"></i>Agents </a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="register-staff"><i class="fa fa-pencil-square-o"></i>Staff </a>
                            </li>
                            <li class="divider"></li>


                        </ul>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="client_feedback">
                            <i class="fa fa-envelope"></i> <span>Mailbox</span>
                            <small class="label pull-right bg-yellow"><?php echo $data->totalFeedBacks(); ?></small>
                        </a>
                    </li>

                    <li>
                        <a href="online_users">
                            <i class="fa fa-users"></i> <span>Online Users</span>
                            <small
                                class="label pull-right bg-yellow"><?php echo $data->totalOnlineRegisteredClients() ?></small>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-pdf-o "></i>
                            <span>Reports</span>
                            <span class="label label-primary pull-right"></span><i
                                class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="members"><i class="fa fa-file"></i>Member Reports</a>
                            </li>
                            <li class="divider"></li>

                            <li>
                                <a href="#"><i class="fa fa-file"></i> Transaction Reports <i
                                        class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="transactions"><i class="fa fa-file"></i> Transactions Per Fund</a></li>
                                    <li><a href="posted"><i class="fa fa-file"></i> Posted Transactions</a></li>
                                    <li><a href="pending"><i class="fa fa-file"></i> Pending Transactions</a></li>
                                    <li><a href="confirmed"><i class="fa fa-file"></i> Confirmed Transactions</a></li>
                                    <li><a href="reversed"><i class="fa fa-file"></i> Reversed Transactions</a></li>
                                    <li><a href="summary"><i class="fa fa-file"></i> Transactions Summary</a></li>

                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-file"></i> Revenue Reports </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-file"></i> Agent Reports </a></li>
                            <li class="divider"></li>


                        </ul>
                    </li>
                </ul>


            </section>

        </aside>

        <?php
    }
} else if ($userLevel->isAgent($category)) {
    ?>
    <aside class="main-sidebar">
        <section class="sidebar">

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="dashboard">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>

                </li>
                <li class="treeview">
                    <a href="aprofile">
                        <i class="fa fa-user"></i>
                        <span>Profile</span>
                        <span class="label label-primary pull-right"></span>
                    </a>

                </li>
                <li class="treeview">
                    <a href="aclients">
                        <i class="fa fa-users"></i>
                        <span>My Clients</span>
                        <span class="label label-primary pull-right"></span>
                    </a>

                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-envelope"></i> <span>Mailbox</span>
                        <i class="fa fa-angle-left pull-right"></i>

                    </a>
                    <ul class="treeview-menu">
                        <li><a href="inbox"><i class="fa fa-circle-o"></i>My Feedback</a></li>
                        <li><a href="acfeedback"><i class="fa fa-circle-o"></i> Cleint Feedback</a></li>

                    </ul>
                </li>
            </ul>
        </section>

    </aside>

    <?php
} elseif ($userLevel->isClient($category)) {
    ?>
    <aside class="main-sidebar">
        <section class="sidebar">

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="dashboard">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>

                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>Accounts Information</span>
                        <span class="label label-primary pull-right"></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="client_accounts"><i class="fa fa-circle-o"></i> Your Accounts</a></li>
                        <li><a href=""></a></li>

                    </ul>
                </li>
                <li>
                    <a href="inbox">
                        <i class="fa fa-envelope"></i> <span>Feed Back</span>
                        <small class="label pull-right bg-yellow"></small>
                    </a>
                </li>
                <li>
                    <a href="client_profile">
                        <i class="fa fa-user"></i> <span>Profile</span>

                    </a>
                </li>
            </ul>
        </section>

    </aside>
    <?php
} else {

}
