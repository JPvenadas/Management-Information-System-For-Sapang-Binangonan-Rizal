<?php function generateItem($announcement){?>
<div class="message">
    <div class="top">
        <div>
            <img class="image" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($announcement['image']); ?>" alt="">
        </div>
        <div>
            <h3 class="bold-text"><?php echo $announcement['fullName']?></h3>
            <h4  class="bold-text">To: <?php echo $announcement['recepients']?></h4>
            <div class="light-text"><?php echo date("M, d, Y l g:i A", strtotime($announcement['datePosted'])) ?>, Sent</div>
        </div>
    </div>
    <div class="divider"></div>
    <div class="bottom">
        <!-- Your existing code for the bottom section -->
        <p class="messageType"><?php echo $announcement['announcementType']?></p>
        <div class="message-content">
          <p class="text" id="messageContent_<?php echo $announcement['announcementID']; ?>">
            <?php 
            
            echo '"' . substr($announcement['message'], 0, 100); 
            if(strlen($announcement['message']) >=100){
                echo '... ';
            ?>
                <button class="see-more-btn" onclick="toggleMessage('<?php echo $announcement['announcementID']; ?>')">See More</button>
            <?php }else{
                echo '"';
            }?>
          </p>
          <p class="text full-text" id="fullMessageContent_<?php echo $announcement['announcementID']; ?>">"<?php echo $announcement['message']; ?>"</p>
        </div>
    </div>
</div>
<?php } ?>