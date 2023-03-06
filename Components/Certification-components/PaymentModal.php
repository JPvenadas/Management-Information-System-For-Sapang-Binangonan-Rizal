<?php
    $issuerFullName = $issuer['firstName'] . ' ' . $issuer['middleName'][0]. '.' . ' ' . $issuer['lastName'];
    $userFullName = $_SESSION['firstName'] . ' ' . $_SESSION['middleName'][0]. '.' . ' ' . $_SESSION['lastName'];
    //format the Amount or service fee to 00.00 PHP format
    $number = $service['serviceFee'];
    $output= round($number,2,PHP_ROUND_HALF_DOWN);
    $output= sprintf('%0.02f',$number);
    $formattedFee= str_pad(number_format($number, 2),4,'0',STR_PAD_LEFT) . " PHP";
    if($number == 0){
       $formattedFee = "Free";
    }
?>


<div class="modal-background-blur">
    <form action="../../Modules/Certification/CertificatePreview.php?service=<?php echo $_GET['service']?>&id=<?php echo $_GET['id']?>" method="post" class="modal-content-container">
        <div onclick="closePaymentModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <p>Process Payment</p>
        </div>
        <div class="record-container">
            <div class="record">
                <div class="field">
                    <p>Amount:</p>
                </div>
                <div class="value">
                    <p><?php echo "$formattedFee"?></p>
                    <input name="amount" type="hidden" value="<?php echo $number?>">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Document:</p>
                </div>
                <div class="value">
                    <p><?php echo $service['serviceName']?></p>
                    <input type="hidden" name="service" value="<?php echo $service['serviceID']?>">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>for:</p>
                </div>
                <div class="value">
                    <p><?php echo $issuerFullName?></p>
                    <input type="hidden" name="issuer" value="<?php echo $_GET['id']?>">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>issued at:</p>
                </div>
                <div class="value">
                    <p><?php echo date('F d, Y');?></p>
                    <input type="hidden" name="dateIssued" value="<?php echo date("Y-m-d")?>">
                </div>
            </div>
            <div class="record">
                <div class="field">
                    <p>Printed by:</p>
                </div>
                <div class="value">
                    <p><?php echo $userFullName?></p>
                    <input type="hidden" name="printedBy" value="<?php echo $_SESSION['residentsID']?>">
                </div>
            </div>
        </div>
        <div class="purpose-container">
            <p>Document purposes</p>
            <input type="text" required name="purpose" placeholder="Purpose of issued document" class="purpose-input">
        </div>
        <div class="button-container">
            <button type="submit" name="add_transaction">
                <ion-icon name="card"></ion-icon>
                <p>Confirm Payment</p>
            </button>
        </div>
    </form>
</div>

<script>
    let paymentModal = document.querySelector('.modal-background-blur')
    paymentModal.style.display = 'none'

    function closePaymentModal() {
        paymentModal.style.display = "none"
        body.style.overflowY = "auto"
    }

    function openPaymentModal() {
        paymentModal.style.display = "flex"
        body.style.overflowY = "hidden"
    }
    </script>