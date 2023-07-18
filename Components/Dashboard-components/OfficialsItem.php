<?php
    //function to solve the age of the employee
    function solveAge($birthDate){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($birthDate), date_create($today));
    return $diff->format('%y') . " years old";
    }
    //function to generate a single barranggay officials item in the dashboard
    function generateItem($employee){
    if(is_array($employee)){

        $fullName = $employee['firstName'] . ' ' . $employee['middleName'][0]. '.' . ' ' . $employee['lastName'] . ' ' . $employee['extension'];
        //profile Image
        $image = $employee['image'];
        ?>
        <?php
            if($_SESSION['userType'] == "Resident"){?>
            
        <?php }else{ ?>
            <a href="../../Pages/Residents/Profile.php?id=<?php echo $employee['residentID']?>">
        <?php }?>
        
            <button type="submit" name="view_officials_button" class="officials-item-record">
                <div class="officials-info-container">
                    <div class="officials-image-container">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>"
                            class="officials-image" src="" alt="">
                    </div>
                    <div class="officials-info">
                        <p class="officials-fullname"><?php echo $fullName?></p>
                        <p class="officials-age"><?php echo solveAge($employee['birthDate'])?></p>
                        <p class="officials-purok"><?php 
                        if($employee['committee'] == "N/A"){
                            echo "Not part of any Committee";
                        }else{
                            echo $employee['committee'];
                        }
                        ?></p>
                    </div>
                </div>
                <div class="action-text">
                    <p><?php echo $employee['position']?></p>
                </div>
            </button>
        <?php
        if($_SESSION['userType'] == "Resident"){?>
            
        <?php }else{ ?>
        </a>
        <?php }?>


        <?php }else{ ?>
            <button type="submit" name="view_officials_button" class="officials-item-record">
                <div class="officials-info-container">
                    <div class="officials-image-container">
                        <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                            class="officials-image" src="" alt="">
                    </div>
                    <div class="officials-info">
                        <p class="officials-fullname">Position Empty</p>
                        <p class="officials-age">Not Set</p>
                        <p class="officials-purok">Not Set</p>
                    </div>
                </div>
                <div class="action-text">
                    <p><?php echo $employee?></p>
                </div>
            </button>
        </a>
        <?php }
}?>