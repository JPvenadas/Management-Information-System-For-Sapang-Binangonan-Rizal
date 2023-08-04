<div id="edit-hearing-modal" class="modal-background-blur">
    <form action="" method="post" class="edit modal-content-container">
        <div onclick="closeEditHearingModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Edit Hearing Date</h3>
            <input type="hidden" id="edit-hearingID" value="" name="hearingID">
        </div>
        <div class="information-container">
            <div style="display: flex; gap: 10px;">
                 <input value="" type="date" class="date-input" id="edit-hearing-date" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
        </div>
        <div class="button-container">
            <button class="button" name="edit_hearing" type="submit">
                <ion-icon name="save"></ion-icon>
                <p>Save</p>
            </button>
        </div>
    </form>
</div>
<script>
    let editHearingModal = document.querySelector("#edit-hearing-modal");

function closeEditHearingModal() {
   editHearingModal.style.display = "none"
   body.style.overflowY = "auto"
}

function openEditHearingModal(date, hearingID) {

    document.querySelector('#edit-hearingID').value = hearingID;
    document.querySelector('#edit-hearing-date').value = date;

   editHearingModal.style.display = "flex"
   body.style.overflowY = "hidden"
}
</script>