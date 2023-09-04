<?php require "Datalists.php"?>
<div id="add-modal" class="modal-blur">
    <div class="modal-scroll">
        <form enctype="multipart/form-data" action="?" method="post" class="modal-content-container">
            <div onclick="closeAddModal()" class="modal-close-button">
                <ion-icon name="close"></ion-icon>
            </div>
            <div class="modal-content">
                <div class="modal-title">
                    <h3>Assign Role</h3>
                    <p>Fill the necessary information below</p>
                </div>
                <div class="modal-inputs">
                    <div class="input-container">
                        <label for="residentID-input">resident ID</label>
                        <input autocomplete="off" type="text" id="residentID-input" name="residentID" list="residents"
                            required placeholder="choose the resident's profile here" class="input">
                    </div>
                    <div class="input-container">
                        <label for="position-input">Position</label>
                        <input id="position-input" required autocomplete="off" class="input" name="position" type="text"
                            list="positions" placeholder="Employee's position">
                    </div>
                    <div class="input-container">
                        <label for="committee-input">Committee</label>
                        <input id="committee-input" required autocomplete="off" class="input" name="committee"
                            type="text" list="committee" placeholder="Committee">
                    </div>
                    <div class="input-container">
                        <label for="schedule-input">Daily Schedule(optional)</label>
                        <input id="schedule-input" required autocomplete="off" class="input" name="schedule" type="text"
                            list="days" placeholder="Schedule">
                    </div>
                    <div class="input-container-flex-2">
                        <div class="left">
                            <label for="start-input">Start of Term</label>
                            <input id="start-input" required name="termstart" class="input"
                                onfocus="(this.type = 'date')" type="text" placeholder="Start of Term">
                        </div>
                        <div class="right">
                            <label for="end-input">End of Term</label>
                            <input id="end-input" required name="termend" class="input" onfocus="(this.type = 'date')"
                                type="text" placeholder="Expected end of Term">
                        </div>
                    </div>
                    <div class="input-container">
                        <label for="">E-signiture</label>
                        <div class="input-with-button">
                            <input required placeholder="Upload a signiture" id="image-title" class="input"
                                class="signiture-image-name" readonly type="text">
                            <input accept="image/png" required id="signiture" name="signiture" hidden type="file">
                            <label id="upload" class="input-button" for="signiture">
                                <p>Upload</p>
                            </label>
                            <label id="upload-icon" class="input-button" for="signiture">
                                <ion-icon name="caret-up"></ion-icon>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-button-container">
                    <button type="submit" class="main-button" name="add_employee">
                        <ion-icon name="settings"></ion-icon>
                        <p>Register</p>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
let addModal = document.getElementById('add-modal');
let body = document.querySelector('body');
let signiture = document.querySelector('#signiture');
addModal.style.display = 'none'
console.log("hello")

signiture.addEventListener('change', (event) => {
    imageTitleField = document.querySelector('#image-title')
    var image = event.target.files[0]
    imageTitleField.value = image.name
})

function closeAddModal() {
    addModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openAddModal() {
    addModal.style.display = "flex"
    body.style.overflowY = "hidden"
}
</script>