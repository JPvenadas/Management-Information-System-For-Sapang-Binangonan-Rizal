<div id="verify-modal" class="modal-background-blur">
    <form method="post" action="../../Pages/Attendance/Attendance.php" class="modal-content-container">
        <div onclick="closeVerifyModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="profile-container">
            <div class="profile-image">
                <img id="profile-image" src="" alt="">
            </div>
            <div class="profile-information">
                <h4 id="name">Henry Legazpi Dela Cruz</h4>
                <p id="position">Barangay Captain</p>
            </div>
        </div>
        <div class="verification-container">
            <p>To authenticate if it's you, kindly enter your account password.</p>
            <input type="hidden" name="employeeID" id="employee-id">
            <input required class="password-input" type="password" name="password" placeholder="Input your Password here">
            <input type="hidden" name="process" id="process">
        </div>
        <div class="button-container">
            <button name="verify" type="submit">
                <ion-icon name="settings"></ion-icon>
                <p>Verify</p>
            </button>
        </div>
    </form>
</div>

<script>
    let body = document.querySelector("body");
    let verifyModal = document.querySelector("#verify-modal");

     function closeVerifyModal() {
        verifyModal.style.display = "none"
        body.style.overflowY = "auto"
    }

    function openVerifyModal(id, name, position, process) {
        let nameField = document.querySelector("#name");
        let positionField = document.querySelector("#position");
        let profileImage = document.querySelector(`#image-${id}`);
        let profileImageField = document.querySelector("#profile-image")
        let processField = document.querySelector("#process")
        let IDField = document.querySelector("#employee-id")

        verifyModal.style.display = "flex"
        body.style.overflowY = "hidden"

        processField.value = process;
        IDField.value = id;
        nameField.innerHTML = name;
        positionField.innerHTML = position;
        profileImageField.src = profileImage.src;
        console.log(processField.value)
    }
</script>