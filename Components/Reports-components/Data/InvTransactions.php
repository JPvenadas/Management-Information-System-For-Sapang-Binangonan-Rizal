<table>
    <tr>
        <th>ID</th>
        <th>Borrower</th>
        <th>Item Borrowed</th>
        <th>Quanity</th>
        <th>Date</th>
        <th>Status</th>
    </tr>
    <?php
                        $transactions = getInventoryTransactions();
                        foreach($transactions as $transaction){?>
    <tr>
        <td><?php echo $transaction['transactionID']?></td>
        <td><?php echo $transaction['fullName']?></td>
        <td><?php echo $transaction['itemName']?></td>
        <td><?php echo $transaction['quantity']?></td>
        <td><?php echo $transaction['date']?></td>
        <td><?php echo $transaction['status']?></td>
    </tr>
    <?php }?>
</table>