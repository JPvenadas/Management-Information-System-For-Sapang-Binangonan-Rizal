<?php 
    function generateNavItem($highlight, $text, $icon, $link){
?>
    <li class="sidebar-item  <?php echo $highlight?>">
        <a href="<?php echo $link?>" class="sidebar-item-container">
            <ion-icon name="<?php echo $icon?>"></ion-icon>
            <span class="sidebar-item-text"><?php echo $text?></span>
        </a>
    </li>
<?php 
}
 ?>