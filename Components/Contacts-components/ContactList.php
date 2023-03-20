<div class="contacts-container">
    <?php 
        require "ContactItem.php";
        $contacts = getContacts();
        generateItem($contacts['webLink'], 'globe');
        generateItem($contacts['phone'], 'call');
        generateItem($contacts['facebook'], 'logo-facebook');
        generateItem($contacts['email'], 'mail');
        generateItem($contacts['telegram'], 'paper-plane');
        generateItem($contacts['address'], 'location');
    ?>
</div>