<div id="change-amount" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeAmountModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <form action="../../Pages/Settings/Settings.php?page=services" method="post" class="container">
            <p>Service Fee</p>
            <p class="service-title">Barangay Clearance</p>
            <div class="flex">
                <input id="serviceID" type="hidden" name="serviceID">
                <input id="serviceFee" name="serviceFee" type="number" required placeholder="Service Fee" class="input">
                <div>
                    <button class="save" name="change_amount">Save</button>
                    <button class="save" name="archive_service">Archive</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
let amountModal = document.getElementById('change-amount')
amountModal.style.display = 'none'
let body = document.querySelector('body')

function closeAmountModal() {
    amountModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openAmountModal(serviceName, serviceFee) {

    let ID = document.querySelector("#serviceID");
    let feeDisplay = document.querySelector("#serviceFee");
    let titleDisplay = document.querySelector(".service-title");
    console.log(feeDisplay);

    ID.value = serviceName;
    feeDisplay.value = serviceFee;
    titleDisplay.innerHTML = serviceName;

    amountModal.style.display = "flex"
    body.style.overflowY = "hidden"

}
</script>