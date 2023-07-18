<div id="add-position" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeAddPosition()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <form action="../../Pages/Settings/Settings.php?page=positions" method="post" class="container">
            <p>Add Personnel's Position</p>
            <div class="flex">
                <input name="positionName" type="text" required placeholder="Position" class="input">
                <button class="save" name="add_position">Add</button>
            </div>
        </form>
    </div>
</div>

<script>
let addPositionModal = document.getElementById('add-position')
addPositionModal.style.display = 'none'

function closeAddPosition() {
    console.log("hello")
    addPositionModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openAddPosition() {

    addPositionModal.style.display = "flex"
    body.style.overflowY = "hidden"

}
</script>