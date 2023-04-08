<div id="edit-blotter-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post" action="../../Pages/Incidents/Incidents.php"
        class="modal-content-container">
        <div onclick="closEditBlotterModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <input type="hidden" name="blotterID" id="blotterID">
        <div class="modal-title">
            <h3>Blotter Record</h3>
            <p>A complaint from <span id="complainant-name" class="highlight-text">Jessa Dela paz</span> about <span
                    id="defendant-name" class="highlight-text">Roderick Pasco</span></p>
        </div>
        <div class="blotter-inputs">
            <div class="blotter-input">
                <div class="space-between">
                    <p class="label">Complaint Summary</p>
                    <div onclick="showNarrativeReport()" class="small-button">
                        <ion-icon name="eye-outline"></ion-icon>
                        View Narrative Report
                    </div>
                </div>
                <textarea readonly placeholder="Type here the summary of the case" name="summary" id="summary"
                    class="long-input"></textarea>
            </div>
            <div class="blotter-inputs">
                <div class="space-between">
                    <div>
                        <p class="label">Hearing Schedules</p>
                    </div>
                    <div style="display: flex;">
                        <div id="addHearing" onclick="showNextHearingModal()" class="small-button">
                            <ion-icon name="add"></ion-icon>
                            Add next hearing
                        </div>
                        <button name="endorse_blotter" class="small-button">
                            <ion-icon name="document"></ion-icon>
                            Endorse in the court
                        </button>
                    </div>
                </div>
            </div>
            <div class="hearing-container">

            </div>
            <div class="button-container">
                <button class="white-button" id="Add-blotter-button" type="submit" name="archive_blotter">
                    <ion-icon name="archive"></ion-icon>
                    <p>Archive</p>
                </button>
                <button id="Add-blotter-button" type="submit" name="endorse_blotter">
                    <ion-icon name="chatbubble"></ion-icon>
                    <p>Notify Residents involved</p>
                </button>
                <button id="Add-blotter-button" type="submit" name="solve_blotter">
                    <ion-icon name="checkmark"></ion-icon>
                    <p>Mark as Solved</p>
                </button>
            </div>
        </div>
    </form>
</div>
<script>
let editBlotterModal = document.querySelector("#edit-blotter-modal");
let totalHearing;

function openEditBlotterModal(ID, complainant, defendant, summary, hearings) {
    editBlotterModal.style.display = "flex";
    body.style.overflow = "hidden"

    //pass the information of the selected blotter to the edit modal
    document.querySelector("#blotterID").value = ID
    document.querySelector("#complainant-name").innerHTML = complainant;
    document.querySelector("#defendant-name").innerHTML = defendant;
    document.querySelector("#summary").innerHTML = summary;

    //pass the hearings value to another variable that is global
    totalHearing = hearings;

    //append the hearings of the selected blotter to the edit blotter modal
    document.querySelector(`.hearing-container`).innerHTML = "";
    document.querySelector(".hearing-container").innerHTML = document.querySelector(`#hearing-${ID}`).innerHTML

    //dont show the add hearing button if there is already three hearings or if there is still pending hearing
    const addHearingButton = document.getElementById(`add-hearing-${ID}`);

    if (hearings == 3 || addHearingButton !== null) {
        document.querySelector(`#addHearing`).style.display = "none";
    } else {
        document.querySelector(`#addHearing`).style.display = "flex";
    }

}

function closEditBlotterModal() {
    editBlotterModal.style.display = "none";
    body.style.overflow = "auto"
}

function showNarrativeReport() {
    openImageModal(document.querySelector("#blotterID").value);
}

function showNextHearingModal() {
    openNextHearingModal(document.querySelector("#blotterID").value, totalHearing)
}
</script>