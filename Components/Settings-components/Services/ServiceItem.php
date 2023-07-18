<?php function generateItem($service){
    //convert the service fee to 0.00 PHP format and display free if 0
    $amount="";
    if($service['serviceFee'] == "0"){
        $amount = "FREE";
    }else{
        $amount = $service['serviceFee'] . ".00 PHP";
    }
?>
<button onclick="openAmountModal('<?php echo $service['serviceName']?>',
                                 '<?php echo $service['serviceFee']?>',)" class="service-item">
    <div class="left">
        <div class="record-info">
            <p class="certificate"><?php echo $service['serviceName']?></p>
            <p class="amount">Amount: <span><?php echo $amount?></span></p>
        </div>
    </div>
    <div class="right">
        <p>Change the amount</p>
    </div>
</button>
<?php }?>