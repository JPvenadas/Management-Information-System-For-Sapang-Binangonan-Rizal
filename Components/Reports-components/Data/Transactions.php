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