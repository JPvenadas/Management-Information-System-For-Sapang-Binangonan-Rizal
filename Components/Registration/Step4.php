<form action="?step=5" method="POST" class="form">
    <div class="limit-width">
        <h2 class="form-title">Profile and Contacts</h2>
        <p class="text">Please fill the necessary information and files below</p>
    </div>
    <div class="container">
        <div class="limit-width">
            <label class="label-2" for="sex">Profile Picture</label>
             <p class="text-medium">(1x1 picture, with white background and clear resolution)</p>
            <div class="input-upload-container">
                <input placeholder="Upload your Profile picture" id="image-title-profile" class="input" readonly
                    type="text">
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
                <input placeholder="Upload your proof of residence" id="image-title-proof" class="input" readonly
                    type="text">
                <input id="residenceProof" name="residenceProof" hidden type="file">
                <label class="upload-button" for="residenceProof">
                    <p>Upload</p>
                </label>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="limit-width">
            <label class="label-2" for="sex">Mobile Number (Optional)</label>
             <p class="text-medium">By providing us your mobile number, you agree to receive SMS notification and messages related from the barangay such as announcements and reminders. </p>
                <input placeholder="Upload your proof of residence" id="image-title-proof" class="input"type="text">
        </div>
    </div>
    <div class="button-group">
            <a href="?step=3" class="action-button">
                <p>Previous</p>
            </a>
            <button type="submit" class="action-button">
                <p>Next</p>
            </button>
    </div>
</form>
<script>
    let profile = document.querySelector('#profilePicture');
    let proof = document.querySelector('#residenceProof')

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