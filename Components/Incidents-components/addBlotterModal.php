<div id="add-blotter-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post" action="../../Pages/Incidents/Incidents.php" class="modal-content-container">
        <div onclick="closeAddBlotterModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Add a new Blotter</h3>
            <p>Fill the necessary information below</p>
        </div>
        <div class="blotter-inputs">
             <div class="blotter-input">
                <p class="label">Complaint Title</p>
                <textarea placeholder="Type here the title of the case" name="summary" id="" class="long-input"></textarea>
            </div>
            <div class="blotter-input">
                <p class="label">Complainant</p>
                <div class="input-container">
                    <input required placeholder="Select the Complainant" id="complainant-fullName" class="input" readonly type="text">
                    <input required id="complainant-ID" name="complainant" type="hidden">
                    <div onclick="openResidentModal('complainant')" class="select input-button">
                        <p>Select</p>
                    </div>
                    <div onclick="openResidentModal('complainant')" class="select-icon input-button">
                        <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="blotter-input">
                <p class="label">Defendant</p>
                <div class="input-container">
                    <input required placeholder="Select the Defendant" id="defendant-fullName" class="input" class="defendant-fullName" readonly type="text">
                    <input required id="defendant-ID" name="defendant" type="hidden">
                    <div onclick="openResidentModal('defendant')" class="select input-button">
                        <p>Select</p>
                    </div>
                    <div onclick="openResidentModal('defendant')" class="select-icon input-button">
                        <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="blotter-input">
                <p class="label">Baranggay Mediator</p>
                <div class="input-container">
                    <input required placeholder="Select the Mediator" id="mediator-fullName" class="input" readonly type="text">
                    <input required id="mediator-ID" name="mediator" type="hidden">
                    <div onclick="openResidentModal('mediator')" class="select input-button">
                        <p>Select</p>
                    </div>
                    <div onclick="openResidentModal('mediator')" class="select-icon input-button">
                        <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="blotter-input">
                <p class="label">Narrative Report (file/image/record)</p>
                <div class="input-container">
                    <input required placeholder="Upload a Narrative Report" id="narrative-report-text" class="input" readonly type="text">
                    <input accept="image/*" required id="narrative-report" name="narrativeReport" hidden type="file">
                    <label class="upload input-button" for="narrative-report">
                        <p>Upload</p>
                    </label>
                    <label class="upload-icon input-button" for="narrative-report">
                        <ion-icon name="caret-up"></ion-icon>
                    </label>
                </div>
            </div>
           
            <div class="blotter-input">
                <p class="label">Hearing Schedule</p>
                <input onfocus="(this.type = 'date')" min="<?php echo date('Y-m-d');?>" class="input" placeholder="Enter the Date of the hearing here" type="text" name="schedule" required>
            </div>
        </div>
        <div class="button-container">
            <button id="Add-blotter-button" type="submit" name="add_blotter">
                <ion-icon name="add"></ion-icon>
                <p>Add</p>
            </button>
        </div>
    </form>
</div>

<script>
let addBlotterModal = document.querySelector("#add-blotter-modal");

//function to open the modal
function openAddBlotterModal() {
    addBlotterModal.style.display = "flex";
    body.style.overflow = "hidden"
}

//function to close the modal
function closeAddBlotterModal() {
    addBlotterModal.style.display = "none";
    body.style.overflow = "auto"
}

//function that will show the name of the file/image uploaded
let narrativeReport = document.querySelector("#narrative-report");
narrativeReport.addEventListener('change', (event) => {
            let narrativeReportText = document.querySelector("#narrative-report-text")
            var image = event.target.files[0]
            narrativeReportText.value = image.name
})
</script>