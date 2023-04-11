<div id="edit-transaction-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post"
        action="../../Pages/Inventory/Item.php" class="modal-content-container">
        <div onclick="closeEditTransactionModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Transaction Record</h3>
        </div>
        <div class="record-container">
            <div class="record">
                <div class="field">
                    <p>Service:</p>
                </div>
                <div class="value">
                    <input readonly type="text" id="serviceName-edit" name="serviceName">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Amount:</p>
                </div>
                <div class="value">
                    <input readonly type="text" id="serviceFee-edit" name="serviceFee">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>for:</p>
                </div>
                <div class="value">
                    <input type="hidden" id="residentID-edit" name="residentID">
                    <input readonly type="text" id="issuer-edit" name="fullName">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>issued at:</p>
                </div>
                <div class="value">
                    <input readonly type="text" id="dateRequested-edit" name="dateRequested"
                        value="<?php echo date('F d, Y')?>">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Assisted by:</p>
                </div>
                <div class="value">
                    <input readonly type="text" id="user" name="assistedBy-edit"
                        value="<?php echo $_SESSION['firstName'] . ' ' . $_SESSION['middleName'][0] . '.' . ' ' . $_SESSION['lastName']?>">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Purpose</p>
                </div>
                <div class="value">
                    <input readonly type="text" id="purpose-edit" name="purpose">
                </div>
            </div>
        </div>
        <div class="divider"></div>
    </form>
</div>
<script>

    let editTransactionModal = document.querySelector("#edit-transaction-modal");

    function openEditTransactionModal(){
        editTransactionModal.style.display = "flex";
        body.style.overflow = "hidden"
    }
    function closeEditTransactionModal(){
        editTransactionModal.style.display = "none";
        body.style.overflow = "auto";
    }
</script>