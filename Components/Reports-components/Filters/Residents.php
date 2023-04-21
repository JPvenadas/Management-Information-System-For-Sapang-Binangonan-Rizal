<form method="post" action="../../Functions/reports-sql-commands.php" class="filter-content">
    <p class="white-text">Filter by:</p>
    <select class="input" name="sex" id="">
        <option value="" hidden disabled selected>Filter by Sex</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Non-binary">Non-binary</option>
    </select>
    <select class="input" name="purok" id="">
        <option value="" hidden disabled selected>Filter by Purok</option>
        <?php 
            $puroks = getPuroks();
            foreach($puroks as $purok){
        ?>
            <option value="<?php echo $purok['purok']?>"><?php echo $purok['purok']?></option>
        <?php }?>
    </select>
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>