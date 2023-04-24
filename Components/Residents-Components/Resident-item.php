<?php
function solveAge($birthDate){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($birthDate), date_create($today));
    return $diff->format('%y') . " years old";
}
function generateResidentItem($residentID ,$firstName, $middleName, $lastName, $image, $birthDate, $purok){

?>
<form action="../../Functions/residents-sql-commands.php" method="post">
<input name="residentID" type="hidden" value="<?php echo $residentID?>">
<button type="submit" name="view_resident_button" class="resident-item-record">
    <div class="resident-info-container">
        <div class="resident-image-container">
            <img class="resident-image"
                src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="">
        </div>
        <div class="resident-info">
            <p class="resident-fullname"><?php echo "$firstName $middleName $lastName"?></p>
            <p class="resident-age"><?php echo solveAge($birthDate)?></p>
            <p class="resident-purok"><?php echo $purok?></p>
        </div>
    </div>
    <div class="action-text">
        <p>Click to see Profile</p>
    </div>
</button>
</form>
<?php }?>