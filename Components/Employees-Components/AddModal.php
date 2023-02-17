<?php require "Datalists.php"?>
<div id="add-modal" class="modal-background-blur">
    <form  enctype="multipart/form-data" action="" method="post" class="modal-content-container">
        <div onclick="closeAddModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Add an Employee</h3>
            <p>Fill the necessary information below</p>
        </div>
        <div class="container">
            <p>Resident's profile</p>
            <input autocomplete="off" type="text" name="residentsID" list="residents" required placeholder="choose the resident's profile here" class="input">

            <div class="signiture-container">
                <input placeholder="Upload a signiture" id="image-title" class="input" class="signiture-image-name" readonly
                    type="text">
                <input id="signiture" name="signiture" hidden type="file">
                <label class="signiture-button" for="signiture">
                    <p>Upload</p>
                </label>
            </div>
        </div>
        <div class="container">
            <p>Assigned Role</p>
            <input class="input" name="position" type="text" list="positions" placeholder="Personnel's position">
            <!-- include the datalists -->
            <div class="term-container">
                <input name="termstart" class="input" onfocus="(this.type = 'date')" type="text" placeholder="Start of Term">
                <input name="termend" class="input" onfocus="(this.type = 'date')" type="text" placeholder="Expected end of Term">
            </div>
        </div>
        <div class="button-container">
            <button type="submit" name="add_personnel">
                <ion-icon name="settings"></ion-icon>
                <p>Register</p>
            </button>
        </div>
    </form>
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
