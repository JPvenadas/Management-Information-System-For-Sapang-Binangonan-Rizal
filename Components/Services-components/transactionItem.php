<?php
function generateItem($transaction){
?>
<button type="submit" name="view_resident_button" class="transaction-record">
    <div class="left">
        <div class="record-info">
            <p class="certificate"><?php echo $transaction['serviceName']?></p>
            <p class="issuer">Issued by <?php echo $transaction['fullName']?></p>
        </div>
    </div>
    <div class="date-issued">
        <p><?php echo date("F j, Y",strtotime($transaction['dateRequested']))?></p>
    </div>
</button>

<?php }?>