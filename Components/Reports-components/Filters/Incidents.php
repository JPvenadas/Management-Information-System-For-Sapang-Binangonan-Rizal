<form method="get" class="filter-content">
    <p class="white-text">Filter by:</p>
    <input type="hidden" name="content" value="Incidents">
    <select class="input" name="caseStatus" id="">
        <option value="" hidden disabled selected>Filter by Case status</option>
        <option <?php if(isset($_GET['caseStatus']) and $_GET['caseStatus'] === 'Pending') { echo 'selected'; } ?> value="Pending">Pending</option>
        <option <?php if(isset($_GET['caseStatus']) and $_GET['caseStatus'] === 'Solved') { echo 'selected'; } ?> value="Solved">Solved</option>
        <option <?php if(isset($_GET['caseStatus']) and $_GET['caseStatus'] === 'Endorsed to the court') { echo 'selected'; } ?> value="Endorsed to the court">Endorsed to the court</option>
    </select>
    <p class="white-text">Filter by Hearing Date</p>
    <input value="<?php if(isset($_GET['start'])){echo $_GET['start'];}?>" name="start" class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input value="<?php if(isset($_GET['end'])){echo $_GET['end'];}?>" name="end" class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button type="submit" class="filter-button">Apply Filters</button>
    </div>
</form>
<script>
  // Get the current URL
  const url = new URL(window.location.href);

  // Remove the userType and accountStatus parameters
  url.searchParams.delete('caseStatus');
  url.searchParams.delete('start');
  url.searchParams.delete('end');

  // Replace the current URL with the updated URL
  window.history.replaceState(null, null, url);
</script>