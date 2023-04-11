<?php
function generateInUseItem($transaction){
?>
<button onclick="openEditTransactionModal()" type="submit" class="record">
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