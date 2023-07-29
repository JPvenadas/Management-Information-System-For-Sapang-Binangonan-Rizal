<div class="background-blur">
    <form class="form" method="post" action="../../Pages/Announcements/Announcements.php">
        <div class="header vertical-center flex-between">
            <h3>Create an announcement</h3>
            <ion-icon onclick="closePostModal()" class="close" name="close"></ion-icon>
        </div>
        <div class="content">
            <div class="flex-between">
                <label for="subject">Subject</label>
                <input list="announcementList" name="type" placeholder="Write the subject of the announcement here" id='subject' class="input" type="text">
            </div>
            <?php include "Datalist.php"?>
            <div class="flex-between">
                <label for="">Message:</label>
                <textarea class="long-input" required name="message" placeholder="Type your Message here"
                    class="message-input"><?php if(isset($_GET['message'])){echo $_GET['message'];}?></textarea>
            </div>
            <div class="flex-between">
                <label id='to' for="">To:</label>
                <div id="to" class="relative width90">
                    <?php
                        //include the filter modal 
                        include "FilterOptions.php"
                    ?>
                    <div onclick="openFilter()" class="combo-box-input">
                        <input style="background: none" readonly id="filter-value" name="filter_value" type="text" value="All Residents">
                        <ion-icon id="filter-icon" name="chevron-up-sharp"></ion-icon>
                    </div>
                </div>
            </div>
            <button type="submit" name="send_message" class="send-button">Post</button>
        </div>
    </form>
</div>
<script>
let body = document.querySelector('body');
let postModal = document.querySelector('.background-blur');

function showPostModal() {
    postModal.style.display = "flex"
    body.style.overflowY = "hidden"
}

function closePostModal() {
    postModal.style.display = "none"
    body.style.overflowY = "auto"
}


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