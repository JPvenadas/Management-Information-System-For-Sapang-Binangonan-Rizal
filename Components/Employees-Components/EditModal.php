<div id="edit-modal" class="modal-blur">
    <div class="modal-scroll">
        <form action="../../Pages/Employees/Employees.php" method="post" class="modal-content-container">
            <div onclick="closeEditModal()" class="modal-close-button">
                <ion-icon name="close"></ion-icon>
            </div>
            <div class="modal-content">
                <div class="modal-title">
                    <h3>Assign Role</h3>
                    <p>Fill the necessary information below</p>
                </div>
                <div class="modal-inputs">
                    <input required type="hidden" id="employeeID" name="employeeID">
                    <div class="input-container">
                        <label for="residentID">resident ID</label>
                        <input autocomplete="off" type="text" id="residentID" name="residentID" list="residents"
                            required placeholder="choose the resident's profile here" class="input">
                    </div>
                    <div class="input-container">
                        <label for="position">Position</label>
                        <input list="positions" name="position" id="position" class="input" type="text"
                            placeholder="Employee's position">
                    </div>
                    <div class="input-container">
                        <label for="committeeField">Committee</label>
                        <input list="committee" name="committee" id="committeeField" class="input" type="text"
                            placeholder="Committee">
                    </div>
                    <div class="input-container">
                        <label for="schedule">Daily Schedule(optional)</label>
                        <input id="schedule" autocomplete="off" class="input" name="schedule" type="text" list="days"
                            placeholder="Schedule">
                    </div>
                    <div class="input-container-flex-2">
                        <div class="left">
                            <label for="termstart">Start of Term</label>
                            <input id="termstart" name="termstart" class="input" onfocus="(this.type = 'date')"
                                type="text" placeholder="Start of Term">
                        </div>
                        <div class="right">
                            <label for="termend">End of Term</label>
                            <input id="termend" name="termend" class="input" onfocus="(this.type = 'date')" type="text"
                                placeholder="Expected end of Term">
                        </div>
                    </div>
                    <div class="input-container">
                        <label for="">E-signiture</label>
                        <div class="input-with-button">
                            <input id="image-title-edit" placeholder="Change the signiture" class="input" readonly
                                type="text">
                            <input accept="image/png" id="signiture-edit" name="signiture" hidden type="file">
                            <label id="upload" class="input-button" for="signiture-edit">
                                <p>Upload</p>
                            </label>
                            <label id="upload-icon" class="input-button" for="signiture-edit">
                                <ion-icon name="caret-up"></ion-icon>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-button-container">
                <button class="opposite-button" name="deactivate_term" type="submit">
                    <ion-icon name="settings"></ion-icon>
                    <p>End Term</p>
                </button>
                <button class="main-button" name="edit_employee" type="submit">
                    <ion-icon name="settings"></ion-icon>
                    <p>Save</p>
                </button>
            </div>
            </div>
        </form>
    </div>
</div>

<script>
let editModal = document.getElementById('edit-modal');
let signitureEdit = document.querySelector('#signiture-edit');
editModal.style.display = 'none'

signitureEdit.addEventListener('change', (event) => {
    imageTitleField = document.querySelector('#image-title-edit')
    var image = event.target.files[0]
    imageTitleField.value = image.name
})

function closeEditModal() {
    editModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openEditModal(employeeID, residentsID, positionID, committee, termstart, termend, schedule) {
    editModal.style.display = "flex"
    body.style.overflowY = "hidden"

    let residentIDField = document.querySelector("#residentID")
    let employeeIDField = document.querySelector("#employeeID")
    let positionField = document.querySelector("#position")
    let committeeField = document.querySelector("#committeeField")
    let termstartField = document.querySelector("#termstart")
    let termendField = document.querySelector("#termend")
    let scheduleField = document.querySelector("#schedule")


    residentIDField.value = residentsID
    employeeIDField.value = employeeID
    positionField.value = positionID
    committeeField.value = committee
    termstartField.value = termstart
    termendField.value = termend
    if (schedule) {
        scheduleField.value = schedule
    } else {
        scheduleField.value = 'No fixed Schedule'
    }


}
</script>