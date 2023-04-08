<div id="image-modal" style="display: none" class="modal-background-blur image-modal">
    <button onclick="closeImageModal()" class="modal-close-button-2">
        <ion-icon name="close"></ion-icon>
    </button>
    <img class="image-report" src="" alt="">
</div>
 <script>
    let imageReportModal = document.querySelector('#image-modal')
    function closeImageModal() {
        imageReportModal.style.display = "none"
        body.style.overflowY = "auto"
    }

    function openImageModal(id) {
        let imageReport = document.querySelector(`#image-blotter-${id}`).src
        document.querySelector('.image-report').src = imageReport
        imageReportModal.style.display = "flex"
        body.style.overflowY = "hidden"
    }
    </script>
