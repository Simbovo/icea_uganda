<?php
include('header.php');

use app\application\model\loadAppropriateContent;
use application\controller\memberController;
use application\controller\feedsController;
use application\controller\dataController;

$feed_obj = new feedsController();
$userLevel = new loadAppropriateContent();
$member_obj = new memberController();
$data = new dataController();

$d_rates = array_slice($data->viewRates(), 20, 20, true);
$d_navs = array_slice($data->viewNavs(), 60, 60, true);
foreach ($d_rates as $key => $value) {
# code...
    if ($value['security_code'] == '006') {
        $rates_ug[] = array(strtotime($value['rate_date']) * 1000, (floatval($value['rate'])));
    } else {
        $rates_ke[] = array(strtotime($value['rate_date']) * 1000, (floatval($value['rate'])));
    }

}
//$rates = $i_rates;


foreach ($d_navs as $key => $value) {
    # code...
    if ($value['security_code'] == '001') {
        $balanced_fund[] = array(strtotime($value['nav_date']) * 1000, (floatval($value['amount'])));
    } elseif ($value['security_code'] == '003') {
        $equity_fund[] = array(strtotime($value['nav_date']) * 1000, (floatval($value['amount'])));
    } elseif ($value['security_code'] == '002') {
        $fixed_income[] = array(strtotime($value['nav_date']) * 1000, (floatval($value['amount'])));
    } else {

    }
}


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            DashBoard

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <?php $userLevel->loadPages(); ?>
            </div>
        </div>
        <!-- Line chart -->
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>

                        <h3 class="box-title">NIC MONEY MARKET FUND PERFORMANCE</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="line-chart-m" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body-->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>

                        <h3 class="box-title">NIC EQUITY FUND PERFORMANCE</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="line-chart-eq" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>

                        <h3 class="box-title">ICEA LION GROWTH FUND PERFORMANCE</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="line-chart-fi" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body-->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>

                        <h3 class="box-title">ICEA UGANDA BALANCED FUND PERFORMANCE</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="line-chart-bl" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body-->
                </div>
            </div>
        </div>

        <!-- /.box -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<footer class="main-footer">
    <?php include('extras/footnote.php'); ?>
</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
<script src="../assets/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../assets/plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="../assets/plugins/flot/jquery.flot.categories.min.js"></script>
<!--FLOT TIME Js-->
<script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>

<script type="text/javascript">

