<form method="GET" class="filter-content">
    <p class="white-text">Filter by Event Date</p>
    <input type="hidden" name="content" value="Events">
    <input value="<?php if(isset($_GET['start'])){echo $_GET['start'];}?>" name="start" class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input value="<?php if(isset($_GET['end'])){echo $_GET['end'];}?>" name="end" class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button type="submit" class="filter-button">Apply Filters</button>
    </div>
</form>

<script>
  // Get the current URL
  const url = new URL(window.location.href);

  // Remove the  parameters
  url.searchParams.delete('start');
  url.searchParams.delete('end');

  // Replace the current URL with the updated URL
  window.history.replaceState(null, null, url);
</script>