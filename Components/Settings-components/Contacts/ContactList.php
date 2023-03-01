<div class="edit-button-container">
    <div class="section-title"></div>
    <button onclick="enableEditing()" class="edit-button">Edit Contact Information</button>
</div>

<form method="post" action="" class="edit-form" mehod="post">
    <div class="personal-information-container">
    <?php 
        require "ContactItem.php";
        $contacts = getContacts();
        generateItem('webLink', 'Webpage', $contacts['webLink']);
        generateItem('phone', 'Barangay Contact Number', $contacts['phone']);
        generateItem('facebook', 'Facebook Page', $contacts['facebook']);
        generateItem('email', 'Barangay Email', $contacts['email']);
        generateItem('telegram', 'Telegram', $contacts['telegram']);
        generateItem('address', 'Exact Address', $contacts['address']);
        generateItem('gcash', 'Gcash Number', $contacts['gcash']);
    ?>
    </div>

    <?php include "Save-cancel.php"?>
</form>

<script>
let cancelButton = document.querySelector(".cancel-editing")
let saveButton = document.querySelector(".save-editing")

cancelButton.style.display = "none"
saveButton.style.display = "none"

//function to execute when "edit personal info is clicked"
function enableEditing() {
//get the elements
    //all of the inputs in the personal information section
    let inputs = document.getElementsByClassName("contact-value");
    //edit personal info button
    let enableEditButton = document.querySelector(".edit-button")
    //save and cancel button 
   

    //show save and cancel button

    //loop to select all inputs
    for (var i = 0; i < inputs.length; i++) {
        //enable the inputs
        inputs[i].disabled = false;
        enableEditButton.style.display = 'none'
    }

}
</script>