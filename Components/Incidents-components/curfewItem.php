<?php
function generateItem($curfewViolation){
?>
<button onclick="openEditCurfewModal('<?php echo $curfewViolation['ID']?>',
                                     '<?php echo $curfewViolation['fullName']?>',
                                     '<?php echo $curfewViolation['time']?>',
                                     '<?php echo $curfewViolation['date']?>')" type="submit" class="record">
    <div class="left">
        <div class="record-info">
            <h3><?php echo $curfewViolation['fullName']?></p>
            <p><?php echo date("F, d, Y", strtotime($curfewViolation['date'])) . " " .  date("h:i A", strtotime($curfewViolation['time']))?></p>
        </div>
    </div>
    <div class="action">
        <p>Click to view details</p>
    </div>
</button>

<?php }?>