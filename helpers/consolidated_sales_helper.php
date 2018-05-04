<?php
/**
 * Created by PhpStorm.
 * User: Allan
 * Date: 24/04/2018
 * Time: 09:03
 */
require_once('../app/Loader.php');

$transObj = new \app\application\controller\transactionController();
$post_data = json_decode($_POST['data']);
$startDate = $post_data->start_date;
$endDate = $post_data->end_date;
$sales = $transObj->consolidatedSales($startDate, $endDate);

?>
<table class="table table-condensed table-stripped table-bordered" id="sales">
    <thead>
    <tr>
        <th>Portfolio</th>
        <th>Amount</th>
        <th>Net Amount</th>
        <th>Trans Type</th>
        <th>Mop</th>
        <th>Trans Id</th>
        <th>shares</th>
        <th>Member No</th>
        <th>Full Name</th>
        <th>Trans Date</th>
        <th>Init Depo</th>
    </tr>
    </thead>
    <tbody>
	<?php foreach ($sales->data as $data): ?>
        <tr>
            <td><?= $data->portfolio; ?></td>
            <td><?= $data->amount; ?></td>
            <td><?= $data->netamount; ?></td>
            <td><?= $data->trans_type; ?></td>
            <td><?= $data->mop; ?></td>
            <td><?= $data->trans_id; ?></td>
            <td><?= $data->shares; ?></td>
            <td><?= $data->member_no; ?></td>
            <td><?= $data->full_name; ?></td>
            <td><?= $data->trans_date; ?></td>
            <td><?= is_null($data->initdepo) ? 0.0 : $data->initdepo; ?></td>
        </tr>_d
	<?php endforeach; ?>
    </tbody>
</table>
