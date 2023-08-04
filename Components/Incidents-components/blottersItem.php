<?php
function generateItem($blotter){
?>
<a href="../../Pages/Incidents/Blotter.php?id=<?php echo $blotter['blotterID']?>" class="record">
    <div class="left">
            <div class="record-info">
                <h3><?php echo $blotter['summary']?></p>
                <p><?php echo $blotter['complainant'] . " - " . $blotter['defendant']?></p>
            </div>
            <?php include "Hearings.php"?>
        </div>
        <div class="action">
            <p><?php echo $blotter['caseStatus']?></p>
    </div>
</a>

<?php }?>