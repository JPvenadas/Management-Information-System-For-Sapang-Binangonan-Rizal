<div class="messages-container height-450">
<?php
    include "MessageItem.php";
    foreach($announcements as $announcement){
        generateItem($announcement);
    }    
?>
</div>
<script>
    var objDiv = document.querySelector(".messages-container");
    objDiv.scrollTop = objDiv.scrollHeight;

    var objDiv = document.querySelector(".messages-container");
    objDiv.scrollTop = objDiv.scrollHeight;

  function toggleMessage(id) {
    var messageContent = document.getElementById('messageContent_' + id);
    var fullMessageContent = document.getElementById('fullMessageContent_' + id);
    var seeMoreBtn = document.querySelector('[onclick="toggleMessage(\'' + id + '\')"]');

    if (messageContent.style.display === 'none') {
      messageContent.style.display = 'block';
      fullMessageContent.style.display = 'none';
      seeMoreBtn.textContent = 'See More';
    } else {
      messageContent.style.display = 'none';
      fullMessageContent.style.display = 'block';
      seeMoreBtn.textContent = 'See Less';
    }
  }

</script>