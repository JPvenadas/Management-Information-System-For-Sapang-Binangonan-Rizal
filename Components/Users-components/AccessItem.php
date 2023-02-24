<?php
function generateAccessItem($field){
?>
<div class="access-item">
    <label for="<?php echo $field?>"><?php echo $field?></label>
    <input type="hidden" name="<?php echo $field?>" value="0" />
    <input class="checkbox" name="<?php echo $field?>" id="<?php echo $field?>" type="checkbox" value="1">
</div>
<?php }?>