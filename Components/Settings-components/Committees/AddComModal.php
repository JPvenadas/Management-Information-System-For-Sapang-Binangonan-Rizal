<div id="add-committee" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeAddcommittee()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <form action="../../Pages/Settings/Settings.php?page=committees" method="post" class="container">
            <p>Add new Committee</p>
            <div class="flex">
                <input name="committee" type="text" required placeholder="committee" class="input">
                <button class="save" name="add_committee">Add</button>
            </div>
        </form>
    </div>
</div>

<script>
let addcommitteeModal = document.getElementById('add-committee')
addcommitteeModal.style.display = 'none'

function closeAddcommittee() {
    console.log("hello")
    addcommitteeModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openAddcommittee() {

    addcommitteeModal.style.display = "flex"
    body.style.overflowY = "hidden"

}
</script>