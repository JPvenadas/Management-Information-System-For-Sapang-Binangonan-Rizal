<?php 
session_start();

if (isset($_SESSION['userType']) && isset($_SESSION['username'])) {
	if($_SESSION['userType'] == "Resident"){
        header("Location: Pages/Dashboard/Resident-Dashboard.php");
	    exit();
    }else{
        header("Location: Pages/Dashboard/Dashboard.php");
	    exit();
    }
}else{
    session_unset();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login: Sapang Management Information System</title>
    <link rel="shortcut icon" href="Images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="Images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Styles/Login.css">
</head>

<body>
    <!-- error and notifications alert -->
    <?php if (isset($_GET['error'])) { ?>
    <!-- error alert -->
    <div class="error-container">
        <p class="error"><?php echo $_GET['error']; ?></p>
    </div>
    <?php } ?>
    <?php if (isset($_GET['notif'])) { ?>
    <!-- notification alert -->
    <div class="error-container">
        <p class="notif"><?php echo $_GET['notif']; ?></p>
    </div>
    <?php } ?>

    <div class="login-container">
        <div class="login-left">
            <div class="login-title-container">
                <img class="logo" src="Images/logo.png" alt="">
                <h1 class="title">Management Information System for Barangay Sapang</h1>
            </div>
            <h2 class="greeting">WELCOME KABARANGAY!</h2>
            <form class="login-form" action="Functions/login.php" method="POST">
                <!-- username here -->
                <p class="label">Username</p>
                <input class="text-1" required type="text" name="uname" placeholder="Username">
                 <!-- password here -->
                <p class="label">Password</p>
                <input class="text-1" id="password" required type="password" name="password" placeholder="Password">
                 <!-- Show Password-->
                <div class="show-password">
                    <input id="show" type="checkbox">
                    <label class="label gray" for="show">Show Password</label>
                </div>
                 <!-- Login button -->
                <button class="login-button" type="submit">Login</button>
                <a class="login-button button-white" href="Pages/Register/RegistrationForm.php?step=1">
                    <div>Create an Account</div>
                </a>
                <a class="forgot-password" href="Pages/Recovery/AccountRecovery.php">Forgot your Password?</a>
            </form>
        </div>
        <div class="login-right">
            <div class="login-figure">
            </div>
        </div>
    </div>
    <script>
    const showPasswordCheckbox = document.getElementById('show');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
    </script>
</body>

</html>
<?php
}
?>