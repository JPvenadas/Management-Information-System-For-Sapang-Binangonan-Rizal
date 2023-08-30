<?php
function solveAge($birthDate){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($birthDate), date_create($today));
    return $diff->format('%y') . " years old";
}
function generateResidentItem($resident, $text){

?>
<form action="../../Functions/residents-sql-commands.php" method="post">
<input name="residentID" type="hidden" value="<?php echo $resident['residentID']?>">
<button type="submit" name="view_resident_button" class="resident-item-record">
    <div class="resident-info-container">
        <div class="resident-image-container">
            <img loading="lazy" class="resident-image"
                src="../../Upload-img/<?php echo $resident['image']?>" alt="">
        </div>
        <div class="resident-info">
            <p class="resident-fullname"><?php echo $resident['fullName']?></p>
            <p class="resident-age"><?php echo solveAge($resident['birthDate'])?></p>
            <p class="resident-purok"><?php echo $resident['purok']?></p>
        </div>
    </div>
    <div class="action-text">
        <p><?php echo $text?></p>
    </div>
</button>
</form>
<?php }?>