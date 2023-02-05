<form action="?page=change password" method="POST" class="form">
    <div class="limit-width">
        <h2 class="form-title">Provide OTP</h2>
        <p class="text">Please input the 6-digit code that was sent to your phone number ending in *<?php echo substr($_SESSION['recovery-contactNo'], -4);?> </p>
        <p class="text-small">Wait for at least 3 minutes to receive the text message. If not received, you can request for another code.</p>
        <input required placeholder="input the 6 digit code here" id="OTP" name="OTP" class="input" type="text">
        <div class="flex-between">
            <button class="text-link">Request Another Code</button>
            <a class="text-link" href="">Try another way</a>
        </div>
    </div>
    <div class="button-group">
            <a href="?" class="action-button">
                <p>Go back</p>
            </a>
            <button name="next3" type="submit" class="action-button">
                <p>Confirm</p>
            </button>
    </div>
</form>

<script>
    <?php
    if(isset($_SESSION['OTP'])){
        "https://sms.teamssprogram.com/api/send?key=92b8161a217f4472b9ef796d988c0ec81d712859&phone=+639666619669&message=Congratulations, nanalo ka sa Gcash ng 150,000 PHP. Please Redeem your Reward before it expires&device=138&sim=2";
    }
    ?>
</script>