<?php 
    $totalResidents = getNumberofResidents();
?>
<div class="first-division">
    <div class="top">
        <img class="residents-section-image" src="../../Images/residentsBackground.png" alt="">
    </div>
    <div class="bottom">
        <div class="residents-info">
            <h3 class="section-title">Registered residents</h3>
            <p class="data-text"><?php echo $totalResidents['number']?> Residents</p>
        </div>
        <div class="residents-view-button">
            <a href="../../Modules/Residents/residents.php">
                <button>View</button>
            </a>
        </div>
    </div>
</div>