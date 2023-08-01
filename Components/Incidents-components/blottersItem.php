<?php
function generateItem($blotter){
?>
<button onclick="openEditBlotterModal('<?php echo $blotter['blotterID']?>',
                                      '<?php echo $blotter['complainant']?>',
                                      '<?php echo $blotter['defendant']?>',
                                      '<?php echo $blotter['summary']?>',
                                      '<?php echo $blotter['totalHearing']?>',
                                      '<?php echo $blotter['complainantContact']?>',
                                      '<?php echo $blotter['defendantContact']?>',
                                      '<?php echo $blotter['latestHearing']?>',
                                      '<?php echo $blotter['caseStatus']?>')" type="submit" class="record">
    <div class="left">
        <img loading="lazy" id="image-blotter-<?php echo $blotter['blotterID']?>" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($blotter['narrativeReport']); ?>" style="display: none;" alt="">
        <div class="record-info">
            <h3><?php echo $blotter['summary']?></p>
            <p><?php echo $blotter['complainant'] . " - " . $blotter['defendant']?></p>
        </div>
        <?php include "Hearings.php"?>
    </div>
    <div class="action">
        <p><?php echo $blotter['caseStatus']?></p>
    </div>
</button>

<?php }?>