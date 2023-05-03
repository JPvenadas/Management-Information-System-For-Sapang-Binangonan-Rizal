<div id="edit-purok" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeEditPurok()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <form action="../../Pages/Settings/Settings.php?page=purok" method="post" class="container">
            <p>Barangay Purok</p>
            <div class="flex">
                <input id="purokID" type="hidden" name="purokID">
                <input id="purokName" name="purokName" type="text" required placeholder="Purok" class="input">
                <button class="save" name="edit_purok">Save</button>
                <button class="save" name="archive_purok">Archive</button>
            </div>
        </form>
    </div>
</div>

<script>
let editPurokModal = document.getElementById('edit-purok')
editPurokModal.style.display = 'none'

function closeEditPurok() {
    console.log("hello")
    editPurokModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openEditPurok(purok) {
    let purokID = document.querySelector('#purokID')
    let purokName = document.querySelector('#purokName')

    purokID.value = purok
    purokName.value = purok

    editPurokModal.style.display = "flex"
    body.style.overflowY = "hidden"

}
</script>