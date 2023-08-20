<div id="add-transaction-modal" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeTransactionModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <p>Transaction Record</p>
        </div>
        <div class="record-container">
            <div class="record">
                <div class="field">
                    <p>Service:</p>
                </div>
                <div class="value">
                    <p id="serviceName_display"></p>
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Amount:</p>
                </div>
                <div class="value">
                    <p id="serviceFee_display"></p>
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>for:</p>
                </div>
                <div class="value">
                    <p id="issuer_display"></p>
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>issued at:</p>
                </div>
                <div class="value">
                    <p id="dateRequested"><?php echo date('F d, Y')?></p>
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Assisted by:</p>
                </div>
                <div class="value">
                    <p id="user"><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['middleName'][0] . '.' . ' ' . $_SESSION['lastName']?></p>
                </div>
            </div>
        </div>
        <div class="purpose-container">
            <p>Purposes</p>
            <input id="purpose" type="text" required name="purpose" placeholder="Purpose of issued document"
                class="purpose-input">
        </div>
        <div class="button-container">
            <button id="proceed-button" class="blue-button" type="submit">
                <ion-icon name="card"></ion-icon>
                <p>Proceed</p>
            </button>
        </div>
    </div>
</div>

<script>
let transactionModal = document.getElementById('add-transaction-modal')
transactionModal.style.display = "none";

//fields
let serviceName_display = document.getElementById('serviceName_display')
let serviceFee_display = document.getElementById('serviceFee_display')
let issuer_displayField = document.getElementById('issuer_display')
let purposeInput = document.getElementById('purpose')

//close the modal
function closeTransactionModal() {
    transactionModal.style.display = "none"
    body.style.overflowY = "auto"
}
//open modal with content attached
function openTransactionModal(residentID, issuer) {
    closeResidentModal()
    transactionModal.style.display = "flex";
    body.style.overflowY = "hidden";

    //set for display
    serviceName_display.innerHTML = selectedService
    serviceFee_display.innerHTML = selectedServiceFee
    issuer_displayField.innerHTML = issuer

    //set for reference
    selectedResidentID = residentID
    selectedResidentName = issuer

}

let proceedButton = document.querySelector('#proceed-button');
proceedButton.addEventListener("click",()=>{
    purpose = purposeInput.value

    closeTransactionModal();
    openPaymentModal();
})
</script>