<?php 
function solveAge($birthDate){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($birthDate), date_create($today));
    return $diff->format('%y') . " years old";
}

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
    <p>
    This is to certify that <span><?php echo $resident['fullName']?></span>, <?php $age?><?php echo solveAge($resident['birthDate'])?>, is a legal
    resident of this barangay and he/she is known as a law abiding citizen
    and not connected in any subversive elements.
    </p>
    <p>
    This certification is being issued by <span><?php echo $userFullName?></span> for whatever legal purpose it may
    serve his/her best.</p>
    <p>
    Given this <span class="certificate-date"><?php echo $day?><sup><?php echo $sup?></sup>
    day of <?php echo "$month $year"?></span> at Barangay Sapang, Binangonan, Rizal.
    </p>
</div>
<?php }?>