<form method="post" action="../../Functions/reports-sql-commands.php" class="filter-content">
    <p class="white-text">Filter by:</p>
    <select class="input" name="user" id="">
        <option value="" hidden disabled selected>Filter by User</option>
        <?php 
            $users = getUsersWithLogs();
            foreach($users as $user){
        ?>
            <option value="<?php echo $user['userName']?>"><?php echo $user['fullName']?></option>
        <?php }?>
    </select>
    <p class="white-text">Filter by Activity Date</p>
    <input class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>