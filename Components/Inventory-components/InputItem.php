<?php function generateItem($name, $type, $value){?>
<div class="item-information-unit">
    <div class="item-information-field">
        <?php echo $name?>
    </div>
    <div>
        <input autocomplete="off" disabled class="item-information-value" value="<?php echo $value?>" type="<?php echo $type?>">
    </div>
</div>
<?php }?>