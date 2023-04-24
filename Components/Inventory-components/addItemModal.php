<div id="add-item-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post" action="../../Pages/Inventory/Inventory.php" class="modal-content-container">
        <div onclick="closeAddItemModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Add Item in the Barangay's Inventory</h3>
            <p>Fill the necessary information below</p>
        </div>
        <div class="inputs-section">
            <div class="input-container">
                <label class="label" for="">Item Name</label>
                <input name="item_name" class="input" placeholder="Item Name" type="text">
            </div>
            <div class="input-container">
                <label class="label" for="">Initial Quantity</label>
                <input name="item_quantity" class="input"  placeholder="Item initial quantity" type="number">
            </div>
        </div>
        <div class="button-container">
            <button class="modal-button" type="submit" name="add_item">
                <ion-icon name="add"></ion-icon>
                <p>Add</p>
            </button>
        </div>
    </form>
</div>
<script>
    let addItemModal = document.querySelector("#add-item-modal");
    let body = document.querySelector("body");

    function openAddItemModal(){
        addItemModal.style.display = 'flex';
        body.style.overflow = 'hidden'
    }
    function closeAddItemModal(){
        addItemModal.style.display = 'none';
        body.style.overflow = 'auto'
    }
</script>