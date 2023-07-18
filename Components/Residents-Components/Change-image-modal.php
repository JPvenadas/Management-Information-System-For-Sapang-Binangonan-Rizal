<form  enctype="multipart/form-data" action="../../Pages/Residents/Profile.php?id=<?php echo $_GET['id']?>" method="post" class="modal-background-blur change-picture-modal">
    <div class="modal-content-container">
    <div onclick="closeChangeImageModal()" class="modal-close-button"><ion-icon name="close"></ion-icon></div>
        <div class="modal-instruction">
            <p class="modal-title">Change Profile Image</p>
            <p>Upload an Image(1x1) of the resident</p>
        </div>
        <div class="modal-button-container">
            <label for="change_image">
                <img class="image-preview" src="../../Images/upload_img.png" alt="">
            </label>
            <input accept="image/*" required id="change_image" class="change-image-input" name="change_image_input" type="file">
        </div>
        <div>
            <button name="change_image_button" type="submit" class="modal-button">
            <ion-icon name="arrow-up"></ion-icon>
            <p>Upload Image</p> 
            </button>
        </div>
    </div>
    <script>
        let imageInput = document.querySelector('.change-image-input')
        let imagePreview = document.querySelector('.image-preview')
        let modal = document.querySelector('.change-picture-modal')
        modal.style.display = 'none'
        let body = document.querySelector('body')

        imageInput.addEventListener('change', (event) => {
            var image = URL.createObjectURL(event.target.files[0])
            imagePreview.src = image
        })
        function closeChangeImageModal(){
            modal.style.display = "none"
            body.style.overflowY = "auto"
        }
        function openChangeImageModal(){
            modal.style.display = "flex"
            body.style.overflowY = "hidden"
        }
        </script>
</form>