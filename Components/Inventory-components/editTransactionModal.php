<div id="edit-transaction-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post"
        action="../../Pages/Inventory/Item.php" class="modal-content-container">
        <div onclick="closeEditTransactionModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Borrowing Record</h3>
        </div>
        <div class="record-container">
            <div class="transaction-info">
                <div class="transaction-field">
                    <p>Borrower</p>
                </div>
                <div class="transaction-value">
                    <p>Henry C. Dela Cruz</p>
                </div>
            </div>
            <div class="transaction-info">
                <div class="transaction-field">
                    <p>Item</p>
                </div>
                <div class="transaction-value">
                    <p>Barangay Boat</p>
                </div>
            </div>
            <div class="transaction-info">
                <div class="transaction-field">
                    <p>Quantity</p>
                </div>
                <div class="transaction-value">
                    <p>1</p>
                </div>
            </div>
            <div class="transaction-info">
                <div class="transaction-field">
                    <p>date</p>
                </div>
                <div class="transaction-value">
                    <p>April, 11, 2023</p>
                </div>
            </div>
        </div>
        <div class="divider-2"></div>
        <div class="button-container">
            <button class="modal-button" type="submit" name="add_stock_submit">
                <ion-icon name="log-in"></ion-icon>
                <p>Return</p>
            </button>
        </div>
    </form>
</div>
<script>

    let editTransactionModal = document.querySelector("#edit-transaction-modal");

    function openEditTransactionModal(){
        editTransactionModal.style.display = "flex";
        body.style.overflow = "hidden"
    }
    function closeEditTransactionModal(){
        editTransactionModal.style.display = "none";
        body.style.overflow = "auto";
    }
</script>