<form class="form" method="POST" action="">
    <div class="limit-width">
        <h2 class="form-title">Change your Password</h2>
        <p class="text">Your password must have at least:</p>
        <ul>
            <li class="list-item">8 characters long</li>
            <li class="list-item">1 uppercase & 1 lowercase character</li>
            <li class="list-item">1 number</li>
        </ul>
        <input required onkeyup="checkPassword(this.value)" name="password" id="password-input" type="password" class="input" placeholder="Input your Password">
        <input required onkeyup="checkPassword(this.value)" id="confirm-password" type="password" class="input" placeholder="Confirm Password">
        <p class="text-error"></p>
    </div>
    <div class="button-group">
            <a href="../../index.php" class="action-button">
                <p>Cancel</p>
            </a>
            <button name="changePassword" id="change-button" type="submit" class="action-button">
                <p>Change</p>
            </button>
    </div>
</form>
<script>
    let passwordInput = document.getElementById('password-input');
    let confirmPassword = document.getElementById('confirm-password');
    let signupButton = document.getElementById('change-button');
    let errorText = document.querySelector('.text-error');

    let passViolations = []

    const checkPassword = () =>{
    passViolations = []

    if (!passwordInput.value.match(/^[A-Za-z0-9]{8,}$/)) {
        passViolations.push("Must have 8 characters")
        signupButton.disabled = true;
    }else if(!passwordInput.value.match(/^(?=.*[a-z])/)){
        passViolations.push("Must have 1 lowercase character")
        signupButton.disabled = true;
    }
    else if(!passwordInput.value.match(/^(?=.*[A-Z])/)){
        passViolations.push("Must have 1 uppercase character")
        signupButton.disabled = true;
    }
    else if(!passwordInput.value.match((/\d/))){
        passViolations.push("Must have 1 number")
        signupButton.disabled = true;
    }
    else if(passwordInput.value != confirmPassword.value){
        passViolations.push("Password does not match")
        signupButton.disabled = true;
    }else{
        signupButton.disabled = false;
        errorText.innerHTML = ""
        return;
    }
        errorText.innerHTML = passViolations[0]
    }
</script>