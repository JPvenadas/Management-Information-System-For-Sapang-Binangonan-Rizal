<?php
function generateItem($transaction){
?>
<button onclick="openEditTransactionModal()" type="submit" class="record">
    <div class="left">
        <div class="record-info">
            <h3><?php echo $transaction['itemName']?></p>
            <p>In use by <?php echo $transaction['fullName']?></p>
        </div>
    </div>
    <div class="action">
        <p>Click to view details</p>
    </div>
</button>

<?php }?>