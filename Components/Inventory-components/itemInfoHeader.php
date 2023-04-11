<form action="../../Pages/Inventory/Item.php?id=<?php echo $item['itemID']?>" method="post" class="item-header">
    <div class="item-information">
        <h2 class="item-name"><?php echo $item['itemName']?></h2>
        <p class="item-id">ID: <?php echo $item['itemID']?></p>
    </div>
    <div class="item-buttons">
        <button class="modal-button white-button" type="submit" name="add_item">
            <ion-icon name="archive"></ion-icon>
            <p>Archive</p>
        </button>
        <button class="modal-button" type="submit" name="add_item">
            <ion-icon name="add"></ion-icon>
            <p>Add Stock/Quantity</p>
        </button>
        <button class="modal-button" type="submit" name="add_item">
            <ion-icon name="add"></ion-icon>
            <p>Use/Borrow Item</p>
        </button>
    </div>
</form>
<div class="divider"></div>