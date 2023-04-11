<form action="../../Pages/Inventory/Item.php?id=<?php echo $item['itemID']?>" method="post" class="item-header">
    <div class="item-information">
        <input type="hidden" name="itemID" value="<?php echo $item['itemID']?>">
        <h2 class="item-name"><?php echo $item['itemName']?></h2>
        <p class="item-id">ID: <?php echo $item['itemID']?></p>
    </div>
    <div class="item-buttons">
        <button class="modal-button white-button" type="submit" name="archive_item">
            <ion-icon name="archive"></ion-icon>
            <p>Archive</p>
        </button>
        <div onclick="openAddStockModal()" class="modal-button" type="submit" name="">
            <ion-icon name="add"></ion-icon>
            <p>Add Stock/Quantity</p>
        </div>
        <div onclick="openBorrowItemModal()" class="modal-button" type="submit" name="add_item">
            <ion-icon name="add"></ion-icon>
            <p>Use/Borrow Item</p>
        </div>
        <div onclick="openEditItemModal()" class="modal-button" type="submit" name="add_item">
            <ion-icon name="pencil"></ion-icon>
            <p>Edit Item Name</p>
        </div>
    </div>
</form>
<div class="divider"></div>