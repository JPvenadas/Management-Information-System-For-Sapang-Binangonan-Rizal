<form method="get" class="filter-content">
    <p class="white-text">Filter by:</p>
    <input type="hidden" name="content" value="Incidents">
    <select class="input" name="item" id="">
        <option value="" hidden disabled selected>Filter by Case status</option>
        <option <?php if(isset($_GET['caseStatus']) and $_GET['caseStatus'] === 'Pending') { echo 'selected'; } ?> value="Pending">Pending</option>
        <option <?php if(isset($_GET['caseStatus']) and $_GET['caseStatus'] === 'Solved') { echo 'selected'; } ?> value="Solved">Solved</option>
        <option <?php if(isset($_GET['caseStatus']) and $_GET['caseStatus'] === 'Endorsed to the court') { echo 'selected'; } ?> value="Endorsed to the court">Endorsed to the court</option>
    </select>
    <p class="white-text">Filter by Hearing Date</p>
    <input name="start" class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input name="end" class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>