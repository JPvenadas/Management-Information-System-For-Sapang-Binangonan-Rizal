<?php
function generateInfoItem($name,$field, $value, $type){
?>
<div class="personal-information-item">
    <div class="personal-information-field">
        <?php echo $field;?>
    </div>
    <div>
        <input autocomplete="off" list="<?php echo $name?>" disabled class="personal-information-value information-input-<?php echo $name?>" name="personal-information-<?php echo $name?>" value="<?php echo $value?>" type="<?php echo $type?>">
    </div>
</div>
<?php }?>