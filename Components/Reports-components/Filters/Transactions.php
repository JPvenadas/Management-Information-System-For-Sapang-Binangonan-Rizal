<form method="GET" class="filter-content">
    <p class="white-text">Filter by:</p>
    <input type="hidden" name="content" value="Transactions">
    <select class="input" name="service">
        <option value="" hidden disabled selected>Filter by Service Category</option>
        <?php 
            $services = getServices();
            foreach($services as $service){
        ?>
            <option <?php if(isset($_GET['service']) and $_GET['service'] === $service['serviceName']) { echo 'selected'; } ?> value="<?php echo $service['serviceName']?>"><?php echo $service['serviceName']?></option>
        <?php }?>
    </select>
    <p class="white-text">Filter by Processed Date</p>
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
  url.searchParams.delete('service');
  url.searchParams.delete('start');
  url.searchParams.delete('end');

  // Replace the current URL with the updated URL
  window.history.replaceState(null, null, url);
</script>