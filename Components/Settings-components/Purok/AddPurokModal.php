<div id="add-purok" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeAddPurok()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <form action="../../Pages/Settings/Settings.php?page=purok" method="post" class="container">
            <p>Add Barangay Purok</p>
            <div class="flex">
                <input name="purokName" type="text" required placeholder="Purok" class="input">
                <button class="save" name="add_purok">Add</button>
            </div>
        </form>
    </div>
</div>

<script>
let addPurokModal = document.getElementById('add-purok')
addPurokModal.style.display = 'none'

function closeAddPurok() {
    addPurokModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openAddPurok() {

    addPurokModal.style.display = "flex"
    body.style.overflowY = "hidden"

}
</script>