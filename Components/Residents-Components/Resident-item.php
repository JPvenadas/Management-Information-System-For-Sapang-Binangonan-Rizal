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
<button type="submit" name="view_resident_button" class="list-item">
    <div class="left">
        <div class="list-item-image">
            <img loading="lazy" src="../../Upload-img/<?php echo $resident['image']?>" alt="">
        </div>
        <div class="list-item-info">
            <h4><?php echo $resident['fullName']?></h4>
            <p><?php echo solveAge($resident['birthDate'])?></p>
            <p><?php echo $resident['purok']?></p>
        </div>
    </div>
    <div class="right">
        <p><?php echo $text?></p>
    </div>
</button>
</form>
<?php }?>