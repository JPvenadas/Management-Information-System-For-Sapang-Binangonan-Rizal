<?php
function solveAge($birthDate){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($birthDate), date_create($today));
    return $diff->format('%y') . " years old";
}
function generateResidentItem($resident){

?>
<script>
    function modalAction(ID, name, birthDate){
        if(action === "curfewViolator"){
            openTimeModal(ID,name, birthDate)
            closeMinorsModal();
        }else if(action === "complainant"){
            document.querySelector('#complainant-ID').value = ID
            document.querySelector('#complainant-fullName').value = name
            openAddBlotterModal()
            closeResidentModal()
        }else if(action === "defendant"){
            document.querySelector('#defendant-ID').value = ID
            document.querySelector('#defendant-fullName').value = name
            openAddBlotterModal()
            closeResidentModal()
        }else if(action === "mediator"){
            document.querySelector('#mediator-ID').value = ID
            document.querySelector('#mediator-fullName').value = name
            openAddBlotterModal()
            closeResidentModal()
        }
    }
</script>
<button onclick="modalAction('<?php echo $resident['residentID']?>',
                               '<?php echo $resident['fullName']?>',
                               '<?php echo solveAge($resident['birthDate'])?>')" type="submit" name="view_resident_button" class="resident-item-record">
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

<?php }?>