<?php
function generateInUseItem($transaction){
?>
<button onclick="openEditTransactionModal('<?php echo $transaction['transactionID']?>',
                                          '<?php echo $transaction['fullName']?>',
                                          '<?php echo $transaction['itemID']?>',
                                          '<?php echo $transaction['itemName']?>',
                                          '<?php echo $transaction['quantity']?>',
                                          '<?php echo $transaction['date']?>',
                                          '<?php echo $transaction['status']?>',)" type="submit" class="record">
    <div class="left">
        <div class="record-info">
            <h3><?php 
            $quantity = $transaction['quantity'];
            $name = $transaction['itemName'];

            echo "$quantity $name";
            
            ?></p>
            <p>Borrowed/In use by <?php echo $transaction['fullName']?></p>
        </div>
    </div>
    <div class="action">
        <p><?php echo date("F j, Y",strtotime($transaction['date']))?></p>
    </div>
</button>

<?php }?>