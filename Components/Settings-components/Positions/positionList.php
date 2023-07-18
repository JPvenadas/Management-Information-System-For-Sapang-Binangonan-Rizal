<div class="position-container">
    <div class="buttonContainer">
        <button onclick="openAddPosition()" class="add-button">
            <ion-icon name="add-sharp"></ion-icon>
            <p>Add Position</p>
        </button>
    </div>
    <div>
        <?php require "positionItem.php";
        $positions = getPositions();
       foreach($positions as $position){
        generateItem($position);
       }
        ?>
    </div>
</div>