<div class="purok-container">
    <div class="buttonContainer">
        <button onclick="openAddPurok()" class="add-button">
            <ion-icon name="add-sharp"></ion-icon>
            <p>Add Purok</p>
        </button>
    </div>
    <div>
        <?php require "PurokItem.php";
        $puroks = getPurok();
       foreach($puroks as $purok){
        generateItem($purok);
       }
        ?>
    </div>
</div>