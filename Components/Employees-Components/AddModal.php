<?php require "Datalists.php"?>
<div id="add-modal" class="modal-background-blur">
    <form  enctype="multipart/form-data" action="?" method="post" class="modal-content-container">
        <div onclick="closeAddModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Add an Employee</h3>
            <p>Fill the necessary information below</p>
        </div>
        <div class="container">
            <p class="modal-title-container">Resident's profile</p>
            <input autocomplete="off" type="text" name="residentID" list="residents" required placeholder="choose the resident's profile here" class="input">

            <div class="signiture-container">
                <input required placeholder="Upload a signiture" id="image-title" class="input" class="signiture-image-name" readonly
                    type="text">
                <input required id="signiture" name="signiture" hidden type="file">
                <label id="upload" class="signiture-button" for="signiture">
                    <p>Upload</p>
                </label>
                <label id="upload-icon" class="signiture-button" for="signiture">
                    <ion-icon name="caret-up"></ion-icon>
                </label>
            </div>
        </div>
        <div class="container">
            <p class="modal-title-container">Assigned Role</p>
            <input required autocomplete="off" class="input" name="position" type="text" list="positions" placeholder="Employee's position">
            <input required autocomplete="off" class="input" name="committee" type="text" list="committee" placeholder="Committee"> 
           
            <div class="term-container">
                <input required name="termstart" class="input" onfocus="(this.type = 'date')" type="text" placeholder="Start of Term">
            </div>
            <div class="term-container">
            <input required name="termend" class="input" onfocus="(this.type = 'date')" type="text" placeholder="Expected end of Term">
            </div>
        </div>
        <div class="button-container">
            <button type="submit" name="add_employee">
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
