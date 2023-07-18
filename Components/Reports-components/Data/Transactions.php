<table>
    <tr>
        <th>Resident</th>
        <th>Service</th>
        <th>Date Requested</th>
        <th>Amount</th>
        <th>Date Processed</th>
        <th>Status</th>
        <th>Purpose</th>
    </tr>
    <?php
                        $transactions = getTransactions();
                        foreach($transactions as $transaction){?>
    <tr>
        <td><?php echo $transaction['resident']?></td>
        <td><?php echo $transaction['serviceName']?></td>
        <td><?php echo $transaction['dateRequested']?></td>
        <td><?php echo $transaction['amountPaid']?></td>
        <td><?php echo $transaction['paymentDate']?></td>
        <td><?php echo $transaction['transactionStatus']?></td>
        <td><?php echo $transaction['purpose']?></td>
    </tr>
    <?php }?>
</table>
<?php
    $revenue = getRevenues();
    $total = $revenue['totalRevenue'];
    $from = $revenue['oldestPaymentDate']
?>

<div class="other-report">
    <p class="subject">Total Revenue: </p>
    <p class="value"><?php echo "$total"?> ₱</p> 
</div>
<div class="other-report">
    <p class="subject">Date: </p>
    <p class="value"><?php if(isset($_GET['start']) and isset($_GET['end'])){
        echo " from " . $_GET['start'] . " to " . $_GET['end'];
    }else{
        echo "from $from to Present";
    } ?></p> 
</div>
