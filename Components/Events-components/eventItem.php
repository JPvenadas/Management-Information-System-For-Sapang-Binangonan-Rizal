<?php
function generateItem($event){
?>

<button onclick="openEditModal('<?php echo $event['eventID']?>',
                               '<?php echo $event['eventName']?>',
                               '<?php echo $event['eventDescription']?>',
                               '<?php echo $event['start']?>',
                               '<?php echo $event['end']?>')" type="submit" name="view_resident_button" class="event-record">
    <div class="left">
        <div class="record-info">
            <p class="event-name"><?php echo $event['eventName']?></p>
            <p class="date"><?php echo date("F, d, Y", strtotime($event['start'])) . " - " . date("F, d, Y", strtotime($event['end']))?></p>
        </div>
    </div>
    <div class="action">
        <p>Click to view details</p>
    </div>
</button>
<script>
function escapeSpecialChars(str) {
  // Escape single quotes, double quotes, and backticks
  str = str.replace(/['"`]/g, '\\$&');
  
  // Remove any whitespace characters introduced by hitting "Enter" key in a textarea
  str = str.replace(/[\n\r]/g, '');
  
  return str;
}
console.log(escapeSpecialChars('<?php echo $event['eventDescription']?>'))
</script>
<?php }?>