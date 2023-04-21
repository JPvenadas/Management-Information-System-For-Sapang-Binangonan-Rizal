<form method="post" action="../../Functions/reports-sql-commands.php" class="filter-content">
    <p class="white-text">Filter by:</p>
    <select class="input" name="position" id="">
        <option value="" hidden disabled selected>Filter by Employee Position</option>
        <?php 
            $positions = getpositions();
            foreach($positions as $position){
        ?>
            <option value="<?php echo $position['position']?>"><?php echo $position['position']?></option>
        <?php }?>
    </select>
    <select class="input" name="sex" id="">
        <option value="" hidden disabled selected>Filter by Term Status</option>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
    </select>
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>