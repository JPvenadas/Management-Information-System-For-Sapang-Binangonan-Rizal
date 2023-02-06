<?php
function attachNavbar($page){

    // this will just determine which tab bar should be highlighted
    $dashboard=""; $residents=""; $personnels=""; $user=""; $transactions="";$incidents="";$reports="";$settings="";
    switch ($page) {
        case "dashboard":
         $dashboard="highlight";
          break;
        case "residents":
         $residents="highlight";
          break;
        case "personnels":
         $personnels="highlight";
          break;
        case "user":
         $user="highlight";
        break;
        case "transactions":
          $transactions="highlight";
        break;
        case "reports":
          $reports="highlight";
        break;
        default:
          $settings="highlight";
      }

?>
<div class="sidebar">
    <div class="sidebar-content-container">
        <div class="sidebar-profile-section">
            <img class="sidebar-profile-picture" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['image']); ?>" alt="">
            <div class ="sidebar-profile-text">
                <h3 class="sidebar-fullname"><?php print_r($_SESSION['firstName']); echo " "; print_r($_SESSION['lastName'])?></h3>
                <h4 class="sidebar-Usertypes"><?php print_r($_SESSION['userType'])?><h4>
            </div>
        </div>
        <div class="sidebar-divider"></div>
        <nav class="sidebar-nav">
            <ul class="sidebar-nav-container">
                <li class="sidebar-item">
                    <a href="../../Modules/Dashboard/dashboard.php" class=" <?php echo $dashboard?> sidebar-item-container">
                        <ion-icon name="home-sharp"></ion-icon>
                        <span class="sidebar-item-text">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../Modules/Residents/residents.php" class=" <?php echo $residents?> sidebar-item-container">
                        <ion-icon name="people"></ion-icon>
                        <span class="sidebar-item-text">Residents</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../Modules/Personnels/Personnels.php" class="<?php echo $personnels?> sidebar-item-container">
                        <ion-icon name="person"></ion-icon>
                        <span class="sidebar-item-text">Personnels</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../Modules/Users/users.php" class="<?php echo $user?> sidebar-item-container">
                        <ion-icon name="person-circle"></ion-icon>
                        <span class="sidebar-item-text">Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../Modules/Transactions/transactions.php" class="<?php echo $transactions?> sidebar-item-container">
                        <ion-icon name="document"></ion-icon>
                        <span class="sidebar-item-text">Transactions</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../Modules/Reports/reports.php" class="<?php echo $reports?> sidebar-item-container">
                        <ion-icon name="stats-chart"></ion-icon>
                        <span class="sidebar-item-text">Reports</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../Modules/Settings/settings.php?page=services" class=" <?php echo $settings?> sidebar-item-container">
                        <ion-icon name="settings"></ion-icon>
                        <span class="sidebar-item-text">Settings</span>
                    </a>
                </li>
            </ul>
           <a class="logout" href="../../Functions/logout.php">
           <ion-icon name="power"></ion-icon>
           <span>Logout</span>
           </a>
           <div class="sidebar-circle"></div>
        </nav>
    </div>
</div>
<?php }?>
