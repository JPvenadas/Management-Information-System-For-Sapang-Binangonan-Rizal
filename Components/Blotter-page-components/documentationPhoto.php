<?php function generateDocPhoto($number,$hearingID, $image){
    if(empty($image)){    
?>
<form action="">
    <input type="hidden" name="hearingID">
    <input type="hidden" name="photoNumber">
    <input class="photo-input" id="documentation-<?php echo $hearingID . $number?>" type="file">
    <label for="documentation-<?php echo $hearingID . $number?>" class="add-photo">
        <ion-icon class="photo-icon" name="images"></ion-icon>
        <div>
            <ion-icon name="add"></ion-icon>
            <span>Add photo</span>
        </div>
    </label>
</form>
<?php } else{ 
    $base64_pic = ($image !== null) ? base64_encode($image) : ''; // Convert the blob data to base64
    $divStyle = ($base64_pic !== '') ? 'style="background-image: url(data:image/jpg;charset=utf8;base64,' . $base64_pic . ')"' : '';    
?>
<form style="position: relative" method="post" action="">
    <button class="delete-doc" type="submit" name="delete_doc_photo" type="submit">
        <ion-icon name="remove-circle"></ion-icon>
    </button>
    <a href="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>"
        data-lightbox="Hearing-Documentation-<?php echo $_GET['id'] . $hearingID?>" data-title="Hearing Documentation">
        <div class="photo-view lazy-load" <?php echo $divStyle?> data-src="<?php echo 'data:image/jpg;charset=utf8;base64,' . $base64_pic; ?>">
            <input name="field" type="hidden" value="documentation<?php echo $number?>">
            <input name="hearingID" type="hidden" value="<?php echo $hearingID?>">
            <input type="hidden">
        </div>
    </a>
</form>
<?php }
}?>