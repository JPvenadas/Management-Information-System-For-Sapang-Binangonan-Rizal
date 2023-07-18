<p class="header">Offered Services</p>
<div class="services-container">
    <?php
    require "ServicesItem.php";
    $services = getServices();
    foreach($services as $service){
        generateItem($service);
    }
    ?>
</div>
<div class="transactions-container">
    <p class="header">Your Transactions</p>
    <?php require "TransactionItem.php";
    $transactions = getTransactionsbyResident();
        foreach ($transactions as $transaction) {
        generateTransaction($transaction);
        }
    ?>
</div>