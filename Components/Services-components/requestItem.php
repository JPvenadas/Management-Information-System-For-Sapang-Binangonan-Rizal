<?php
function generateRequest($transaction){
    $formattedFee =  str_pad(number_format($transaction['serviceFee'], 2),4,'0',STR_PAD_LEFT);
?>
<button onclick="openEditTransactionModal('<?php echo $transaction['transactionID']?>',
                                          '<?php echo $transaction['transactionStatus']?>',
                                          '<?php echo $transaction['serviceName']?>',
                                          '<?php echo $transaction['serviceFee']?>',
                                          '<?php echo $transaction['serviceType']?>',
                                          '<?php echo $transaction['residentID']?>',
                                          '<?php echo $transaction['fullName']?>',
                                          '<?php echo $transaction['purpose']?>',
                                          '<?php echo !empty($transaction['paymentProof'])?>')" type="submit" name="view_resident_button" class="transaction-record">
    <div class="left">
    <?php if(!empty($transaction['paymentProof'])){?>
        <img class="payment-image" id="payment-image-<?php echo $transaction['transactionID']?>" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($transaction['paymentProof']); ?>" alt="">
    <?php }?>
        <div class="record-info">
            <p class="certificate"><?php echo $transaction['serviceName']?></p>
            <p class="issuer">Requested by <?php echo $transaction['fullName']?></p>
        </div>
    </div>
    <div class="date-issued">
        <p><?php echo "Requested " . date("F j, Y",strtotime($transaction['dateRequested']))?></p>
    </div>
</button>

<?php }?>