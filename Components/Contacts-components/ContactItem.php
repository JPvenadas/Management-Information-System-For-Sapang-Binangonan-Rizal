<?php function generateItem($name, $icon){?>
    <div class="contact-item">
        <ion-icon name="<?php echo $icon?>"></ion-icon>
        <p><?php echo $name?></p>
    </div>
<?php } ?>