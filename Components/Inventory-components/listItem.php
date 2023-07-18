<?php
function generateItem($item){
?>
<a href="../../Pages/Inventory/Item.php?id=<?php echo $item['itemID']?>" type="submit" class="record">
    <div class="left">
        <div class="record-info">
            <h3><?php echo $item['itemName']?></p>
            <p>Quantity Available: <?php echo $item['totalNumber']?></p>
        </div>
    </div>
    <div class="action">
        <p>Click to view details</p>
    </div>
</a>

<?php }?>