<div class="services-container">
    <div class="buttonContainer">
        <button onclick="openAddService()" class="add-button">
            <ion-icon name="add-sharp"></ion-icon>
            <p>Add a Service</p>
        </button>
    </div>
    <div>
        <?php
        require "ServiceItem.php"; 
        $services = getServices();
        foreach($services as $service){
            generateItem($service);
        }
        ?>
    </div>
</div>