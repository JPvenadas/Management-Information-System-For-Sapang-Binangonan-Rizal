<form method="GET" class="filter-content">
    <p class="white-text">Filter by:</p>
    <input type="hidden" name="content" value="Employees">
    <select class="input" name="position" id="">
        <option value="" hidden disabled selected>Filter by Employee Position</option>
        <?php 
            $positions = getpositions();
            foreach($positions as $position){
        ?>
            <option <?php if(isset($_GET['position']) and $_GET['position'] === $position['position']) { echo 'selected'; } ?> value="<?php echo $position['position']?>"><?php echo $position['position']?></option>
        <?php }?>
    </select>
    <select class="input" name="termStatus" id="">
        <option value="" hidden disabled selected>Filter by Term Status</option>
        <option <?php if(isset($_GET['termStatus']) and $_GET['termStatus'] === 'Active') { echo 'selected'; } ?> value="Active">Active</option>
        <option <?php if(isset($_GET['termStatus']) and $_GET['termStatus'] === 'Inactive') { echo 'selected'; } ?> value="Inactive">Inactive</option>
    </select>
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>
<script>
  // Get the current URL
  const url = new URL(window.location.href);

  // Remove the userType and accountStatus parameters
  url.searchParams.delete('position');
  url.searchParams.delete('termStatus');

  // Replace the current URL with the updated URL
  window.history.replaceState(null, null, url);
</script>