<div class="transactions-container">
<p class="header">Pending Requests</p>
    <?php require "requestItem.php";
    $requests = getRequests();
        foreach ($requests as $request) {
        generateRequest($request);
        }
    ?>
</div>