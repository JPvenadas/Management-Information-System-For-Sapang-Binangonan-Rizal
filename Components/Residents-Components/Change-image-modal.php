
<form enctype="multipart/form-data" action="../../Pages/Residents/Profile.php?id=<?php echo $_GET['id']?>" method="post"
    class="modal-blur change-picture-modal">
    <div class="modal-scroll">
        <div class="modal-content-container">
            <div onclick="closeChangeImageModal()" class="modal-close-button">
                <ion-icon name="close"></ion-icon>
            </div>
            <div class="modal-content">
                <div class="modal-title">
                    <h3 class="modal-title">Change Profile Image</h3>
                    <p>Please upload a 1x1 profile picture of a resident. The picture should have a white background, decent resolution, taken within the last year, and features appropriate attire."</p>
                </div>
                <div>
                    <label for="change_image" class="drag-and-drop-label">
                        <!-- Add a drop area for drag-and-drop -->
                        <div class="uploads-img-container">
                            <div class="upload-none">
                                <div class="image-icon"></div>
                                <p>Click here to browse an Image or drag and drop here</p>
                            </div>
                            <div class="upload-isset" style="display: none;">
                                <img src="" class="image-preview" alt="">
                                <p>Click again to change the image</p>
                            </div>
                        </div>
                    </label>
                    <!-- Hidden input for file upload -->
                    <input type="hidden" name="oldImage" value="<?php echo $resident['image']?>">
                    <input accept="image/*" required id="change_image" class="change-image-input"
                        name="change_image_input" type="file" style="display: none;">
                </div>
                <div class="modal-button-container">
                    <button name="change_image_button" type="submit" class="main-button">
                        <ion-icon name="arrow-up"></ion-icon>
                        <p>Save Image</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let imageInput = document.querySelector('.change-image-input');
        let imagePreview = document.querySelector('.image-preview');
        let modal = document.querySelector('.change-picture-modal');
        let uploadNone = document.querySelector('.upload-none');
        let uploadIsset = document.querySelector('.upload-isset');
        let body = document.querySelector('body');

        modal.style.display = 'none';

        // Handle file selection via drag-and-drop
        document.querySelector('.drag-and-drop-label').addEventListener('dragover', (event) => {
            event.preventDefault();
            event.currentTarget.classList.add('dragover');
        });

        document.querySelector('.drag-and-drop-label').addEventListener('dragleave', (event) => {
            event.preventDefault();
            event.currentTarget.classList.remove('dragover');
        });

        document.querySelector('.drag-and-drop-label').addEventListener('drop', (event) => {
            event.preventDefault();
            event.currentTarget.classList.remove('dragover');
            if (event.dataTransfer.files.length > 0) {
                var image = URL.createObjectURL(event.dataTransfer.files[0]);
                imagePreview.src = image;
                uploadNone.style.display = 'none';
                uploadIsset.style.display = 'flex';
                // Set the selected file in the file input
                imageInput.files = event.dataTransfer.files;
            } else {
                uploadNone.style.display = 'flex';
                uploadIsset.style.display = 'none';
            }
        });

        imageInput.addEventListener('change', (event) => {
            if (event.target.files.length > 0) {
                var image = URL.createObjectURL(event.target.files[0]);
                imagePreview.src = image;
                uploadNone.style.display = 'none';
                uploadIsset.style.display = 'flex';
            } else {
                uploadNone.style.display = 'flex';
                uploadIsset.style.display = 'none';
            }
        });

        function closeChangeImageModal() {
            modal.style.display = 'none';
            body.style.overflowY = 'auto';
        }

        function openChangeImageModal() {
            modal.style.display = 'flex';
            body.style.overflowY = 'hidden';
        }
    </script>
</form>
