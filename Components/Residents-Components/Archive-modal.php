<form method="post" enctype="multipart/form-data" action="../../Pages/Residents/Residents.php"
    method="post" class="modal-background-blur archive-modal">
    <div class="modal-content-container-2">
        <div onclick="closeArchiveModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="exclamation-instructions">
            <div class="exclamation-container">
                <ion-icon class="exclamation" name="alert-circle"></ion-icon>
            </div>
        <div class="modal-instruction-archive">
            <p class="modal-title">Confirm Archiving</p>
            <p class="instruction">Caution!! Archiving will totally deactivate the profile of the resident. Continue anyways?</p>
            </div>
        </div>
            <input type="hidden" name="residentID" value="<?php echo $_GET['id']?>">
        <div class="archive-button-container-modal">
            <button onclick="openArchiveModal()" type="submit" name="archive_resident" class="archive-resident-button">
                <ion-icon name="archive"></ion-icon>
                <p>Archive</p>
            </button>
        </div>
    </div>
    <script>
    let modalArchive = document.querySelector('.archive-modal')
    modalArchive.style.display = 'none'

    function closeArchiveModal() {
        modalArchive.style.display = "none"
        body.style.overflowY = "auto"
    }

    function openArchiveModal() {
        modalArchive.style.display = "flex"
        body.style.overflowY = "hidden"
    }
    </script>
</form>