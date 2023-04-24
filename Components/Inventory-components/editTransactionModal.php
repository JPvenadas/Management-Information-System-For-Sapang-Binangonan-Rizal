<div id="edit-transaction-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post"
        action="../../Pages/Inventory/Inventory.php?filter=returned" class="modal-content-container">
        <div onclick="closeEditTransactionModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Borrowing Record</h3>
        </div>
        <input type="hidden" name="transactionID" id="transaction-id">
        <input type="hidden" name="quantity" id="quantity-value">
        <input type="hidden" name="itemID" id="item-id-value">
        <div class="record-container">
            <div class="transaction-info">
                <div class="transaction-field">
                    <p>Borrower</p>
                </div>
                <div class="transaction-value">
                    <p id="borrower"></p>
                </div>
            </div>
            <div class="transaction-info">
                <div class="transaction-field">
                    <p>Item</p>
                </div>
                <div class="transaction-value">
                    <p id="item"></p>
                </div>
            </div>
            <div class="transaction-info">
                <div class="transaction-field">
                    <p>Quantity</p>
                </div>
                <div class="transaction-value">
                    <p id="quantity-text"></p>
                </div>
            </div>
            <div class="transaction-info">
                <div class="transaction-field">
                    <p>date</p>
                </div>
                <div class="transaction-value">
                    <p id="date"></p>
                </div>
            </div>
        </div>
        <div class="divider-2"></div>
        <div class="button-container">
            <button class="modal-button white-button" type="submit" name="archive_transaction">
                <ion-icon name="log-in"></ion-icon>
                <p>Archive</p>
            </button>
            <button id="return-button" class="modal-button" type="submit" name="return_item">
                <ion-icon name="log-in"></ion-icon>
                <p>Return</p>
            </button>
        </div>
    </form>
</div>
<script>

    let editTransactionModal = document.querySelector("#edit-transaction-modal");

    //element that will contain the values
    let borrowerField = document.querySelector("#borrower")
    let transactionID = document.querySelector("#transaction-id")
    let itemField = document.querySelector("#item")
    let quantityField = document.querySelector("#quantity-text")
    let dateField = document.querySelector("#date");


    function openEditTransactionModal(id,borrower,itemID, item, quantity, date, status){
        transactionID.value = id
        borrowerField.innerHTML = borrower
        itemField.innerHTML = item
        quantityField.innerHTML = quantity
        console.log(quantity)
        console.log(quantityField)
        document.querySelector("#quantity-value").value = quantity
        document.querySelector("#item-id-value").value = itemID
        dateField.innerHTML = new Date(date).toLocaleDateString("en-US", { month: 'long', day: 'numeric', year: 'numeric' });

        editTransactionModal.style.display = "flex";
        body.style.overflow = "hidden"

    if(status == "Borrowed"){
        document.querySelector("#return-button").style.display = "flex"
    }
    else{
        document.querySelector("#return-button").style.display = "none"
    }
    }
    function closeEditTransactionModal(){
        editTransactionModal.style.display = "none";
        body.style.overflow = "auto";
    }
</script>