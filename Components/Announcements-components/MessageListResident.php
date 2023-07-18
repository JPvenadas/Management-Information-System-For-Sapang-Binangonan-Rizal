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
</script>