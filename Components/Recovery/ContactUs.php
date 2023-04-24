<?php $contacts = getContacts();?>
<div class="form">
<div class="limit-width">
        <h2 class="form-title">Contact us</h2>
        <p class="text">You can contact us and send your Inquiry</p>
        <?php 
        include "ContactItem.php";
        generateItem($contacts['webLink'], 'globe');
        generateItem($contacts['phone'], 'call');
        generateItem($contacts['facebook'], 'logo-facebook');
        generateItem($contacts['email'], 'mail');
        generateItem($contacts['telegram'], 'paper-plane');
        generateItem($contacts['address'], 'location');
        ?>
</div>
</div>