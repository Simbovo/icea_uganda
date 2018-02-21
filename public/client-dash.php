<?php

use app\application\controller\accountController;

$acc_obj = new accountController();
$feeds_obj = new \application\controller\feedsController();
$docs_obj = new application\controller\documentController();

$ref_no = $_SESSION['ref_no'];
$category = $_SESSION['category'];

$accounts = count($acc_obj->client_agents($member_no), 1);
$total_feeds = count($feeds_obj->feedbackbycategory($ref_no, $category), 0);

$documents_uploaded = $docs_obj->viewClientDocs();
?>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Your Accounts</span>
                <span class="info-box-number"><?= $accounts ?></span>
                <a href="client-accounts" class="info-box-more">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Transactions</span>
                <span class="info-box-number">50</span>
                <a href="client-accounts" class="info-box-more">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="icon ion-android-clipboard"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Documents</span>
                <span class="info-box-number"><?php echo count($documents_uploaded, 0) ?></span>
                <a href="documents" class="info-box-more">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="icon ion-ios-chatboxes-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Messages</span>
                <span class="info-box-number"><?php echo $total_feeds; ?></span>
                <a href="inbox" class="info-box-more">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div><!-- /.info-box-content -->         

        </div><!-- /.info-box -->
    </div><!-- /.col -->
</div><!-- /.row -->
