<?php
function generateItem($service){
    $formattedFee= str_pad(number_format($service['serviceFee'], 2),4,'0',STR_PAD_LEFT);
?>
 <div onclick="openResidentModal('<?php echo $service['serviceName']?>',
                                 '<?php echo $formattedFee?>',
                                 '<?php echo $service['serviceType']?>')" class="services-item">
        <div class="left">
            <img src="../../Images/documents2.png" alt="">
        </div>
        <div class="right">
            <h3><?php echo $service['serviceName'];?></h3>
            <p>Click here to request</p>
        </div>
</div>
<?php } ?>