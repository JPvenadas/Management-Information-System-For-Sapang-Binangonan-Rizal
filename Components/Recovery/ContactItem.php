<?php
function generateItem($contact, $icon){
?>
<div class="flex-row">
            <ion-icon name="<?php echo $icon?>" class="contacts-icon"></ion-icon>
            <p class="text"><?php echo $contact?></p>
</div>
<?php } ?>