</script>
<script type="text/javascript">
    $(function () {
        /*
         * LINE CHART
         * ----------
         */
        //LINE   data from database
        var money_market_ke = <?php echo json_encode($rates_ke); ?>;
        var money_market_ug = <?php echo json_encode($rates_ug); ?>;
        var fixed_income = <?php echo json_encode($fixed_income); ?>;
        var equity_fund = <?php echo json_encode($equity_fund); ?>;
        var balanced_fund = <?php echo json_encode($balanced_fund); ?>;


        //console.log(fixed_income);

        var mmk_ln = {
            data: money_market_ke,
            color: "#3c8dbc",
            label: "ICEA Lion Money Market Fund"

        };
        var mmu_ln = {
            data: money_market_ug,
            color: "#3c8dbc",
            label: "ICEA Uganda Money Market Fund"

        };
        var fixed = {
            data: fixed_income,
            color: "#00c0ef",
            label: "fixed Income"
        };
        var equity = {
            data: equity_fund,
            color: "#00c0ed",
            label: "Equity Fund"
        };
        var balanced = {
            data: balanced_fund,
            color: "#00c0ea",
            label: "Balanced Fund"
        };
        $.plot("#line-chart-m", [mmk_ln, mmu_ln], {
            grid: {
                hoverable: true,
                borderColor: "#f3f3f3",
                borderWidth: 1,
                tickColor: "#f3f3f3"
            },
            series: {
                shadowSize: 0,
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            lines: {
                fill: true,
                color: ["#3c8dbc", "#f56954"]
            },
            yaxis: {
                axisLabel: 'Rate',
                show: true,
                axisLabelUseCanvas: true
            },
            xaxis: {
                axisLabel: 'Date',
                show: true,
                mode: "time",
                timeformat: "%Y/%m/%d",
                min: money_market_ke['rate_date'],
                max: money_market_ke['rate_date'],
                axisLabelUseCanvas: false

            }
        });
        $.plot("#line-chart-eq", [equity], {
            grid: {
                hoverable: true,
                borderColor: "#f3f3f3",
                borderWidth: 1,
                tickColor: "#f3f3f3"
            },
            series: {
                shadowSize: 0,
                lines: {
                    show: true
                },
                points: {
                    show: true,
                    symbol: "triangle"
                }
            },
            lines: {
                fill: false,
                color: ["#3c8dbc", "#f56954"]
            },
            yaxis: {
                axisLabel: 'Price',
                show: true,
                axisLabelUseCanvas: true
            },
            xaxis: {
                axisLabel: 'Date',
                show: true,
                mode: "time",
                timeformat: "%Y/%m/%d",
                min: equity_fund['nav_date'],
                max: equity_fund['nav_date'],
                axisLabelUseCanvas: true

            }
        });
        $.plot("#line-chart-bl", [balanced], {
            grid: {
                hoverable: true,
                borderColor: "#f3f3f3",
                borderWidth: 1,
                tickColor: "#f3f3f3"
            },
            series: {
                shadowSize: 0,
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            lines: {
                fill: false,
                color: ["#3c8dbc", "#f56954"]
            },
            yaxis: {
                axisLabel: 'Price',
                show: true,
                axisLabelUseCanvas: true
            },
            xaxis: {
                axisLabel: 'Date',
                show: true,
                mode: "time",
                timeformat: "%Y/%m/%d",
                min: balanced_fund['nav_date'],
                max: balanced_fund['nav_date'],
                axisLabelUseCanvas: true

            }
        });
        $.plot("#line-chart-fi", [fixed], {
            grid: {
                hoverable: true,
                borderColor: "#f3f3f3",
                borderWidth: 1,
                tickColor: "#f3f3f3"
            },
            series: {
                shadowSize: 0,
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            lines: {
                fill: false,
                color: ["#3c8dbc", "#f56954"]
            },
            yaxis: {
                axisLabel: 'Price',
                show: true,
                axisLabelUseCanvas: true
            },
            xaxis: {
                axisLabel: 'Date',
                show: true,
                mode: "time",
                timeformat: "%Y/%m/%d",
                min: fixed_income['nav_date'],
                max: fixed_income['nav_date'],
                axisLabelUseCanvas: true

            }
        });
        //Initialize tooltip on hover
        $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
            position: "absolute",
            display: "none",
            opacity: 0.8
        }).appendTo("body");
        $("#line-chart-m").bind("plothover", function (event, pos, item) {

            if (item) {
                var x = new Date(item.datapoint[0]),
                    y = item.datapoint[1].toFixed(2);

                $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                    .css({top: item.pageY + 5, left: item.pageX + 5})
                    .fadeIn(200);
            } else {
                $("#line-chart-tooltip").hide();
            }

        });
        $("#line-chart-eq").bind("plothover", function (event, pos, item) {

            if (item) {
                var x = new Date(item.datapoint[0]),
                    y = item.datapoint[1].toFixed(2);

                $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                    .css({top: item.pageY + 5, left: item.pageX + 5})
                    .fadeIn(200);
            } else {
                $("#line-chart-tooltip").hide();
            }

        });
        $("#line-chart-bl").bind("plothover", function (event, pos, item) {

            if (item) {
                var x = new Date(item.datapoint[0]),
                    y = item.datapoint[1].toFixed(2);

                $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                    .css({top: item.pageY + 5, left: item.pageX + 5})
                    .fadeIn(200);
            } else {
                $("#line-chart-tooltip").hide();
            }

        });
        $("#line-chart-fi").bind("plothover", function (event, pos, item) {

            if (item) {
                var x = new Date(item.datapoint[0]),
                    y = item.datapoint[1].toFixed(2);

                $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                    .css({top: item.pageY + 5, left: item.pageX + 5})
                    .fadeIn(200);
            } else {
                $("#line-chart-tooltip").hide();
            }

        });
        /* END LINE CHART */
    })
    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
            + label
            + "<br>"
            + Math.round(series.percent) + "%</div>";
    }

</script>
</body>
</html>