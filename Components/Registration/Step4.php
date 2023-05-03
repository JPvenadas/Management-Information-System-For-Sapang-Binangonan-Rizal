<form action="?step=5" enctype="multipart/form-data" method="POST" class="form">
    <div class="limit-width">
        <h2 class="form-title">Profile and Contacts</h2>
        <p class="text">Please fill the necessary information and files below</p>
    </div>
    <div class="container">
        <div class="limit-width">
            <label class="label-2" for="sex">Profile Picture</label>
            <p class="text-medium">(1x1 picture, with white background and clear resolution)</p>

            <!-- profile picture upload section -->
            <div class="input-upload-container">
                <input required placeholder="Upload your Profile picture" name="profilePictureTitle"
                    id="image-title-profile" class="input" readonly type="text"
                    value="<?php inputContent('profilePictureTitle'); ?>">
                <input id="profilePicture" name="profilePicture" hidden type="file">
                <label class="upload-button" for="profilePicture">
                    <p>Upload</p>
                </label>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="limit-width">
            <label class="label-2" for="sex">Proof of Residence</label>
            <p class="text-medium">Upload a Barangay Document as a proof of your residence</p>
            <div class="input-upload-container">

                <!-- Proof of residence upload section -->
                <input required placeholder="Upload your proof of residence" name="residenceProofTitle"
                    id="image-title-proof" class="input" readonly type="text"
                    value="<?php inputContent('residenceProofTitle'); ?>">
                <input id="residenceProof" name="residenceProof" hidden type="file">
                <label class="upload-button" for="residenceProof">
                    <p>Upload</p>
                </label>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="limit-width">

            <!-- mobile number section -->
            <label class="label-2" for="sex">Mobile Number</label>
            <p class="text-medium">By providing us your mobile number, you agree to receive SMS notification and
                messages related from the barangay such as announcements and reminders. </p>
            <input required autocomplete="off" placeholder="Input your Mobile number here" name="mobileNumber" id="image-title-proof" class="input"
                type="text" value="<?php inputContent('mobileNumber'); ?>" onkeypress="
            //function that will prevent non-numeric char
            return event.charCode >= 48 && event.charCode <= 57" oninput="
            //function that will prevent user from typing more than 6 digit
            this.value = this.value.slice(0, 11)">
        </div>
    </div>
    <div class="button-group">
        <a href="?step=3" class="action-button">
            <p>Previous</p>
        </a>
        <button name="next4" type="submit" class="action-button">
            <p>Next</p>
        </button>
    </div>
</form>
<script>
let profile = document.querySelector('#profilePicture');
let proof = document.querySelector('#residenceProof');

profile.addEventListener('change', (event) => {
    imageTitleField = document.querySelector('#image-title-profile')
    var image = event.target.files[0]
    imageTitleField.value = image.name
})
proof.addEventListener('change', (event) => {
    imageTitleField = document.querySelector('#image-title-proof')
    var image = event.target.files[0]
    imageTitleField.value = image.name
})
</script>