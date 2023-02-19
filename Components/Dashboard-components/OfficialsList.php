<div class="barangay-officials-section">
    <h3 class="section-title">Barangay Officials List</h3>
    <div class="officials-items-container">
    <?php 
    require "OfficialsItem.php";

    //display the barangay captain
    $captain = getEmployees('Barangay Captain');
    generateItem($captain);

    //display the barangay secretary
    $secretary = getEmployees('Barangay Secretary');
    generateItem($secretary);

    $treasurer = getEmployees('Barangay Treasurer');
    generateItem($treasurer);

    //display the sangguniang barangay member (kagawad)
    $committees = getCommittee();

    foreach($committees as $committee){
        $kagawad = getKagawad($committee['committee']);
        generateItem($kagawad);
    }
    ?>
    </div>
</div>