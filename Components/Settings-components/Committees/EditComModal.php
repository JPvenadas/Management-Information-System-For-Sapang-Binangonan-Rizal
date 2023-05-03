<div id="edit-committee" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeEditcommittee()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <form action="../../Pages/Settings/Settings.php?page=committees" method="post" class="container">
            <p>Personnel's committee</p>
            <div class="flex">
                <input id="committeeID" type="hidden" name="committeeID">
                <input id="committeeName" type="text" name="committee" required placeholder="committee" class="input">
                <div>
                    <button class="save" name="edit_committee">Save</button>
                    <button class="save" name="archive_committee">Archive</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
let editCommitteeModal = document.getElementById('edit-committee')
editCommitteeModal.style.display = 'none'

function closeEditcommittee() {
    console.log("hello")
    editCommitteeModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openEditcommittee(committee) {
    let committeeID = document.querySelector('#committeeID')
    let committeeName = document.querySelector('#committeeName')

    committeeID.value = committee
    committeeName.value = committee

    editCommitteeModal.style.display = "flex"
    body.style.overflowY = "hidden"

}
</script>