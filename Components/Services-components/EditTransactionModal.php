<div id="edit-transaction-modal" class="modal-background-blur">
    <form
        action="../../Pages/Services/Services.php";
        method="post" class="modal-content-container">
        <div onclick="closeEditTransactionModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <p>Transaction Record</p>
            <input type="hidden" id="transactionID-edit" name="transactionID">
            <input type="hidden" id="serviceType-edit" name="serviceType">
        </div>
        <div class="record-container">
            <div class="record">
                <div class="field">
                    <p>Document:</p>
                </div>
                <div class="value">
                    <input readonly type="text" id="serviceName-edit" name="serviceName">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Amount:</p>
                </div>
                <div class="value">
                <input readonly type="text" id="serviceFee-edit" name="serviceFee">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>for:</p>
                </div>
                <div class="value">
                    <input type="hidden" id="residentID-edit" name="residentID">
                    <input readonly type="text" id="issuer-edit" name="fullName">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>issued at:</p>
                </div>
                <div class="value">
                    <input readonly type="text" id="dateRequested-edit" name="dateRequested" value="<?php echo date('F d, Y')?>">   
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Printed by:</p>
                </div>
                <div class="value">
                    <input readonly type="text" id="user" name="assistedBy-edit" value="<?php echo $_SESSION['firstName'] . ' ' . $_SESSION['middleName'][0] . '.' . ' ' . $_SESSION['lastName']?>"> 
                </div>
            </div>
        </div>
        <div class="purpose-container">
            <p>Document purposes</p>
            <input id="purpose-edit" type="text" required name="purpose" placeholder="Purpose of issued document" class="purpose-input">
        </div>
        <div class="button-container">
            <button id="confirm-button" class="blue-button" type="submit" name="process_transaction">
                <ion-icon name="card"></ion-icon>
                <p>Confirm Payment</p>
            </button>
            <button id="claim-button" class="blue-button" type="submit" name="claim_transaction">
                <ion-icon name="card"></ion-icon>
                <p>Claim</p>
            </button>
            <button id="archive-button" type="submit" name="archive_transaction">
                <ion-icon name="card"></ion-icon>
                <p>Archive</p>
            </button>
        </div>
       
    </form>
</div>

<script>
let editTransactionModal = document.getElementById('edit-transaction-modal')
editTransactionModal.style.display = "none";

//fields
let serviceTypeEdit = document.getElementById('serviceType-edit')
let residentIDEdit = document.getElementById('residentID-edit')
let serviceNameEdit = document.getElementById('serviceName-edit')
let serviceFeeEdit = document.getElementById('serviceFee-edit')
let issuerEdit = document.getElementById('issuer-edit')
let purposeEdit = document.getElementById('purpose-edit')
let transactionStatus
let transactionIDEdit = document.getElementById('transactionID-edit')

//buttons
let confirmButton = document.getElementById('confirm-button')
let claimButton = document.getElementById('claim-button')
let archiveButton = document.getElementById('archive-button')
//close the modal
function closeEditTransactionModal() {
    editTransactionModal.style.display = "none"
    body.style.overflowY = "auto"
}
//open modal with content attached
function openEditTransactionModal(transactionID,transactionStatus,service, Fee, Type, residentID, issuer, purpose) {
    closeResidentModal()
    editTransactionModal.style.display = "flex";
    body.style.overflowY = "hidden";
    
    transactionIDEdit.value = transactionID
    transactionStatusEdit = transactionStatus
    serviceTypeEdit.value = Type
    serviceNameEdit.value = service
    serviceFeeEdit.value = Fee
    issuerEdit.value = issuer
    residentIDEdit.value = residentID
    purposeEdit.value = purpose

    if(transactionStatusEdit == "Unprocessed"){
        confirmButton.style.display = "flex";
        claimButton.style.display = "none";
        archiveButton.style.display = "none";
    }else if(transactionStatusEdit == "Processed"){
        confirmButton.style.display = "none";
        claimButton.style.display = "flex";
        archiveButton.style.display = "none";
    }else{
        confirmButton.style.display = "none";
        claimButton.style.display = "none";
        archiveButton.style.display = "flex";
    }
}
</script>