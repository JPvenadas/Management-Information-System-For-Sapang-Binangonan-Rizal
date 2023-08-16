<div id="edit-modal" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeEditModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="profile-container">
            <div class="profile-left">
                <h3 id="fullName"></h3>
                <p id="username"></p>
                <p id="userType"></p>
            </div>
            <div class="profile-right" id="profile">
                <a href="../../Pages/Residents/Profile.php?id=" class="view-profile-button">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <p>View Profile</p>
                </a>
            </div>
            <div class="profile-right" id="profile-icon">
                <a href="../../Pages/Residents/Profile.php?id=" id="profile-icon-button" class="view-profile-button">
                    <ion-icon name="person"></ion-icon>
                </a>
            </div>
        </div>
        <form action="../../Pages/Users/Users.php?<?php 
            if(isset($_GET['filter'])){
                echo "filter=" . $_GET['filter'];
            }?>
            " method="post" class="container">
            <p>Change Password</p>
            <div>
                <input id="username-form1" type="hidden" name="userName">
                <input id="password" name="password" type="password" required placeholder="Password"
                    class="purpose-input">
                <button class="save" name="change_password">Save</button>
            </div>
            <!-- Show Password-->
            <div class="show-password">
                <input id="show" type="checkbox">
                <label class="label gray" for="show">Show Password</label>
            </div>
        </form>
        <form action="../../Pages/Users/Users.php?<?php 
            if(isset($_GET['filter'])){
                echo "filter=" . $_GET['filter'];
            }?>
        " method="post" class="button-container">
            <input id="username-form2" type="hidden" name="userName">
            <button id="deactivate" type="submit" class="button deactivate" name="deactivate">
                <ion-icon name="settings"></ion-icon>
                <p>Deactivate</p>
            </button>
            <button id="activate" type="submit" class="button promote" name="activate">
                <ion-icon name="settings"></ion-icon>
                <p>Activate</p>
            </button>
            <div class="button demoteStaff demote">
                <ion-icon name="settings"></ion-icon>
                <p>Change to Employee</p>
            </div>
            <button type="submit" class="button demoteResident demote" name="changeToResident">
                <ion-icon name="settings"></ion-icon>
                <p>Change to Resident</p>
            </button>
            <button type="submit" class="button promoteAdmin promote" name="changeToAdmin">
                <ion-icon name="settings"></ion-icon>
                <p>Change to Admin</p>
            </button>
            <div type="submit" class="button promoteStaff promote">
                <ion-icon name="settings"></ion-icon>
                <p>Change to Employee</p>
            </div>
        </form>
    </div>
</div>

<script>
let editModal = document.getElementById('edit-modal')
editModal.style.display = 'none'
let body = document.querySelector('body')

let fullNameField = document.getElementById('fullName')
let activateButton = document.getElementById('activate')
let deactivateButton = document.getElementById('deactivate')
let imageField = document.getElementById('image')
let usernameField = document.getElementById('username')
let usernameForm1 = document.getElementById('username-form1')
let usernameForm2 = document.getElementById('username-form2')
let userTypeField = document.getElementById('userType')
let demoteStaff = document.querySelector('.demoteStaff');
let demoteResident = document.querySelector('.demoteResident');
let promoteAdmin = document.querySelector('.promoteAdmin');
let promoteStaff = document.querySelector('.promoteStaff');
let viewProfile = document.querySelector('.view-profile-button');
let viewProfileIcon = document.querySelector('#profile-icon-button');
let residentIDField;


function closeEditModal() {
    editModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openEditModal(residentID, fullName, username, userType, status) {
    editModal.style.display = "flex"
    body.style.overflowY = "hidden"

    fullNameField.innerHTML = fullName;
    usernameField.innerHTML = "Username " + username
    usernameForm1.value = username
    usernameForm2.value = username
    userTypeField.innerHTML = "User type: " + userType
    viewProfile.href = "../../Pages/Residents/Profile.php?id=" + residentID
    viewProfileIcon.href = "../../Pages/Residents/Profile.php?id=" + residentID
    residentIDField = residentID

    if (userType == "Administrator") {
        demoteResident.style.display = 'flex';
        demoteStaff.style.display = 'flex';
        promoteAdmin.style.display = 'none'
        promoteStaff.style.display = 'none'
    } else if (userType == "Staff") {
        demoteResident.style.display = 'flex';
        demoteStaff.style.display = 'none';
        promoteAdmin.style.display = 'flex'
        promoteStaff.style.display = 'none'
    } else {
        demoteResident.style.display = 'none';
        demoteStaff.style.display = 'none';
        promoteAdmin.style.display = 'flex'
        promoteStaff.style.display = 'flex'
    }
    if (status == "Active") {
        activateButton.style.display = 'none';
        deactivateButton.style.display = 'flex';
    } else {
        activateButton.style.display = 'flex';
        deactivateButton.style.display = 'none';
    }
}
demoteStaff.addEventListener('click', () => {
    openAccessModal(usernameForm1.value)
})
promoteStaff.addEventListener('click', () => {
    openAccessModal(usernameForm1.value)
})

const showPasswordCheckbox = document.getElementById('show');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
});
</script>