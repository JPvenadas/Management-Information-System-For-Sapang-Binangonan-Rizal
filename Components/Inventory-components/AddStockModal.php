<div id="add-stock-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post" action="../../Pages/Inventory/Item.php?id=<?php echo $_GET['id']?>" class="modal-content-container">
        <div onclick="closeAddStockModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <input type="hidden" name="itemID" value="<?php echo $item['itemID']?>">
            <h3>Add Quantity/Stock</h3>
            <p>Please input the Borrower and the Quantity of item to be borrowed</p>
        </div>
        <div class="inputs-section">
            <div class="input-container">
                <input required min="1" name="quantity" class="input" placeholder="Quantity to be added" type="number">
            </div>
        </div>
        <div class="button-container">
            <button class="modal-button" type="submit" name="add_stock_submit">
                <ion-icon name="add"></ion-icon>
                <p>Add</p>
            </button>
        </div>
    </form>
</div>
<script>
    let stockModal = document.querySelector("#add-stock-modal");
    let body = document.querySelector("body");

    function openAddStockModal(){
        stockModal.style.display = "flex";
        body.style.overflow = "hidden"
    }
    function closeAddStockModal(){
        stockModal.style.display = "none";
        body.style.overflow = "auto";
        closeBorrowItemModal()
    }
</script>