<div class="modal-background-blur">
    <div class="scroll">
        <form enctype="multipart/form-data" method="post" action="../../Pages/Residents/Residents.php"
            class="modal-content-container">
            <!-- close button -->
            <div onclick="closeAddResidentModal()" class="modal-close-button">
                <ion-icon name="close"></ion-icon>
            </div>

            <!-- Form Content -->
            <div class="modal-header-container">
                <div class="modal-Image-upload-container">
                    <img class="resident-image-preview"
                        src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" alt="">
                    <label class="resident-upload-button" for="upload-resident">
                        <ion-icon name="arrow-up-circle"></ion-icon>
                    </label>
                    <input required accept="image/*" class="resident-upload-input" name="image" class="" type="file">
                </div>
                <!-- Form Header -->
                <div class="modal-instructions-container">
                    <div class="modal-title">Add a Resident</div>
                    <div class="modal-instructions">Fill the neccessary information below</div>
                </div>
            </div>
            <!-- Name Inputs -->
            <p class="label">Resident's Full Name</p>
            <div class="resident-info-inputs">
                <?php include "Datalists.php"?>
                <input required autocomplete="off" placeholder="First Name" class="resident-input" name="firstName"
                    type="text">
                <input required autocomplete="off" placeholder="Middle Name" class="resident-input" name="middleName"
                    type="text">
                <input required autocomplete="off" placeholder="Last Name" class="resident-input" name="lastName"
                    type="text">
                <input autocomplete="off" placeholder="Name Extension" class="resident-input" name="extension"
                    type="text">
            </div>
            <!-- Other Informtion Inputs -->
            <p class="label">Other Information</p>
            <div class="resident-info-inputs">
                <input required autocomplete="off" placeholder="Birth Date" onfocus="(this.type = 'date')"
                    class="resident-input" name="birthDate" type="text">
                <input  autocomplete="off"required list="purok" placeholder="Purok" class="resident-input" name="purok" type="text">
                <input required autocomplete="off" placeholder="Exact Address" class="resident-input" name="address"
                    type="text">
                <input required list="sex" placeholder="Sex" class="resident-input" name="sex" type="text">
                <input required list="voterStatus" placeholder="Voter Status" class="resident-input" name="voterStatus"
                    type="text">
                <input required list="maritalStatus" placeholder="Marital Status" class="resident-input"
                    name="maritalStatus" type="text">
                <input required autocomplete="off" placeholder="Occupation" class="resident-input" name="occupation"
                    type="text">
                <input autocomplete="off" list="residentCategory" placeholder="Resident Category" class="resident-input"
                    name="residentCategory" type="text">
            </div>
            <!-- Head of the family field -->
            <div class="multiple-choice-container">
                <p class="label">Head of the family</p>
                <div class="choices">
                    <div>
                        <input onchange="showMemberInput()" type="radio" id="familyHead" name="familyHead" value="Yes">
                        <label class="text-small" for="familyHead">Yes</label>
                    </div>
                    <div>
                        <input onchange="showMemberInput()" type="radio" id="notFamilyHead" name="familyHead" value="No">
                        <label class="text-small" for="notFamilyHead">No</label>
                    </div>
                </div>
                <div id="familyMembersContainer" class="resident-info-inputs">
                    <input placeholder="Number of Family Members" min="1" id="familyMembers" name="familyMembers"
                        class="resident-input" type="number">
                </div>
            </div>
            <!-- Contact Information -->
            <p class="label">Contact Information</p>
            <div class="resident-info-inputs">
                <input autocomplete="off" placeholder="Contact Number (Optional)" class="resident-input"
                    name="contactNo" type="tet">
            </div>
            <div class="submit-button-container">
                <button class="add-resident-button" name="add_resident_button" type="submit">
                    <ion-icon name="add-sharp"></ion-icon>
                    <p>Add Resident</p>
                </button>
            </div>

        </form>
    </div>
    <script>
    let imageInput = document.querySelector('.resident-upload-input')
    let imagePreview = document.querySelector('.resident-image-preview')
    let body = document.querySelector('body')
    let modal = document.querySelector('.modal-background-blur')


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