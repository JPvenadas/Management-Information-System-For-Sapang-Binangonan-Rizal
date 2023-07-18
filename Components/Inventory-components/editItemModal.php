<div id="edit-item-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post" action="../../Pages/Inventory/Item.php?id=<?php echo $_GET['id']?>"
        class="modal-content-container">
        <div onclick="closeEditItemModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <input type="hidden" name="itemID" value="<?php echo $item['itemID']?>">
            <h3>Edit Item name</h3>
            <p>Please input the name below</p>
        </div>
        <div class="inputs-section">
            <div class="input-container">
                <input type="hidden" name="itemID" value="<?php echo $_GET['id']?>">
                <input name="itemName" value="<?php echo $item['itemName']?>" class="input" placeholder="Enter the name here" type="text">
            </div>
        </div>
        <div class="button-container">
            <button class="modal-button" type="submit" name="edit_item_name">
                <ion-icon name="add"></ion-icon>
                <p>Save</p>
            </button>
        </div>
    </form>
</div>
<script>
    let editItemModal = document.querySelector("#edit-item-modal");

    function openEditItemModal(){
        editItemModal.style.display = "flex";
        body.style.overflow = "hidden"
    }
    function closeEditItemModal(){
        editItemModal.style.display = "none";
        body.style.overflow = "auto";
    }
</script>