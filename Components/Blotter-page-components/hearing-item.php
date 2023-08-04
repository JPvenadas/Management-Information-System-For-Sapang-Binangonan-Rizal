<?php
    function generateHearingItem($hearing){
?>
<div class="hearing-item">
        <div class="hearing-header">
            <h4>Hearing <?php echo $hearing['number']?></h4>
            <div class="left">
                <p class="hearing-date">
                    <?php
                        $dateTime = new DateTime($hearing['date']);
                        echo $dateTime->format('F, j, Y');
                    ?>
                </p>
                <button onclick="openEditHearingModal('<?php echo $hearing['date']?>',
                                                     '<?php echo $hearing['hearingID']?>')">
                    edit
                </button>
            </div>
        </div>
        <h5 class="subtitle paddingx-20">Documentation:</h5>
        <div class="documentation">
            <?php
                generateDocPhoto(1, $hearing['hearingID'], $hearing['documentation1']);
                generateDocPhoto(2, $hearing['hearingID'], $hearing['documentation2']);
                generateDocPhoto(3, $hearing['hearingID'], $hearing['documentation3']);
            ?>
        </div>
        <div class="hearing-result">
            <h6 class="subtitle">Hearing-result:</h6>
            <p class="subtitle"><?php echo $hearing['hearingResult']?></p>
        </div>
    </div>
<?php }?>