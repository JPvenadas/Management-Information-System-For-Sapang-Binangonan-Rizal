<form method="post" action="../../Pages/Announcements/Announcements.php" class="new-message-container">
    <textarea required name="message" placeholder="Type your Message here" class="message-input"></textarea>
    <div class="relative">
        <?php
            //include the filter modal 
            include "FilterOptions.php"
        ?>
        <div onclick= "openFilter()" class="filter-button">
            <input readonly id="filter-value" name="filter_value" type="text" value="All Residents">
            <ion-icon name="chevron-up-sharp"></ion-icon>
        </div>
    </div>
    <button type="submit" name="send_message" class="send-button">
        <ion-icon name="send-sharp"></ion-icon>
    </button>
</form>

<script>
    //if the send button is clicked  get the contact numbers of recipients
   <?php if(isset($_POST['filter_value'])){
    $contacts = getFilteredContacts();
    ?>
    //all the contact number in javascript array
    let contacts = <?php echo json_encode($contacts)?>;
    // //loop through all the contacts and send the message
    contacts.map((contact)=>{
        let name = contact.Fullname;
        let number = contact.contactNo;
        let message = '<?php echo $_POST['message']?>';

        async function sendMessage(){
        const response = await fetch(`https://sms.teamssprogram.com/api/send?key=e171e8bfec664d8bc70118cb2d5c1085415d24bc&phone=+639${number}&message=${message}&device=280&sim=2`)
        const data = await response.json();
        console.log(data);
       }
       sendMessage();
    })
    
   <?php } ?>
</script>