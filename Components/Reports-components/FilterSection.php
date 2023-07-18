<div class="ham-menu">
    <ion-icon name="menu"></ion-icon>
</div>
<div class="side-bar">
    <a href="../../Pages/Reports/Reports.php" class="logo-container">
        <div class="right">
            <img class="logo" src="../../Images/logo.png" alt="">
        </div>
        <div class="left">
            <p>Management Information System for Barangay Sapang</p>
        </div>
    </a>
    <div class="filter-container">
        <?php switch ($_GET['content']) {
            case "Users":
                require "Filters/Users.php";
            break;
            case "Residents":
                require "Filters/Residents.php";
            break;
            case "Employees":
                require "Filters/Employees.php";
            break;
            case "Attendance":
                require "Filters/Attendance.php";
            break;
            case "Transactions":
                require "Filters/Transactions.php";
            break;
            case "Inventory":
                require "Filters/InvTransactions.php";
            break;
            case "Announcements":
                require "Filters/Announcements.php";
            break;
            case "Events":
                require "Filters/Events.php";
            break;
            case "Incidents":
                require "Filters/Incidents.php";
            break;
            case "Activity Logs":
                require "Filters/ActivityLogs.php";
            break;
            default:
                require "Filters/Users.php";
            }?>
    </div>
</div>
<script>
    const menuButton = document.querySelector('.ham-menu');
    const sidebar = document.querySelector('.side-bar');
    menuButton.addEventListener('click', () => {
        sidebar.classList.toggle('side-bar-open');
        menuButton.classList.toggle('ham-menu-open');
    });
</script>