<div class="transactions-container">
    <?php
    require "ServiceItem.php"; 
    $services = getServices();
    foreach($services as $service){
        generateItem($service);
    }
    ?>
</div>