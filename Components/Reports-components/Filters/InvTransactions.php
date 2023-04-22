<form method="GET" class="filter-content">
    <p class="white-text">Filter by:</p>
    <input type="hidden" name="content" value="Inventory">
    <select class="input" name="item" id="">
        <option value="" hidden disabled selected>Filter by Item Borrowed</option>
        <?php 
            $items = getItemList();
            foreach($items as $item){
        ?>
            <option <?php if(isset($_GET['item']) and $_GET['item'] === $item['itemID']) { echo 'selected'; } ?> value="<?php echo $item['itemID']?>"><?php echo $item['itemName']?></option>
        <?php }?>
    </select>
    <p class="white-text">Filter by Date</p>
    <input value="<?php if(isset($_GET['start'])){echo $_GET['start'];}?>" class="input" name="start" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input value="<?php if(isset($_GET['end'])){echo $_GET['end'];}?>" class="input" name="end" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>

<script>
  // Get the current URL
  const url = new URL(window.location.href);

  // Remove the userType and accountStatus parameters
  url.searchParams.delete('item');
  url.searchParams.delete('start');
  url.searchParams.delete('end');

  // Replace the current URL with the updated URL
  window.history.replaceState(null, null, url);
</script>