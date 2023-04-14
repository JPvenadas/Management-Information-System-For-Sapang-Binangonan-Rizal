<div class="certificate-container">
    <div id="certificate" class="certificate-paper">
        <?php require 'PaperHeader.php'?>
        <div class="data-container">
        
        <?php switch ($_GET['content']) {
        case "Users":
            require "Data/Users.php";
        break;
        case "Transactions":
            require "Data/Transactions.php";
        break;
        case "Employees":
            require "Data/Employees.php";
        break;
        case "Attendance":
            require "Data/Attendance.php";
        break;
        case "Inventory":
            require "Data/InvTransactions.php";
        break;
        case "Events":
            require "Data/Events.php";
        break;
        case "Incidents":
            require "Data/Blotters.php";
        break;
        case "Announcements":
            require "Data/Announcements.php";
        break;
        default:
         require "Data/Users.php";
        } ?>

        </div>
        </div>
    </div>
</div>