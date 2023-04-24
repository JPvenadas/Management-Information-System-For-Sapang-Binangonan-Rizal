<div class="messages-container">
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