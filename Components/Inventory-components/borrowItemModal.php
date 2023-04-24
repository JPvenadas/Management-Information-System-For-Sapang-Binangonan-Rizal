<div id="borrow-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post"
        action="../../Pages/Inventory/Item.php?id=<?php echo $_GET['id']?>" class="modal-content-container">
        <div onclick="closeBorrowItemModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Borrow/Use an item</h3>
            <p>Please input the details of the transaction</p>
        </div>
        <div class="inputs-section">
            <div class="input-container">
                <label class="label" for="">Borrower/User of the Item</label>
                <div class="input-container-2">
                    <input required placeholder="Select the Borrower" id="borrower-name" class="input" readonly
                        type="text">
                    <input required id="borrower-id" name="residentID" type="hidden">
                    <input type="hidden" name="itemID" value="<?php echo $_GET['id']?>">
                    <div onclick="openResidentModal()" class="input-button">
                        <p>Select</p>
                    </div>
                </div>
            </div>
            <div class="inputs-section">
                <label class="label" for="quantity">Quantity</label>
                <div class="input-container">
                    <input name="quantity" id="quantity" class="input" placeholder="Quantity to be used" type="number">
                </div>
            </div>
            <div class="button-container">
                <button class="modal-button" type="submit" name="borrow_item">
                    <ion-icon name="log-out"></ion-icon>
                    <p>Borrow Item</p>
                </button>
            </div>
        </div>
    </form>
</div>
<script>
let borrowModal = document.querySelector("#borrow-modal");

function openBorrowItemModal() {
    borrowModal.style.display = "flex";
    body.style.overflow = "hidden"
}

function closeBorrowItemModal() {
    borrowModal.style.display = "none";
    body.style.overflow = "auto";
}
</script>