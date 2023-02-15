<form action="" method="POST" class="form">
    <div class="limit-width">
        <h2 class="form-title">Provide OTP</h2>
        <p class="text">Please input the 6-digit code that was sent to your phone number ending in *<?php echo substr($_SESSION['recovery-contactNo'], -4);?> </p>
        <p class="text-small">Wait for at least 3 minutes to receive the text message. If not received, you can request for another code.</p>


        <input required placeholder="input the 6 digit code here" id="OTP" name="OTP" class="input" type="text"
        onkeypress="
        //function that will prevent non-numeric char
        return event.charCode >= 48 && event.charCode <= 57" 
        oninput="
        //function that will prevent user from typing more than 6 digit
        this.value = this.value.slice(0, 6)">
        
         <!-- Write the error if there is -->
         <p class="text-error">
        <?php if(isset($_GET['error'])){
            echo $_GET['error'];
        }?>
        </p>

        <div class="flex-between">
            <button onclick="unrequire()" type="submit" name="anotherCode" id="anotherCode" class="text-link">Request Another Code</button>
            <a class="text-link" href="?page=contact us">Try another way</a>
        </div>
    </div>
    <div class="button-group">
            <a href="?" class="action-button">
                <p>Go back</p>
            </a>
            <button name="checkOTP" type="submit" class="action-button">
                <p>Confirm</p>
            </button>
    </div>
</form>

<script>
    
    <?php
    if(isset($_POST['submitUserName']) || isset($_POST['anotherCode'])){
    ?>
       async function sendOTP(){
        const response = await fetch("https://sms.teamssprogram.com/api/send?key=e171e8bfec664d8bc70118cb2d5c1085415d24bc&phone=+639<?php echo $_SESSION['recovery-contactNo'] ?>&message=<?php echo $_SESSION['OTP']?> is your One-Time code for Barangay Sapang MIS&device=280&sim=2")
        const data = await response.json();
        console.log(data);
       }
       sendOTP();
    <?php }?>
    
    function unrequire(){
        let otp = document.querySelector('#OTP');
        let button = document.querySelector('#anotherCode');
        otp.removeAttribute('required');
        button.click()
    }
</script>