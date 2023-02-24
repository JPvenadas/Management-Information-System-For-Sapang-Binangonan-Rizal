<div class="user-items-container">
    <?php
        require "UserItem.php";
        foreach($users as $user){
            generateItem($user);
        }
    ?>
</div>