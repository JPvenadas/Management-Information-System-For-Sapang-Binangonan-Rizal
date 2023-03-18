<?php function generateItem($announcement){?>
<div class="message">
    <p class="text"><?php echo $announcement['message']?></p>
    <div class="message-info">
        <div class="bold-text">To: <?php echo $announcement['recepients']?></div>
        <div class="bold-text">Posted By: <?php echo $announcement['fullName']?></div>
        <div class="light-text"><?php echo date("M, d, Y l g:i A", strtotime($announcement['datePosted'])) ?>, Sent</div>
    </div>
</div>
<?php } ?>