<div class="transactions-container">
    <?php require "transactionItem.php";
    $transactions = getTransactions();
        foreach ($transactions as $transaction) {
        generateItem($transaction);
        }
    ?>
</div>