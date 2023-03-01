<?php
    $totalEmployees = getNumberofEmployees();
    $totalItems = getNumberofItems();
    $totalPending = getPendingRequests();
?>
<div class="second-division">
    <div class="top">
        <div class="transactions-container">
            <div class="transactions-top">
                <div class="transactions-info">
                    <h3 class="section-title">Pending Transactions</h3>
                    <p class="data-text"><?php echo $totalPending['number']?> Requests</p>
                </div>
                <div class="transactions-image">
                    <img src="../../Images/documents.png" alt="">
                </div>
            </div>
            <div class="transactions-bottom">
                <a href="../../Pages/Services/Services.php"><button>View Transactions</button></a>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="personnels-container">
            <div>
                <ion-icon name="people"></ion-icon>
                <h3 class="section-title">Employees</h3>
                <p class="data-text"><?php echo $totalEmployees['number']?> Persons</p>

            </div>
        </div>
        <div class="puroks-container">
            <div>
                <ion-icon name="albums"></ion-icon>
                <h3 class="section-title">Inventory</h3>
                <p class="data-text"><?php echo $totalItems['number']?> Items</p>
            </div>
        </div>
    </div>
</div>