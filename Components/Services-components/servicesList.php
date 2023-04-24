<div class="services-container">
    <?php
    require "servicesItem.php";
    $services = getServices();
    foreach($services as $service){
        generateItem($service);
    }
    ?>
</div>