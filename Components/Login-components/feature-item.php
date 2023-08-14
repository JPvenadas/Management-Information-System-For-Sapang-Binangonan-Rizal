<?php
function generateFeatureItem($data){
?>
<div class="feature">
    <img src="<?php echo $data['img-src']?>" alt="">
    <h4><?php echo $data['title']?></h4>
    <p class="text-18px-gray"><?php echo $data['description']?></p>
</div>
<?php }?>