<?php
function generateTransaction($transaction){
    $formattedFee =  str_pad(number_format($transaction['serviceFee'], 2),4,'0',STR_PAD_LEFT);
?>
<button onclick="openEditTransactionModal('<?php echo $transaction['transactionID']?>',
                                          '<?php echo $transaction['transactionStatus']?>',
                                          '<?php echo $transaction['serviceName']?>',
                                          '<?php echo $transaction['serviceFee']?>',
                                          '<?php echo $transaction['serviceType']?>',
                                          '<?php echo $transaction['residentID']?>',
                                          '<?php echo $transaction['fullName']?>',
                                          '<?php echo $transaction['purpose']?>')" type="submit" name="view_resident_button" class="transaction-record">
    <div class="left">
        <div class="record-info">
            <p class="certificate"><?php echo $transaction['serviceName']?></p>
            <p class="issuer">Requested by <?php echo $transaction['fullName']?></p>
        </div>
    </div>
    <div class="date-issued">
        <p><?php 
        if($transaction['transactionStatus'] == "Unprocessed"){
            echo "Pending Request";
        }elseif($transaction['transactionStatus'] == "Processed"){
            echo "Ready to be Claimed";
        }elseif($transaction['transactionStatus'] == "Finished"){
            echo "Paid and Claimed";
        }
        ?></p>
    </div>
</button>

<?php }?>