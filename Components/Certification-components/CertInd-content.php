<?php 
function attachCertificateBody($resident){
    $userFullName = $_SESSION['firstName'] . ' ' . $_SESSION['middleName'][0]. '.' . ' ' . $_SESSION['lastName'] . ' ' . $_SESSION['extension'];
    $day = date('d');
    $sup = "";
    $month = date('F');
    $year = date('Y');
    if($day==1){$sup = "st";}elseif($day==1){$sup = "nd";}elseif($day==3){$sup = "rd";}else{$sup = "th";};                   
?>


<div class="certificate-body">

    <span>To Whom it may concern:</span>
    <p>This is to certify that <span><?php echo $resident['fullName']?></span> of <?php echo $resident['purok']?>, Barangay Sapang Municipality of Binangonan, is one of the
        Indigent Resident in our barangay.</p>
    <p>This certification is being issued by <span><?php echo $userFullName?></span> for whatever legal purpose it may
        serve his/her best.</p>
    <p>Issued this
        <span class="certificate-date"><?php echo $day?><sup><?php echo $sup?></sup>
            day of <?php echo "$month $year"?></span> at Sapang, Binangonan, Rizal.
    </p>
</div>
<?php }?>