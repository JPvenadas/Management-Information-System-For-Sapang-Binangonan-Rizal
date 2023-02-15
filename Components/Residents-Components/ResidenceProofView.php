<div class="modal-background-blur proof-modal">
    <button onclick="closeProofModal()" class="modal-close-button-2">
        <ion-icon name="close"></ion-icon>
    </button>
    <img class="proof-image" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($resident['residenceProof']); ?>" alt="">
</div> <script>
    let proofModal = document.querySelector('.proof-modal')
    proofModal.style.display = 'none'

    function closeProofModal() {
        proofModal.style.display = "none"
        body.style.overflowY = "auto"
    }

    function openProofModal() {
        proofModal.style.display = "flex"
        body.style.overflowY = "hidden"
    }
    </script>
