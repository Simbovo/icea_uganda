    <?php
    /**
    * Created by PhpStorm.
    * User: Allan Wiz
    * Date: 17/02/16
    * Time: 12:23
    */

    session_start();

    //require the autoload file.
    require('../app/Loader.php');

    //initialize the class to be used
    use app\application\controller\transactionController;
    use application\library\Logger;

    $obj = new transactionController();
    $logger = new Logger();
    foreach ($_POST as $key => $value) {
        $$key = $value;
    }
    

    $agent_code = $_SESSION['ref_no'];
    $start_date = date('Y-m-d', strtotime($startDate));
    $end_date = date('Y-m-d', strtotime($endDate));

    $_SESSION['startDate'] = $start_date;
    $_SESSION['endDate'] = $end_date;


    $agent_transactions = $obj->agent_commission($agent_code, $start_date, $end_date);
    

    ?>


    <table id="commission" class="table table-hover table-condensed table-responsive">
        <thead>
            <tr>
                <th>Member #</th>
                <th>Name</th>
                <th>Fund</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($agent_transactions as $result) {

                echo "<tr>";
                echo "<td>" . $result->member_no . "</td>";
                echo "<td>" . $result->allnames . "</td>";
                echo "<td>" . $result->descript . "</td>";
                echo "<td style='text-align:right'>" .number_format((float)$result->commision, 2, '.', ''). "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total:</th>
                <th style="text-align:right"></th>
            </tr>
        </tfoot>
    </table>
