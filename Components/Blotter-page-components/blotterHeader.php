<div>
    <div class="header">
        <h2>Blotter Report</h2>
        <div onclick="toggleSettings()" class="settings-container">
            <div class="settings">
                <?php
                    //if the case Status is pending. show the solve and court button
                    if($blotter['caseStatus'] == "Pending"){
                ?>
                <form action="" method="post">
                    <input type="hidden" name="status" value="Solved">
                    <button type="submit" name="solve_blotter" onclick="" class="update-button">
                        <ion-icon name="checkmark-circle"></ion-icon>
                        Mark as Solved
                    </button>
                </form>
                <form action="" method="post">
                    <input type="hidden" name="status" value="Endorsed to the court">
                    <button type="submit" name="endorse_blotter" onclick="" class="update-button">
                        <ion-icon name="briefcase"></ion-icon>
                        Endorse to the Court
                    </button>
                </form>
                <?php }else{ //else show the mark as pending button?>
                <form action="" method="post">
                    <input type="hidden" name="status" value="Pending">
                    <button type="submit" name="pending_blotter" onclick="" class="update-button">
                        <ion-icon name="reload-circle"></ion-icon>
                        Mark as Pending
                    </button>
                </form>
                <?php }?>
                <button onclick="notify()" id="announceButton" class="update-button">
                    <ion-icon name="chatbox"></ion-icon>
                    Announce the Blotter(SMS)
                </button>
                <form action="../../Pages/Incidents/Incidents.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                    <button name="archive_blotter" class="update-button">
                        <ion-icon name="archive"></ion-icon>
                        Archive Blotter
                    </button>
                </form>
            </div>
            <ion-icon class="settings-icon" name="settings"></ion-icon>
        </div>
    </div>
    <div class="subtitle">Blotter Status: <?php echo $blotter['caseStatus']?></div>
</div>

<script>
let settingsButton = document.querySelector('.settings-container');
let settings = document.querySelector('.settings');

function toggleSettings() {
    if (settings.style.display === 'inline-block') {
        settings.style.display = 'none';
    } else {
        settings.style.display = 'inline-block';
    }
}

document.addEventListener("click", function(event) {
    // Check if the clicked element is the modal or one of its children
    if (!settingsButton.contains(event.target)) {
        settings.style.display = 'none';
    }
});


var contacts = <?php print_r($blotter['contacts']); ?>;
var latestHearing = <?php print_r($blotter['latestHearing']); ?>;

function notify() {
    contacts.map((contact) => {

        let messageText =
            `Dear Concerned Parties, This is to inform you that there has been a conflict recorded in the Barangay Blotter involving the individuals concerned. In order to find a resolution and settle the matter amicably, we invite all parties involved to come to the Barangay Hall for a meeting.The meeting will be held on ${latestHearing} at the Barangay Hall. We urge all parties involved to attend this meeting in order to discuss and resolve the issue in a peaceful and constructive manner. This is an opportunity for all parties to express their concerns and find a mutually agreeable solution.`;

       const message = {
           secret: "14162e3a4943c8b2c4de80ef0b97f3808ecd42b7",
           mode: "devices",
          device: "00000000-0000-0000-099e-e6613f8b3462",
           sim: 2,
           phone: `+639${contact}`,
           message: messageText,
       };

       async function sendSMS() {
           const queryParams = new URLSearchParams(message);
            const apiUrl = `https://sms.teamssprogram.com/api/send/sms?${queryParams.toString()}`;

            try {
                const response = await fetch(apiUrl);
                if (!response.ok) {
                     throw new Error(`HTTP error! Status: ${response.status}`);
                 }
              const result = await response.json();
              console.log(result);
            } catch (error) {
               console.error("Error:", error);
            }
       }
       sendSMS();
    })

    // Create the paragraph element
    var notificationParagraph = document.createElement("p");
    notificationParagraph.textContent = "Announcement Sending";
    notificationParagraph.classList.add("notif");

    // Get the div with class "notif-container"
    var notifContainer = document.querySelector(".notif-container");

    // Append the paragraph to the div
    notifContainer.appendChild(notificationParagraph);
    
    document.getElementById("announceButton").disabled = true;
    document.getElementById("announceButton").style.color = '#DADADA';
}
</script>