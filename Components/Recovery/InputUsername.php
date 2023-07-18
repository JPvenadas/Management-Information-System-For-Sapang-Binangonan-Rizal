<form action="?page=provide otp" method="POST" class="form">
    <div class="limit-width">
        <h2 class="form-title">Forgot your Password?</h2>
        <p class="text">Please enter your username so we can help you recover your account.</p>
        <input required placeholder="Input your Username here" id="userName" name="userName" class="input" type="text">
        <!-- Write the error if there is -->
        <p class="text-error">
        <?php if(isset($_GET['error'])){
            echo $_GET['error'];
        }?>
        </p>
    </div>
    <div class="button-group">
            <a href="../../index.php" class="action-button">
                <p>Go back</p>
            </a>
            <button name="submitUserName" name="next3" type="submit" class="action-button">
                <p>Proceed</p>
            </button>
    </div>
</form>