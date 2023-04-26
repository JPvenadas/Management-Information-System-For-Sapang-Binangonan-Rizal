<?php 
session_start();

require "../../Functions/dashboard-sql-commands.php";

//if the user is logged in direct them to their dashboard.
//if the user wants to go to the registration page(which is here) they must log out first 
if (isset($_SESSION['userType']) && isset($_SESSION['username']) && $_SESSION['userType'] == "Resident") {
	?>
<!DOCTYPE html>
<html>

<head>
    <title>Login: Sapang Management Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../Styles/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/DashboarD.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Tab-title.css">
    <!-- a script to prevent the "confirm resubmission" alert -->
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</head>

<body>
    <!-- Attach the navbar -->
    <?php
     require "../../Components/Navbar/Resident-Navbar.php";
     attachNavbar("dashboard");
     ?>

    <div class="dashboard-content">
        <!-- Attach the Tab title/header -->
        <?php require "../../Components/Tab-title.php";
        $firstname = $_SESSION['firstName'];
        attachTabTitle("Hello $firstname! Welcome to your Dashboard")?>

        <div class="features">
            <div class="feature-container light-blue">
                <div class="left">
                    <img src="../../Images/ProfileInformation.png" alt="">
                </div>
                <div class="right">
                    <h3>Keep Your profile updated</h3>
                    <p>Be sure to keep your profile updated with your current contact information, and personal details.
                        This will ensure that Barangay Personnels can easily get in touch with you, and that your data
                        is always up-to-date.</p>
                    <a href="../Residents/Profile.php?id=<?php echo $_SESSION['residentID']?>">Update</a>
                </div>
            </div>

            <div class="feature-container light-red">
                <div class="left">
                    <img src="../../Images/documents3.png" alt="">
                </div>
                <div class="right">
                    <h3>Pending Transactions</h3>
                    <p>Keep Track of your Transactions and Requests.</p>
                    <a href="../Services/Resident-Services.php">View</a>
                </div>
            </div>

            <div class="feature-container light-gray">
                <div class="left">
                    <img src="../../Images/Message.png" alt="">
                </div>
                <div class="right">
                    <h3>New Announcements</h3>
                    <p>To be up to date with the new announcements, you can check the website regularly, or update the
                        mobile number in your profile to recieve sms notifications</p>
                    <a href="../Announcements/Resident-announcements.php">Check</a>
                </div>
            </div>

        </div>
    </div>

    <!-- Script for Ionic Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php
}else{
    header("Location: ../../index.php");
	exit();
}
?>