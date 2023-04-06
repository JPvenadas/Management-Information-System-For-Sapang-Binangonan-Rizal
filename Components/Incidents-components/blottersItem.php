<?php
function generateItem($blotter){
?>
<button type="submit" class="record">
    <div class="left">
        <div class="record-info">
            <h3><?php echo $blotter['summary']?></p>
            <p><?php echo $blotter['complainant'] . " - " . $blotter['defendant']?></p>
        </div>
    </div>
    <div class="action">
        <p>Click to view details</p>
    </div>
</button>

<?php }?>