<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/13/15
 * Time: 12:51 PM
 */
//require('../app/Loader.php');

$data = new \application\controller\dataController();

$clients = $data->totalOnlineRegisteredClients();
$trans = $data->todaysTrans();
$members = $data->totalRegisteredClients();
$feedbacks = $data->totalFeedBacks();
?>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?=$clients;?></h3>
                <p><h4>Registered Online Users</h4></p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="online-users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?=$trans;?><sup style="font-size: 20px"></sup></h3>
                <p><h4>Transactions Today!</h4></p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="transactions" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?=$members; ?></h3>
                <p><h4>Registered Clients</h4></p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="registered-members" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?=$feedbacks ?></h3>
                <p><h4>Client Enquiries</h4></p>
            </div>
            <div class="icon">
                <i class="fa fa-envelope o"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
</div><!-- /.row -->