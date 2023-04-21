<form method="post" action="../../Functions/reports-sql-commands.php" class="filter-content">
    <p class="white-text">Filter by:</p>
    <select class="input" name="service" id="">
        <option value="" hidden disabled selected>Filter by Service Category</option>
        <?php 
            $services = getServices();
            foreach($services as $service){
        ?>
            <option value="<?php echo $service['serviceName']?>"><?php echo $service['serviceName']?></option>
        <?php }?>
    </select>
    <p class="white-text">Filter by Processed Date</p>
    <input class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>