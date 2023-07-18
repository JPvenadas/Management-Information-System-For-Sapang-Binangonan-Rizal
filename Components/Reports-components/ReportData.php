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
        case "Activity Logs":
            require "Data/Logs.php";
        break;
        case "Residents":
            require "Data/Residents.php";
        break;
        default:
         require "Data/Users.php";
        } ?>

        <div class="report-footer">
            <div class="employee-container">
                <p>Prepared by:</p>
                <img class="signiture" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['signiture'])?>" alt="">
                <p class="name"><?php echo $_SESSION['firstName'] .' '. $_SESSION['lastName']?></p>
            </div>
        </div>

        </div>
        </div>
    </div>
</div>