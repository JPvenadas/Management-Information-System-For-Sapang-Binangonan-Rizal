<form method="post" action="../../Functions/reports-sql-commands.php" class="filter-content">
    <p class="white-text">Filter by:</p>
    <select class="input" name="user_type" id="">
        <option value="" hidden disabled selected>Filter by User type</option>
        <option value="Administrator">Administrator</option>
        <option value="Staff">Staff</option>
        <option value="Resident">Resident</option>
    </select>
    <select class="input" name="account_status" id="">
        <option value="" hidden disabled selected>Filter by Account Status</option>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
    </select>
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>