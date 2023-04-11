<?php
function solveAge($birthDate){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($birthDate), date_create($today));
    return $diff->format('%y') . " years old";
}
function generateResidentItem($resident){

?>
<button onclick="selectResident('<?php echo $resident['residentID']?>',
                                '<?php echo $resident['fullName']?>')" type="submit" name="view_resident_button" class="resident-item-record">
    <div class="resident-info-container">
        <div class="resident-image-container">
            <img id="image-<?php echo $resident['residentID']?>" class="resident-image"
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
<script>
    function selectResident(id, name){
        document.querySelector("#borrower-id").value = id;
        document.querySelector("#borrower-name").value = name;
        closeResidentModal();
        openBorrowItemModal();
    }
</script>
<?php }?>