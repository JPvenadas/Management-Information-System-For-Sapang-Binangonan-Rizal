<div id="next-hearing-modal" class="modal-background-blur">
    <form action="../../Pages/Incidents/Incidents.php" method="post" class="edit modal-content-container">
        <div onclick="closeNextHearingModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Add Next Hearing</h3>
            <input type="hidden" id="blotterID2" name="blotterID">
        </div>
        <div class="information-container">
            <div style="display: flex; gap: 10px;">
                 <input type="hidden" name="totalHearing" id="totalHearing" value="">
                 <input value="" type="date" class="date-input" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
        </div>
        <div class="button-container">
            <button name="add_next_hearing" type="submit">
                <ion-icon name="add"></ion-icon>
                <p>Add</p>
            </button>
        </div>
    </form>
</div>
<script>
    let nextHearingModal = document.querySelector("#next-hearing-modal");

function closeNextHearingModal() {
   nextHearingModal.style.display = "none"
   body.style.overflowY = "auto"
}

function openNextHearingModal(ID, totalHearing) {
    document.querySelector("#blotterID2").value = ID;
    document.querySelector("#totalHearing").value = totalHearing;

   nextHearingModal.style.display = "flex"
   body.style.overflowY = "hidden"
   closEditBlotterModal()
}
</script>