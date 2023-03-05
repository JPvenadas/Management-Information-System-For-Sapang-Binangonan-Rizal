<div id="add-transaction-modal" class="modal-background-blur">
    <form
        action="../../Modules/Transactions/transactions.php"
        method="post" class="modal-content-container">
        <div onclick="closeTransactionModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <p>Transaction Record</p>
            <input type="hidden" name="serviceType" id="serviceType">
        </div>
        <div class="record-container">
            <div class="record">
                <div class="field">
                    <p>Document:</p>
                </div>
                <div class="value">
                    <input type="text" id="serviceName" name="serviceName">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Amount:</p>
                </div>
                <div class="value">
                <input type="text" id="serviceFee" name="serviceFee">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>for:</p>
                </div>
                <div class="value">
                    <input type="hidden" name="residentID" id="residentID">
                    <input type="text" id="issuer" name="fullName">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>issued at:</p>
                </div>
                <div class="value">
                    <input type="text" id="dateRequested" name="dateRequested" value="<?php echo date('F d, Y')?>">   
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Printed by:</p>
                </div>
                <div class="value">
                    <input type="text" id="user" name="assistedBy" value="<?php echo $_SESSION['firstName'] . ' ' . $_SESSION['middleName'][0] . '.' . ' ' . $_SESSION['lastName']?>"> 
                </div>
            </div>
        </div>
        <div class="purpose-container">
            <p>Document purposes</p>
            <input id="purpose" type="text" required name="purpose" placeholder="Purpose of issued document" class="purpose-input">
        </div>
        <div class="button-container">
            <button class="blue-button" type="submit" name="add_transaction">
                <ion-icon name="card"></ion-icon>
                <p>Confirm Payment</p>
            </button>
        </div>
    </form>
</div>

<script>
let transactionModal = document.getElementById('add-transaction-modal')
transactionModal.style.display = "none";

//fields
let serviceType = document.getElementById('serviceType')
let residentIDField = document.getElementById('residentID')
let serviceName = document.getElementById('serviceName')
let serviceFee = document.getElementById('serviceFee')
let issuerField = document.getElementById('issuer')

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

    serviceType.value = selectedServiceType
    serviceName.value = selectedService
    serviceFee.value = selectedServiceFee
    issuerField.value = issuer
    residentIDField.value = residentID

}
</script>