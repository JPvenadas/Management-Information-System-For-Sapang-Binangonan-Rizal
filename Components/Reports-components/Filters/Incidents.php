<form method="post" action="../../Functions/reports-sql-commands.php" class="filter-content">
    <p class="white-text">Filter by:</p>
    <select class="input" name="item" id="">
        <option value="" hidden disabled selected>Filter by Case status</option>
        <option value="Pending">Pending</option>
        <option value="Solved">Solved</option>
        <option value="Endorsed to the court">Endorsed to the court</option>
    </select>
    <p class="white-text">Filter by Hearing Date</p>
    <input class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>