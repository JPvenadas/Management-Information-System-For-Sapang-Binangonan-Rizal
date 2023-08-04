<div id="next-hearing-modal" class="modal-background-blur">
    <form action="" method="post" class="edit modal-content-container">
        <div onclick="closeNextHearingModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Add another Hearing</h3>
            <input type="hidden" value="<?php echo $_GET['id']?>" name="blotterID">
        </div>
        <div class="information-container">
            <div style="display: flex; gap: 10px;">
                 <input value="" type="date" class="date-input" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
        </div>
        <div class="button-container">
            <button class="button" name="add_next_hearing" type="submit">
                <ion-icon name="add"></ion-icon>
                <p>Add</p>
            </button>
        </div>
    </form>
</div>
<script>
    let body = document.querySelector('body');
    let nextHearingModal = document.querySelector("#next-hearing-modal");

function closeNextHearingModal() {
   nextHearingModal.style.display = "none"
   body.style.overflowY = "auto"
}

function openNextHearingModal() {

   nextHearingModal.style.display = "flex"
   body.style.overflowY = "hidden"
}
</script>