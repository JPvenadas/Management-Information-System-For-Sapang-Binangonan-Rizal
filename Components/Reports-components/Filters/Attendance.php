<form method="post" action="../../Functions/reports-sql-commands.php" class="filter-content">
    <p class="white-text">Filter by:</p>
    <select class="input" name="employee" id="">
        <option value="" hidden disabled selected>Filter by Employee</option>
        <?php 
            $employees = getEmployeesWithAttendance();
            foreach($employees as $employee){
        ?>
            <option value="<?php echo $employee['employeeID']?>"><?php echo $employee['fullName']?></option>
        <?php }?>
    </select>
    <p class="white-text">Filter by Attendance Date</p>
    <input class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>