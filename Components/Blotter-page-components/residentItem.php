<?php
function generateResidentItem2($resident){?>
<form action="" method="post">
    <input class="field-change" type="hidden" name="field">
    <input type="hidden" name="residentID" value="<?php echo $resident['residentID']?>">
    <button type="submit" name="change_participants" class="resident-item-record">
        <div class="resident-info-container">
            <div class="resident-image-container">
                <img loading="lazy" id="image-<?php echo $resident['residentID']?>" class="resident-image"
                    src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($resident['image']); ?>" alt="">
            </div>
            <div class="resident-info">
                <p class="resident-fullname"><?php echo $resident['fullName']?></p>
                <p class="resident-age"><?php echo solveAge($resident['birthDate'])?></p>
                <p class="resident-purok"><?php echo $resident['purok']?></p>
            </div>
        </div>
        <div class="action-text">
        </div>
    </button>
</form>

<?php }?>