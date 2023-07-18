<div class="position-container">
    <div class="buttonContainer">
        <button onclick="openAddcommittee()" class="add-button">
            <ion-icon name="add-sharp"></ion-icon>
            <p>Add committee</p>
        </button>
    </div>
    <div>
        <?php require "ComItem.php";
        $committees = getCommittees();
       foreach($committees as $committee){
        generateItem($committee);
       }
        ?>
    </div>
</div>