<form method="get" class="filter-content">
    <p class="white-text">Filter by:</p>
    <input type="hidden" name="content" value="Residents">
    <select class="input" name="sex" id="">
        <option value="" hidden disabled selected>Filter by Sex</option>
        <option <?php if(isset($_GET['sex']) and $_GET['sex'] === 'Male') { echo 'selected'; } ?>  value="Male">Male</option>
        <option <?php if(isset($_GET['sex']) and $_GET['sex'] === 'Female') { echo 'selected'; } ?> value="Female">Female</option>
        <option <?php if(isset($_GET['sex']) and $_GET['sex'] === 'Non-binary') { echo 'selected'; } ?> value="Non-binary">Non-binary</option>
    </select>
    <select class="input" name="purok" id="">
        <option value="" hidden disabled selected>Filter by Purok</option>
        <?php 
            $puroks = getPuroks();
            foreach($puroks as $purok){
        ?>
            <option <?php if(isset($_GET['purok']) and $_GET['purok'] === $purok['purok']) { echo 'selected'; } ?> value="<?php echo $purok['purok']?>"><?php echo $purok['purok']?></option>
        <?php }?>
    </select>
    <select class="input" name="voterStatus" id="">
        <option value="" hidden disabled selected>Filter by Voter Status</option>
        <option <?php if(isset($_GET['voterStatus']) and $_GET['voterStatus'] === 'Registered') { echo 'selected'; } ?> value="Registered">Registered</option>
        <option <?php if(isset($_GET['voterStatus']) and $_GET['voterStatus'] === 'Non-voter') { echo 'selected'; } ?> value="Non-voter">Non-voter</option>
    </select>
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>
<script>
  // Get the current URL
  const url = new URL(window.location.href);

  // Remove the userType and accountStatus parameters
  url.searchParams.delete('sex');
  url.searchParams.delete('purok');
  url.searchParams.delete('voterStatus');

  // Replace the current URL with the updated URL
  window.history.replaceState(null, null, url);
</script>