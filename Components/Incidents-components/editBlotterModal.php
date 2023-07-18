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
                    <p class="label">Complaint Title</p>
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
                        <button name="endorse_blotter" id="endorse-button" class="small-button">
                            <ion-icon name="document"></ion-icon>
                            Endorse in the court
                        </button>
                    </div>
                </div>
            </div>
            <div class="hearing-container">

            </div>
            <div class="button-container">
                <button class="white-button" type="submit" name="archive_blotter">
                    <ion-icon name="archive"></ion-icon>
                    <p>Archive</p>
                </button>
                <div onclick="notify()" class="modal-button" id="notify-button" type="submit" name="notify">
                    <ion-icon name="chatbubble"></ion-icon>
                    <p>Notify Residents involved</p>
                </div>
                <button id="solve-blotter-button" type="submit" name="solve_blotter">
                    <ion-icon name="checkmark"></ion-icon>
                    <p>Mark as Solved</p>
                </button>
                <button id="solved-button" class="gray-button" type="submit" name="back_to_pending">
                    <ion-icon name="checkmark"></ion-icon>
                    <p>Marked as Solved</p>
                </button>
                <button id="endorsed-button" class="gray-button" type="submit" name="back_to_pending">
                    <ion-icon name="checkmark"></ion-icon>
                    <p>Endorsed in the court</p>
                </button>
            </div>
        </div>
    </form>
</div>
<script>
let editBlotterModal = document.querySelector("#edit-blotter-modal");
let totalHearing, contacts, latestHearing;

function openEditBlotterModal(ID, complainant, defendant, summary, hearings, complainantContact, defendantContact, latest, status) {
    editBlotterModal.style.display = "flex";
    body.style.overflow = "hidden"

    //pass the information of the selected blotter to the edit modal
    document.querySelector("#blotterID").value = ID
    document.querySelector("#complainant-name").innerHTML = complainant;
    document.querySelector("#defendant-name").innerHTML = defendant;
    document.querySelector("#summary").innerHTML = summary;

    //pass the values value to another variable that is global
    totalHearing = hearings;
    latestHearing = latest;
    contacts = [defendantContact, complainantContact]

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

    //below codes will limit the button displayed on the modal
    let solvedButton = document.querySelector('#solved-button');
    let solveButton = document.querySelector('#solve-blotter-button');
    let endorseButton = document.querySelector('#endorse-button');
    let endorsedButton = document.querySelector('#endorsed-button');
    let notifyButton = document.querySelector('#notify-button');
    let addHearing = document.querySelector('#addHearing');
    if(status === "Solved"){
        hideButtons();
        solvedButton.style.display = 'flex';
        addHearing.style.display = 'none'
    }else if(status === "Endorsed to the court"){
        hideButtons();
        endorsedButton.style.display = 'flex'
        addHearing.style.display = 'none'

    }else if(status === "Pending"){
        hideButtons();
        solveButton.style.display = 'flex'
        endorseButton.style.display = 'flex'
        notifyButton.style.display = 'flex'
    }
    function hideButtons(){
        solveButton.style.display = 'none'
        solvedButton.style.display = 'none'
        endorseButton.style.display = 'none'
        endorsedButton.style.display = 'none'
        notifyButton.style.display = 'none'
        
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
function notify(){
    closEditBlotterModal();
    contacts.map((contact)=>{
        let message = `Dear Concerned Parties, This is to inform you that there has been a conflict recorded in the Barangay Blotter involving the individuals concerned. In order to find a resolution and settle the matter amicably, we invite all parties involved to come to the Barangay Hall for a meeting.The meeting will be held on ${latestHearing} at the Barangay Hall. We urge all parties involved to attend this meeting in order to discuss and resolve the issue in a peaceful and constructive manner. This is an opportunity for all parties to express their concerns and find a mutually agreeable solution.`;

        async function sendMessage(){
        const response = await fetch(`https://sms.teamssprogram.com/api/send?key=e171e8bfec664d8bc70118cb2d5c1085415d24bc&phone=+639${contact}&message=${message}&device=280&sim=2`)
        const data = await response.json();
        console.log(data);
       }
       sendMessage();
    })
}
</script>