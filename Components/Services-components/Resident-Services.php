<div class="services-container">
    <?php
    require "servicesItem.php";
    $services = getServices();
    foreach($services as $service){
        generateItem($service);
    }
    ?>
</div>
<div class="transactions-container">
<p class="header">Pending Requests</p>
    <?php require "requestItem.php";
    $requests = getRequests();
        foreach ($requests as $request) {
        generateRequest($request);
        }
    ?>
</div>