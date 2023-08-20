<div id="payment-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" action="../../Pages/Services/Resident-Services.php" method="post"
        class="modal-content-container">
        <div onclick="closePaymentModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <p>Confirm Payment</p>
            <input type="hidden" name="serviceName" id="serviceName">
            <input type="hidden" name="serviceType" id="serviceType">
            <input type="hidden" name="residentID" id="residentID">
            <input type="hidden" name="purpose" id="purposeValue">
            <input type="hidden" name="serviceFee" id="serviceFee">
        </div>
        <div class="inputs">
            <div class="input-container">
                <label for="amount-input">Amount</label>
                <input type="number" onchange="formatCurrency(this)" disabled id="amount-input" type="number"
                    class="input" style="cursor: not-allowed">
            </div>
            <div class="input-container">
                <label for="mode-input">Mode of payment</label>
                <select class="input" id="mode-input" name="paymentMode" onchange="toggleCustomInput()">
                    <option value="" disabled selected>Select a Mode of Payment</option>
                    <option value="cash">Cash</option>
                    <option value="gcash">GCash</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div id="customOption" class="input-container" style="display: none;">
                <label for="customPayment">Payment Option:</label>
                <input class="input" type="text" id="customPayment" name="customPaymentMode">
            </div>
            <div id="GcashOption" class="input-container" style="display: none;">
                <label for="GcashPayment">Reference Number:</label>
                <input class="input" type="number" id="GcashPayment" name="refNo">
            </div>
            <div class="input-container-flex-2">
                <div class="left">
                    <label for="payment-input">Payment</label>
                    <input name="payment" oninput="calculateChange()" class="input" type="number"
                        onchange="formatCurrency(this)" id="payment-input">
                </div>
                <div class="right">
                    <label for="change-input">Change</label>
                    <input min="0" class="input" name="change" type="number" onchange="formatCurrency(this)" value=0.00
                        readonly id="change-input" style="cursor: not-allowed	">
                </div>
            </div>
        </div>
        <div class="button-container">
            <button class="blue-button" type="submit" id="submitBtn" name="add_transaction">
                <ion-icon name="card"></ion-icon>
                <p>Process</p>
            </button>
        </div>
    </form>
</div>

<script>
let paymentModal = document.getElementById('payment-modal')
var amountTextbox = document.getElementById("amount-input");
var paymentTextbox = document.getElementById("payment-input");
var changeTextbox = document.getElementById("change-input");
var submitButton = document.getElementById("submitBtn");

function closePaymentModal() {
    paymentModal.style.display = "none";
    body.style.overflowY = "auto"
}
//open modal with content attached
function openPaymentModal() {
    paymentModal.style.display = "flex";
    body.style.overflowY = "hidden";

    //get the needed input where you will set the values
    const serviceNameInput = document.getElementById("serviceName");
    const serviceTypeInput = document.getElementById("serviceType");
    const residentIDInput = document.getElementById("residentID");
    const purposeInput = document.getElementById("purposeValue");
    const serviceFeeInput = document.getElementById("serviceFee");

    //set the values
    amountTextbox.value = selectedServiceFee
    serviceFeeInput.value = selectedServiceFee
    serviceNameInput.value = selectedService
    serviceTypeInput.value = selectedServiceType
    residentIDInput.value = selectedResidentID
    purposeInput.value = purpose
}

function formatCurrency(input) {
    let value = parseFloat(input.value);

    if (!isNaN(value)) {
        input.value = value.toFixed(2);
    }
}

function toggleCustomInput() {
    var paymentSelect = document.querySelector("#mode-input");
    var customInput = document.querySelector("#customOption");
    var gcashInput = document.querySelector("#GcashOption")
    if (paymentSelect.value === "others") {
        customInput.style.display = "block";
        gcashInput.style.display = "none";
    } else if (paymentSelect.value === "gcash") {
        gcashInput.style.display = "block";
        customInput.style.display = "none";
    } else {
        customInput.style.display = "none";
        gcashInput.style.display = "none";
    }
}

function calculateChange() {

    var amount = parseFloat(amountTextbox.value);
    var payment = parseFloat(paymentTextbox.value);

    if (!isNaN(amount) && !isNaN(payment)) {
        var change = payment - amount;
        if (change >= 0) {
            changeTextbox.value = change.toFixed(2);
            submitButton.disabled = false; // Enable the submit button
        } else {
            changeTextbox.value = "0.00";
            submitButton.disabled = true; // Disable the submit button
        }
    } else {
        changeTextbox.value = "";
        submitButton.disabled = true;
    }
}
</script>