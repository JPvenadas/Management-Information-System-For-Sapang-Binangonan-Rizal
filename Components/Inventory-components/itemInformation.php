
<div class="edit-button-container">
    <div class="section-title">Item Information</div>
</div>
<div class="item-information-container">
    <?php include "InputItem.php";
    generateItem("item Name", "text", $item['itemName']);
    generateItem("Item Quantity", "number", $item['totalNumber']);
    ?>
</div>
<div class="edit-button-container">
    <div class="section-title">In use Items</div>
</div>
<div class="item-information-container">
    <?php
    require "transactionItem2.php";
    $transactions = getTransactionsByItem();
    foreach($transactions as $transaction){
        generateInUseItem($transaction);
    }
    ?>
</div>