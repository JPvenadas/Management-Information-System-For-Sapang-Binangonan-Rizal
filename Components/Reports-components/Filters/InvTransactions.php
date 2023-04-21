<form method="post" action="../../Functions/reports-sql-commands.php" class="filter-content">
    <p class="white-text">Filter by:</p>
    <select class="input" name="item" id="">
        <option value="" hidden disabled selected>Filter by Item Borrowed</option>
        <?php 
            $items = getItemList();
            foreach($items as $item){
        ?>
            <option value="<?php echo $item['itemID']?>"><?php echo $item['itemName']?></option>
        <?php }?>
    </select>
    <p class="white-text">Filter by Date</p>
    <input class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>