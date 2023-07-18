<div id="edit-position" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeEditPosition()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <form action="../../Pages/Settings/Settings.php?page=positions" method="post" class="container">
            <p>Personnel's Position</p>
            <div class="flex">
                <input id="positionID" type="hidden" name="positionID">
                <input id="positionName" type="text" name="positionName" required placeholder="Position" class="input">
                <div>
                    <button class="save" name="edit_position">Save</button>
                    <button class="save" name="archive_position">Archive</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
let editPostionModal = document.getElementById('edit-position')
editPostionModal.style.display = 'none'

function closeEditPosition() {
    console.log("hello")
    editPostionModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openEditPosition(position) {
    let positionID = document.querySelector('#positionID')
    let positionName = document.querySelector('#positionName')

    positionID.value = position
    positionName.value = position

    editPostionModal.style.display = "flex"
    body.style.overflowY = "hidden"

}
</script>