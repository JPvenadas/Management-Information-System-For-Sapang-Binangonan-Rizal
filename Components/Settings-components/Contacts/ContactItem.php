<?php
function generateItem($name,$field, $value){
?>
<div class="contact-item">
    <div class="contact-field">
        <?php echo $field;?>
    </div>
    <div>
        <input required autocomplete="off" disabled class="contact-value contact-input-<?php echo $name?>" name="contact-<?php echo $name?>" value="<?php echo $value?>" type="text">
    </div>
</div>
<?php }?>