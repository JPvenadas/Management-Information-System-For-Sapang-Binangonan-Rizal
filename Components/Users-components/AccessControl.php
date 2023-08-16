<form method="post" action="../../Pages/Users/Users.php?<?php 
    if(isset($_GET['filter'])){
        echo "filter=" . $_GET['filter'];
    }?>
" id="access-modal" class="modal-background-blur">
    <div class="modal-content-container access-control-modal">
        <div onclick="closeAccessModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="access-container">
            <div class="access-header">
                <h3 class="h3">Configure Access for Employee</h3>
                <p class="instructions">Check all the Functions Accessible for this User</p>
            </div>
            <div class="access-items">
                <?php 
                include "AccessItem.php";
                foreach($fields as $field){
                    generateAccessItem($field['Field']);
                }
                ?>
            </div>

            <div class="button-container">
                <input id="username-form3" type="hidden" name="userName">
                <button type="submit" class="button promote" name="changeAccess">
                    <ion-icon name="settings"></ion-icon>
                    <p>Save Configuration</p>
                </button>
            </div>
        </div>
    </div>
</form>
<script>
console.log("hello")
let accessModal = document.getElementById('access-modal')
accessModal.style.display = 'none'
let usernameField3 = document.getElementById('username-form3');

function closeAccessModal() {
    accessModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openAccessModal(username) {
    accessModal.style.display = "flex"
    body.style.overflowY = "hidden"
    usernameField3.value = username
    closeEditModal()
}
</script>