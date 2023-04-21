<form method="get" class="filter-content">
    <p class="white-text">Filter by:</p>
    <input type="hidden" name="content" value="Users">
    <select value="Administrator" class="input" name="userType" id="">
        <option value="" hidden disabled selected>Filter by User type</option>
        <option <?php if(isset($_GET['userType']) and $_GET['userType'] === 'Administrator') { echo 'selected'; } ?> value="Administrator">Administrator</option>
        <option <?php if(isset($_GET['userType']) and $_GET['userType'] === 'Staff') { echo 'selected'; } ?> value="Staff">Staff</option>
        <option <?php if(isset($_GET['userType']) and $_GET['userType'] === 'Resident') { echo 'selected'; } ?> value="Resident">Resident</option>
    </select>
    <select class="input" name="accountStatus" id="">
        <option value="" hidden disabled selected>Filter by Account Status</option>
        <option <?php if(isset($_GET['accountStatus']) and $_GET['accountStatus'] === 'Active') { echo 'selected'; } ?> value="Active">Active</option>
        <option <?php if(isset($_GET['accountStatus']) and $_GET['accountStatus'] === 'Inactive') { echo 'selected'; } ?> value="Inactive">Inactive</option>
    </select>
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>

<script>
  // Get the current URL
  const url = new URL(window.location.href);

  // Remove the userType and accountStatus parameters
  url.searchParams.delete('userType');
  url.searchParams.delete('accountStatus');

  // Replace the current URL with the updated URL
  window.history.replaceState(null, null, url);
</script>
