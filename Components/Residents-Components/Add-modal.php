<div id="add-modal" class="modal-blur">
    <div class="modal-scroll">
        <form enctype="multipart/form-data" method="post" action="../../Pages/Residents/Residents.php"
            class="modal-content-container">
            <!-- close button -->
            <div onclick="closeAddResidentModal()" class="modal-close-button">
                <ion-icon name="close"></ion-icon>
            </div>

            <!-- Form Content -->
            <div class="modal-content">
                <div class="modal-header-container">
                    <div class="modal-Image-upload-container">
                        <label for="upload-residendt">
                            <img class="resident-image-preview"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                alt="">
                        </label>
                        <label class="resident-upload-button" for="upload-resident">
                            <ion-icon name="arrow-up-circle"></ion-icon>
                        </label>
                        <input required accept="image/*" class="resident-upload-input" name="image" class=""
                            type="file">
                    </div>
                    <!-- Form Header -->
                    <div class="modal-title">
                        <h3>Add a Resident</h3>
                        <p>Fill the neccessary information below</p>
                    </div>
                </div>
                <!-- Name Inputs -->
                <div class="modal-inputs">
                    <?php include "Datalists.php"?>
                    <div class="input-container">
                        <label for="firstName">First Name *</label>
                        <input required autocomplete="off" placeholder="First Name" class="input" name="firstName"
                            id="firstName" type="text">
                    </div>
                    <div class="input-container">
                        <label for="middleName">Middle Name</label>
                        <input autocomplete="off" placeholder="Middle Name (optional)" class="input" name="middleName"
                            id="middleName" type="text">
                    </div>
                    <div class="input-container">
                        <label for="lastName">Last Name *</label>
                        <input required autocomplete="off" placeholder="Last Name" class="input" name="lastName"
                            id="lastName" type="text">
                    </div>
                    <div class="input-container">
                        <label for="extension">Name Extension</label>
                        <input autocomplete="off" placeholder="Name Extension (optional)" class="input" name="extension"
                            id="extension" type="text">
                    </div>
                    <div class="input-container">
                        <label for="birthDate">Birth Date</label>
                        <input required autocomplete="off" placeholder="Birth Date" max="<?php echo date('Y-m-d');?>"
                            onfocus="(this.type = 'date')" class="input" id="birthDate" name="birthDate" type="text">
                    </div>
                    <div class="input-container">
                        <label for="purok">Purok</label>
                        <input autocomplete="off" required list="purok" placeholder="Purok (choose from the choices)"
                            class="input" name="purok" id="purok" type="text">
                    </div>
                    <div class="input-container">
                        <label for="address">Exact Address</label>
                        <input required autocomplete="off"
                            placeholder="House Number, Street (ex: lot 123, Gitna Street)" class="input" name="address"
                            id="address" type="text">
                    </div>
                    <div class="input-container">
                        <label for="sex">Sex</label>
                        <input required list="sex" placeholder="Sex (choose from the choices)" class="input" name="sex"
                            id="sex" type="text">
                    </div>
                    <div class="input-container">
                        <label for="maritalStatus">Marital Status</label>
                        <input required list="maritalStatus" placeholder="Marital Status (choose from the choices)"
                            class="input" id="maritalStatus" name="maritalStatus" type="text">
                    </div>
                    <div class="input-container">
                        <label for="voterStatus">Voter Status</label>
                        <input required list="voterStatus" placeholder="Voter Status (choose from the choices)"
                            class="input" name="voterStatus" id="voterStatus" type="text">
                    </div>
                    <div class="input-container">
                        <label for="occupation">Occupation</label>
                        <input required autocomplete="off" placeholder="Occupation" class="input" name="occupation"
                            id="occupation" type="text">
                    </div>
                    <div class="input-container">
                        <label for="occupation">Head of the family</label>
                        <div class="choices">
                            <div>
                                <input required onchange="showMemberInput()" type="radio" id="familyHead"
                                    name="familyHead" value="Yes">
                                <label class="text-small" for="familyHead">Yes</label>
                            </div>
                            <div>
                                <input required onchange="showMemberInput()" type="radio" id="notFamilyHead"
                                    name="familyHead" value="No">
                                <label class="text-small" for="notFamilyHead">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="input-container" id="familyMembers">
                        <label for="familyMembersInput">Number of Family Members</label>
                        <input placeholder="Number of Family Members" min="1" id="familyMembersInput"
                            name="familyMembers" class="input" type="number">
                    </div>
                    <div class="input-container">
                        <label for="contactNumber">Contact Number</label>
                        <input autocomplete="off" placeholder="Contact Number" required class="input" name="contactNo"
                            type="text" onkeypress="
                        //function that will prevent non-numeric char
                        return event.charCode >= 48 && event.charCode <= 57" oninput="
                        //function that will prevent user from typing more than 6 digit
                        this.value = this.value.slice(0, 11)">
                    </div>
                </div>

                <div class="modal-button-container">
                    <button class="main-button" name="add_resident_button" type="submit">
                        <ion-icon name="add-sharp"></ion-icon>
                        <p>Add Resident</p>
                    </button>
                </div>
            </div>

        </form>
    </div>
    <script>
    let imageInput = document.querySelector('.resident-upload-input')
    let imagePreview = document.querySelector('.resident-image-preview')
    let body = document.querySelector('body')
    let modal = document.querySelector('#add-modal')


    // radio
    let FamilyMembersInput = document.querySelector('#familyMembers');
    let labelMembers = document.querySelector('#labelMembers');
    var yesRadio = document.querySelector("#familyHead")

    modal.style.display = "none"
    imageInput.addEventListener('change', (event) => {
        var image = URL.createObjectURL(event.target.files[0])
        imagePreview.src = image
    })

    function closeAddResidentModal() {
        modal.style.display = "none"
        body.style.overflowY = "auto"
    }

    function openAddResidentModal() {
        modal.style.display = "flex"
        body.style.overflowY = "hidden"
    }

    if (yesRadio.checked) {
        FamilyMembersInput.style.display = "inline";
        labelMembers.style.display = "inline";
    }
    const showMemberInput = () => {

        if (yesRadio.checked) {
            FamilyMembersInput.style.display = "inline";
            labelMembers.style.display = "inline";
        } else {
            FamilyMembersInput.style.display = "none";
            labelMembers.style.display = "none";
        }
    }
    </script>

</div>