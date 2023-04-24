<div id="add-transaction-modal" class="modal-background-blur">
    <form enctype="multipart/form-data"
        action="../../Pages/Services/Resident-Services.php";
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
                    <p>Service:</p>
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
        </div>
        <div class="purpose-container">
            <p>Purposes</p>
            <input id="purpose" type="text" required name="purpose" placeholder="Purpose of issued Service" class="purpose-input">
        </div>
        <div class="gcash-section">
            <div>
                <div class="gcash-info">
                    <div>
                        <img src="../../Images/GCash.png" alt="">
                    </div>
                    <div class="gcash-number">
                        <p>09022028330</p>
                    </div>
                </div>
                <div class="gcash-instruction">
                  <p>Payment via GCash is accepted. Please upload a receipt screenshot for verification.</p>
                </div>
            </div>
            <div>
               <label class="payment-proof-button" for="paymentProof">
                <p>Upload Reciept</p>
                <ion-icon class="checkmark" name="checkmark-done-outline"></ion-icon>
                </label>
               <input class="payment-proof-input" id="paymentProof" name="paymentProof" type="file">
            </div>
        </div>
        <div class="button-container">
            <button class="blue-button" type="submit" name="submit_request">
                <ion-icon name="card"></ion-icon>
                <p>Submit Request</p>
            </button>
        </div>
    </form>
</div>

<script>
let transactionModal = document.getElementById('add-transaction-modal')
transactionModal.style.display = "none";
let body = document.querySelector('body');

//fields
let serviceTypeField = document.getElementById('serviceType')
let residentIDField = document.getElementById('residentID')
let serviceNameField = document.getElementById('serviceName')
let serviceFeeField = document.getElementById('serviceFee')
let issuerField = document.getElementById('issuer')

//Upload Payment button
const paymentInput = document.querySelector('.payment-proof-input');
const paymentButton = document.querySelector('.payment-proof-button');
const checkmark = document.querySelector('.checkmark')

paymentInput.addEventListener('change', () => {
  if (paymentInput.value) {
    checkmark.style.display = "block"
  }else {
    checkmark.style.display = "none"
  }
});

//close the modal
function closeTransactionModal() {
    transactionModal.style.display = "none"
    body.style.overflowY = "auto"
}
//open modal with content attached
function openTransactionModal(serviceName, serviceFee, serviceType) {
    transactionModal.style.display = "flex";
    body.style.overflowY = "hidden";

    serviceTypeField.value = serviceType
    serviceNameField.value = serviceName
    serviceFeeField.value = serviceFee
    issuerField.value = '<?php echo $_SESSION['firstName'] . " " . $_SESSION['middleName'][0], ". ", $_SESSION['lastName'], " ", $_SESSION['extension']?>'
    residentIDField.value = '<?php echo $_SESSION['residentID']?>'

}
</script>