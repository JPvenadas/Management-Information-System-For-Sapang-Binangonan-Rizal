<?php
date_default_timezone_set('Asia/Manila');
?>
<div id="time-modal" class="modal-background-blur">
    <form method="post" action="../../Pages/Incidents/Incidents.php?filter=<?php if(isset($_GET['filter'])){echo $_GET['filter'];}?>" class="modal-content-container">
        <div onclick="closeTimeModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="profile-container">
            <div class="profile-image">
                <img id="profile-image" src="" alt="">
            </div>
            <div class="profile-information">
                <h4 id="name"></h4>
                <p id="age"></p>
            </div>
        </div>
        <div class="verification-container">
            <p>To facilitate the recording of your report, we kindly request that you provide the exact date and time when the alleged violation occurred. Please enter this information in the corresponding date and time fields</p>
            <div style="display: flex">
                 <input type="hidden" name="residentID" id="residentID" value="">
                 <input type="date" class="date-input" id="date" name="date" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
                 <input type="time" class="date-input" name="time" value="<?php echo date('H:i'); ?>"  min="00:00" />
            </div>
        </div>
        <div class="button-container">
            <button name="recordViolation" type="submit">
                <ion-icon name="clipboard-outline"></ion-icon>
                <p>Record</p>
            </button>
        </div>
    </form>
</div>

<script>
    let timeModal = document.querySelector("#time-modal");

     function closeTimeModal() {
        timeModal.style.display = "none"
        body.style.overflowY = "auto"
    }

    function openTimeModal(id, name, age) {
        let residentID = document.querySelector("#residentID")
        let nameField = document.querySelector('#name');
        let image = document.querySelector('#profile-image')
        let ageField = document.querySelector('#age');

        nameField.innerHTML = name;
        image.src = document.querySelector(`#image-${id}`).src
        ageField.innerHTML = age
        residentID.value = id
        
        timeModal.style.display = "flex"
        body.style.overflowY = "hidden"
        closeResidentModal()
    }
</script>